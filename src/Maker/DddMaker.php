<?php declare(strict_types=1);

namespace Becklyn\DddGeneratorBundle\Maker;

use Becklyn\DddGeneratorBundle\Exception\NoSuchDomainException;
use Becklyn\DddGeneratorBundle\Helper\GitUserInfoFetcher;
use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\DependencyBuilder;
use Symfony\Bundle\MakerBundle\Maker\AbstractMaker;
use Symfony\Component\Config\Exception\FileLocatorFileNotFoundException;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Yaml\Yaml;

/**
 * Base Implementation for Domain-Driven-Design related Makers.
 * Predefines functionality for command name generation, internationalization, domain configuration.
 *
 * @author Pascal Gläßer <pascal.glaesser1997@gmail.com>
 *
 * @since 2021-01-27 Initial Implementation
 */
abstract class DddMaker extends AbstractMaker
{
    protected KernelInterface $kernel;

    protected const DOMAIN_NAME_OPTION_KEY = "domain-name";

    public function __construct (KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @inheritDoc
     */
    public static function getCommandName () : string
    {
        return "ddd:" . self::getKey();
    }

    public static function getCommandDescription () : string
    {
        return 'Generates some classes for DDD pattern';
    }

    /**
     * Generates and returns a key based on the class name
     */
    private static function getKey () : string
    {
        $reflector = new \ReflectionClass(static::class);
        $key = new UnicodeString($reflector->getShortName());
        return $key->replace("Make", "")->snake()->replace("_", "-")->toString();
    }

    /**
     * @inheritDoc
     */
    public function interact (InputInterface $input, ConsoleStyle $io, Command $command) : void
    {
        foreach ($command->getDefinition()->getOptions() as $option)
        {
            if (!$this->hasDefinedOption($option->getName(), $input) && $option->isValueRequired())
            {
                $input->setInteractive(true);

                if (self::DOMAIN_NAME_OPTION_KEY === $option->getName() && $this->askToSelectDomain() && !empty($this->getAllDomains())) {
                    $value = $io->askQuestion(new ChoiceQuestion($option->getDescription(), $this->getAllDomains()));
                }
                else
                {
                    $value = $io->ask($option->getDescription(), $option->getDefault());
                }

                $input->setOption($option->getName(), $value);
            }
        }
    }

    /**
     * Checks if the configured options were passed with non-empty values
     */
    protected function hasDefinedOption (string $optionName, InputInterface $input) : bool
    {
        return $input->hasOption($optionName) && !empty($input->getOption($optionName));
    }

    /**
     * Returns the path to the template.
     * Will look for the template name or fallback to the default name if unprovided.
     */
    protected function getTemplatePath (?string $templateName = null) : string
    {
        $fileResolver = new FileLocator([
            __DIR__ . "/../Resources/skeleton/ddd",
            $this->kernel->getProjectDir() . "src/Resources/skeleton/ddd",
            $this->kernel->getProjectDir() . "res/skeleton/ddd",
        ]);
        return $fileResolver->locate(($templateName ?? self::getKey()) . ".tpl.php", null, true);
    }

    /**
     * Returns a array of key-value pairs that can be used in the templates.
     *
     * @throws NoSuchDomainException
     *
     * @return string[]
     */
    protected function internationalize (string $domain) : array
    {
        $language = $this->getDomainLanguage($domain);
        $locator = new FileLocator(__DIR__ . "/../Resources/i18n");
        $filename = $locator->locate("{$language}.yaml");

        return Yaml::parse(\file_get_contents($filename));
    }

    /**
     * Returns the language of the domain from the configuration file.
     *
     * @throws NoSuchDomainException If the domain is not configured or does not exist.
     */
    protected function getDomainLanguage (string $domain) : string
    {
        try
        {
            $filename = $this->getDomainConfigPath($domain);
            $yaml = Yaml::parse(\file_get_contents($filename));
            return $yaml["language"];
        }
        catch (FileLocatorFileNotFoundException $e)
        {
            $gitUserInfoFetcher = new GitUserInfoFetcher();
            $makeDomainCmd = (new MakeDomain($this->kernel, $gitUserInfoFetcher))->getCommandName();
            throw new NoSuchDomainException(
                "The domain \"{$domain}\" does not yet exist.\nTry generating one with \"{$makeDomainCmd}\""
            );
        }
    }

    /**
     * Returns the location of the domains configuration file.
     *
     * @throws FileLocatorFileNotFoundException If the file cannot be found
     */
    protected function getDomainConfigPath (string $domain) : string
    {
        $locator = new FileLocator($this->kernel->getProjectDir() . "/src/{$domain}");
        return $locator->locate("domain_config.yaml");
    }

    /**
     * Returns the locations of all domain configuration file.
     *
     * @throws FileLocatorFileNotFoundException If the file cannot be found
     */
    protected function getAllDomains () : array
    {
        $domains = [];
        $finder = (new Finder())
            ->in('src/')
            ->name('domain_config.yaml');

        foreach ($finder->getIterator() as $item)
        {
            $domain = \explode("/", "{$item}")[1];
            $domains[] = $domain;
        }

        return $domains;
    }


    /**
     * If this method returns true the command will ask the user to select a domain from a list of domains.
     * If this method returns false the command will ask the user to provide the name of the domain as a string.
     */
    protected function askToSelectDomain () : bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function configureDependencies (DependencyBuilder $dependencies) : void
    {
        foreach ($this->getDependencies() as $class => $package)
        {
            $dependencies->addClassDependency($class, $package);
        }
    }

    /**
     * Returns a array of dependencies as key-value-pair: className => composerPackage
     */
    abstract protected function getDependencies () : array;


    /**
     * Checks if the domain was configured
     */
    public function isDomainConfigured (string $domain) : bool
    {
        try
        {
            // will throw a exception if domain was not configured
            $this->getDomainConfigPath($domain);
            return true;
        }
        catch
        (FileLocatorFileNotFoundException $e)
        {
            return false;
        }
    }
}

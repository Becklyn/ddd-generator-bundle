<?php declare(strict_types=1);

namespace Becklyn\DddGeneratorBundle\Maker;

use Becklyn\DddGeneratorBundle\Exception\NoSuchDomainException;
use Becklyn\DddGeneratorBundle\Helper\GitUserInfoFetcher;
use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\String\UnicodeString;

/**
 * Abstract Maker that provides base functionality for generating Domain-Driven-Design Entity-related classes.
 *
 * @see DddMaker
 *
 * @author Pascal Gläßer <pascal.glaesser1997@gmail.com>
 *
 * @since 2021-01-27 Initial Implementation
 */
abstract class DddEntityMaker extends DddMaker
{
    protected string $layer = "Domain";
    private GitUserInfoFetcher $gitUserInfoFetcher;

    /**
     * Returns the description of the command.
     */
    abstract protected function getDescription () : string;

    public function __construct (KernelInterface $kernel, GitUserInfoFetcher $gitUserInfoFetcher)
    {
        parent::__construct($kernel);
        $this->gitUserInfoFetcher = $gitUserInfoFetcher;
    }

    /**
     * Returns a array of required options.
     *
     * @return string[]
     */
    protected function getRequiredOptions () : array
    {
        return [parent::DOMAIN_NAME_OPTION_KEY, "entity-name"];
    }

    /**
     * @inheritDoc
     */
    public function configureCommand (Command $command, InputConfiguration $inputConfig) : void
    {
        $command
            ->setDescription($this->getDescription())
            ->addOption(
                parent::DOMAIN_NAME_OPTION_KEY,
                null,
                InputOption::VALUE_REQUIRED,
                "Which domain does the entity belong to?"
            )
            ->addOption(
                "entity-name",
                null,
                InputOption::VALUE_REQUIRED,
                "What's the name of the entity?"
            )
            ->addOption(
                "domain-namespace",
                null,
                InputOption::VALUE_REQUIRED,
                "In which sub-namespace should the entity be created?\n\tPlease note that the domain name and layer will be prefixed like so: \n\tDomainName\\Infrastructure\\SubNamespace(s)\n\n Please use the \\ delimiter for nested namespaces",
                null
            );
    }

    /**
     * @inheritDoc
     *
     * @throws NoSuchDomainException
     * @throws \Exception
     */
    public function generate (InputInterface $input, ConsoleStyle $io, Generator $generator) : void
    {
        $normalizeInput = fn (string $string) => (new UnicodeString($string))->camel()->title()->toString();

        foreach ($this->getRequiredOptions() as $option)
        {
            if (null === $input->getOption($option))
            {
                throw new \InvalidArgumentException("Option \"{$option}\" must be provided and may not be left blank.");
            }
        }

        $domainName = $normalizeInput($input->getOption("domain-name"));
        $entityName = $normalizeInput($input->getOption("entity-name"));
        $namespace = $input->getOption("domain-namespace") ?? "";
        $gitUser = $this->gitUserInfoFetcher->getUserName();
        $gitEmail = $this->gitUserInfoFetcher->getUserEmail($this->kernel, $io);

        // replace values with normalized inputs (used by getExtraVariables)
        $input->setOption('domain-name', $domainName);
        $input->setOption('entity-name', $entityName);
        $input->setOption('domain-namespace', $namespace);

        $variables = [
            "domain_namespace" => empty($namespace) ? "" : $this->normalizeNamespace($namespace, $normalizeInput) . "\\",
            "entity" => $entityName,
            "domain" => $domainName,
            "psr4Root" => $generator->getRootNamespace(),
            "i18n" => $this->internationalize($domainName),
            "version" => (new \DateTimeImmutable())->format("Y-m-d"),
            "author" => "{$gitUser} <{$gitEmail}>",
            "extra" => $this->getExtraVariables($input),

            // The following functions will be available in the template
            "strtosnake" => fn (string $string) => (new UnicodeString($string))->snake()->toString(),
            "strtocamel" => fn (string $string) => (new UnicodeString($string))->camel()->toString(),
        ];


        $className = $this->getEntityPrefix($variables) . $entityName . $this->getEntitySuffix($variables);
        $class = $generator->createClassNameDetails(
            $className,
            $this->buildNamespace($domainName, $namespace, $variables)
        );
        $generator->generateClass($class->getFullName(), $this->getTemplatePath(), $variables);
        $generator->writeChanges();
    }

    /**
     * Method that can be used by extending classes to provide extra variables to
     *   their templates without needing to override the generate method.
     *
     * The $input is the same that is passed to the generate method.
     *
     * The variables will be available as $extra inside the template.
     */
    protected function getExtraVariables (InputInterface $input) : array
    {
        return [];
    }

    /**
     * Returns the prefix that should be prepended to the entity name.
     * The return value is used to generate the file name of the class
     *
     * @param array $variables The same variables that are passes to the template.
     */
    protected function getEntityPrefix (array $variables = []) : string
    {
        return $variables["extra"]["entity_prefix"] ?? "";
    }

    /**
     * Returns the suffix that should be appended to the entity name.
     * The return value is used to generate the file name of the class
     *
     * @param array $variables The same variables that are passes to the template.
     */
    protected function getEntitySuffix (array $variables = []) : string
    {
        return $variables["extra"]["entity_suffix"] ?? "";
    }

    /**
     * Returns the namespace that the generated class should be placed in.
     *
     * @param array $variables The same variables that are passed to the template.
     *                         Can be used by extending classes to build the namespace without needing to override the generate method.
     */
    protected function buildNamespace (string $domain, string $userProvidedNamespace, array $variables = []) : string
    {
        $layer = $this->layer;
        $namespaceTokens = [
            "{$domain}",
            "{$layer}",
            $this->normalizeNamespace($userProvidedNamespace),
        ];
        $namespaceTokens = \array_filter($namespaceTokens, 'strlen');
        return \implode("\\", $namespaceTokens);
    }


    /**
     * Returns a well-formed namespace string by applying the callback function to the namespace fragments
     */
    protected function normalizeNamespace(string $namespace, ?callable $callback = null) : string
    {
        $normalize = $callback ?? fn (string $string) => (new UnicodeString($string))->camel()->title()->toString();
        $tokens = \explode('\\', $namespace);
        return \implode('\\', \array_map($normalize, $tokens));
    }

    /**
     * Appends all tokens to the currentNamespace and returns the new namespace string
     *
     * @param string[] $namespaceTokens
     */
    protected function appendToNamespace (string $currentNamespace, array $namespaceTokens = []) : string
    {
        $namespaceArray = [
            ...\explode("\\", $currentNamespace),
            ...$namespaceTokens,
        ];
        $namespaceArray = \array_filter($namespaceArray, 'strlen');
        return \implode("\\", $namespaceArray);
    }
}

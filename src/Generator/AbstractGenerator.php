<?php declare(strict_types=1);

namespace C201\DddGeneratorBundle\Generator;

use C201\DddGeneratorBundle\Helper\KeyGenerator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class AbstractGenerator extends Command
{
    private Environment $twig;
    public function __construct (string $name = null)
    {
        parent::__construct($name);
        $loader = new FilesystemLoader(__DIR__."/../../templates");
        $this->twig = new Environment($loader);
    }

    public final static function getCommandName () : string
    {
        return "generate:".self::getKey();
    }

    protected final static function getKey () : string
    {
        return KeyGenerator::generateKey(static::class, "Generator");
    }

    public static function getDefaultName ()
    {
        return self::getCommandName();
    }

    protected final function execute (InputInterface $input, OutputInterface $output)
    {
        try {
            $this->configure();
            $this->generate($input, $output);
            return self::SUCCESS;
        } catch (\Exception $e) {
            return self::FAILURE;
        }
    }

    protected final function configure ()
    {
        parent::configure();
        $this->configureCommand();
    }

    /**
     * Generates the File and Code in the correct directory
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    abstract public function generate(InputInterface $input, OutputInterface $output) : void;

    /**
     * Configures the Arguments and Parameters of the Command
     */
    abstract protected function configureCommand () : void;

    protected function getDefaultTemplateName () : string
    {
        return self::getKey().".php.twig";

    }

    /**
     * Returns the rendered contents of the given template
     */
    protected function renderTemplate (?string $templateName = null, array $variables = []) : string
    {
        try
        {
            return $this->twig->render($templateName ?? $this->getDefaultTemplateName(), $variables);
        } catch (\Exception $e)
        {
            echo $e;
            return "";
        }
    }
}

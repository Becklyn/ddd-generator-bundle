<?php declare(strict_types=1);

namespace Becklyn\DddGeneratorBundle\Maker;

use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\String\UnicodeString;

/**
 * Maker that generates and configures a domain.
 *
 * @see DddMaker
 * @see DddEntityMaker
 *
 * @author Pascal Gläßer <pascal.glaesser1997@gmail.com>
 *
 * @since 2021-01-27 Initial Implementation
 */
class MakeDomain extends DddEntityMaker
{
    /**
     * @inheritDoc
     */
    public function configureCommand (Command $command, InputConfiguration $inputConfig) : void
    {
        $command
            ->setDescription($this->getDescription())
            ->addOption("domain-name", "", InputOption::VALUE_REQUIRED, "The name of the domain")
            ->addOption("language", "", InputOption::VALUE_REQUIRED, "The language of the domain");
    }

    /**
     * @inheritDoc
     */
    public function generate (InputInterface $input, ConsoleStyle $io, Generator $generator) : void
    {
        $normalizeInput = fn (string $string) => (new UnicodeString($string))->camel()->title(true)->toString();
        $domain = $normalizeInput($input->getOption("domain-name"));
        $path = $this->kernel->getProjectDir() . "/src/{$domain}/domain_config.yaml";

        $variables = [
            "language" => $input->getOption("language") ?? "en",
        ];

        $generate = fn () => $generator->generateFile($path, $this->getTemplatePath(), $variables) & $generator->writeChanges();
        $filesystem = new Filesystem();

        if ($filesystem->exists($path))
        {
            $question = new ChoiceQuestion("File {$path} exists already.\nShould it be overwritten?", ["yes", "no"], "no");
            $answer = $io->askQuestion($question);

            if ("yes" === $answer)
            {
                $filesystem->remove($path);
                $generate();
            }
        }
        else
        {
            $generate();
        }
    }

    /**
     * @inheritDoc
     */
    protected function getDescription () : string
    {
        return "Configures the domain.";
    }

    /**
     * @inheritDoc
     */
    protected function getDependencies () : array
    {
        return [];
    }
}

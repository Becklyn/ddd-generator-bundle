<?php declare(strict_types=1);

namespace C201\DddGeneratorBundle\Maker;

use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\String\UnicodeString;

abstract class DddEntityCommandMaker extends DddEntityMaker
{
    protected string $layer = "Application";

    /**
     * @inheritDoc
     */
    public function configureCommand (Command $command, InputConfiguration $inputConfig) : void
    {
        parent::configureCommand($command, $inputConfig);
        $command->addOption("command-action", null, InputOption::VALUE_REQUIRED, "Whats the name of the action the command should execute?");
    }

    /**
     * @inheritDoc
     */
    protected function getRequiredOptions () : array
    {
        return [
            ...parent::getRequiredOptions(),
            "command-action",
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getExtraVariables (InputInterface $input) : array
    {
        $actionName = new UnicodeString($input->getOption("command-action"));
        $actionName = $actionName->lower()->title()->toString();

        return [
            "command_action" => $actionName,
        ];
    }

    protected function buildNamespace (string $domain, string $userProvidedNamespace, array $variables = []) : string
    {
        return $this->appendToNamespace(parent::buildNamespace($domain, $userProvidedNamespace), [
            $variables["entity"] . $variables["extra"]["command_action"],
        ]);
    }
}

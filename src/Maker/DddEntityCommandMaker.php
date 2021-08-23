<?php declare(strict_types=1);

namespace Becklyn\DddGeneratorBundle\Maker;

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
        $domain = $input->getOption(parent::DOMAIN_NAME_OPTION_KEY);
        $entity = $input->getOption('entity-name');
        $actionName = new UnicodeString($input->getOption("command-action"));
        $actionName = $actionName->camel()->title()->toString();

        if ("en" === $this->getDomainLanguage($domain)) {
            $commandNamespace = $actionName . $entity;
        }
        else {
            $commandNamespace = $entity . $actionName;
        }

        return [
            "command_action" => $actionName,
            "command_namespace" => $commandNamespace,
        ];
    }

    protected function buildNamespace (string $domain, string $userProvidedNamespace, array $variables = []) : string
    {
        return $this->appendToNamespace(parent::buildNamespace($domain, $userProvidedNamespace), [
            $variables['extra']['command_namespace'],
        ]);
    }
}

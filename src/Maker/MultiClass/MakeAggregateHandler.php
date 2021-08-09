<?php declare(strict_types=1);

namespace Becklyn\DddGeneratorBundle\Maker\MultiClass;

use Becklyn\DddGeneratorBundle\Helper\GitUserInfoFetcher;
use Becklyn\DddGeneratorBundle\Maker\Command\MakeCommand;
use Becklyn\DddGeneratorBundle\Maker\Command\MakeCommandHandler;
use Becklyn\DddGeneratorBundle\Maker\Command\MakeCommandHandlerTest;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;

class MakeAggregateHandler extends MultiClassMaker
{
    public static function getCommandName () : string
    {
        return "make:aggregate-handler";
    }

    public function configureCommand (Command $command, InputConfiguration $inputConfig) : void
    {
        parent::configureCommand($command, $inputConfig);
        $command->addOption("command-action", null, InputOption::VALUE_REQUIRED, "Whats the name of the action the command should execute?");
    }

    /**
     * @inheritDoc
     */
    protected function getDescription () : string
    {
        return "Generates a Command and a Command Handler for a Entity";
    }

    public function getMakers () : array
    {
        $gitInfoFetcher = new GitUserInfoFetcher();
        return [
            new MakeCommand($this->kernel, $gitInfoFetcher),
            new MakeCommandHandler($this->kernel, $gitInfoFetcher),
            new MakeCommandHandlerTest($this->kernel, $gitInfoFetcher),
        ];
    }
}

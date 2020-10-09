<?php declare(strict_types=1);

namespace C201\DddGeneratorBundle\Maker\MultiClass;

use C201\DddGeneratorBundle\Maker\Command\MakeCommand;
use C201\DddGeneratorBundle\Maker\Command\MakeCommandHandler;
use C201\DddGeneratorBundle\Maker\Command\MakeCommandHandlerTest;
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
        return [
            new MakeCommand($this->kernel),
            new MakeCommandHandler($this->kernel),
            new MakeCommandHandlerTest($this->kernel),
        ];
    }
}

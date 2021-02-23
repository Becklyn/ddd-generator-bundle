<?php declare(strict_types=1);

namespace C201\DddGeneratorBundle\Maker\Command;

use C201\Ddd\Commands\Application\CommandHandler;
use C201\Ddd\Events\Domain\EventProvider;
use C201\DddGeneratorBundle\Maker\DddEntityCommandMaker;

class MakeCommandHandler extends DddEntityCommandMaker
{
    /**
     * @inheritDoc
     */
    protected function getDescription () : string
    {
        return "Generates a Command Handler.";
    }

    /**
     * @inheritDoc
     */
    protected function getDependencies () : array
    {
        return [
            CommandHandler::class => "201created/ddd",
            EventProvider::class => "201created/ddd",
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getEntitySuffix (array $variables = []) : string
    {
        // should be named ${ActionName}${EntityName}Handler in english
        // else ${EntityName}${ActionName}Handler
        if ($variables["domain_language"] == "en") {
            return "Handler";
        }
        return $variables["extra"]["command_action"] . "Handler";
    }


    /**
     * @inheritDoc
     */
    protected function getEntityPrefix (array $variables = []) : string
    {
        // should be named ${ActionName}${EntityName}Handler in english
        // else ${EntityName}${ActionName}Handler
        if ($variables["domain_language"] == "en") {
            return $variables["extra"]["command_action"];
        }
        return "";
    }
}

<?php declare(strict_types=1);

namespace Becklyn\DddGeneratorBundle\Maker\Command;

use Becklyn\DddGeneratorBundle\Maker\DddEntityCommandMaker;

class MakeCommand extends DddEntityCommandMaker
{
    /**
     * @inheritDoc
     */
    protected function getDescription () : string
    {
        return "Generates a Command that can be handled by a CommandHandler";
    }

    /**
     * @inheritDoc
     */
    protected function getDependencies () : array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    protected function getEntitySuffix (array $variables = []) : string
    {
        // should be named ${ActionName}${EntityName}Command in english
        // else ${EntityName}${ActionName}Command
        if ($variables["domain_language"] == "en") {
            return "Command";
        }
        return $variables["extra"]["command_action"] . "Command";
    }


    /**
     * @inheritDoc
     */
    protected function getEntityPrefix (array $variables = []) : string
    {
        // should be named ${ActionName}${EntityName}Command in english
        // else ${EntityName}${ActionName}Command
        if ($variables["domain_language"] == "en") {
            return $variables["extra"]["command_action"];
        }
        return "";
    }
}

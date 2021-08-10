<?php declare(strict_types=1);

namespace Becklyn\DddGeneratorBundle\Maker\Command;

use Becklyn\Ddd\Commands\Application\CommandHandler;
use Becklyn\Ddd\Events\Domain\EventProvider;
use Becklyn\DddGeneratorBundle\Maker\DddEntityCommandMaker;

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
            CommandHandler::class => "becklyn/ddd-core",
            EventProvider::class => "becklyn/ddd-core",
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getEntitySuffix (array $variables = []) : string
    {
        // should be named ${ActionName}${EntityName}Handler in english
        // else ${EntityName}${ActionName}Handler
        if ("en" === $this->getDomainLanguage($variables["domain"])) {
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
        if ("en" === $this->getDomainLanguage($variables["domain"])) {
            return $variables["extra"]["command_action"];
        }
        return "";
    }
}

<?php declare(strict_types=1);

namespace Becklyn\DddGeneratorBundle\Maker\Command;

use Becklyn\Ddd\Events\Testing\DomainEventTestTrait;
use Becklyn\Ddd\Transactions\Testing\TransactionManagerTestTrait;
use Becklyn\DddGeneratorBundle\Maker\DddEntityCommandTestMaker;
use PHPStan\Testing\TestCase;

class MakeCommandHandlerTest extends DddEntityCommandTestMaker
{
    /**
     * @inheritDoc
     */
    protected function getDescription () : string
    {
        return "Generates a Test for a Command Handler.";
    }

    /**
     * @inheritDoc
     */
    protected function getDependencies () : array
    {
        return [
            DomainEventTestTrait::class => "becklyn/ddd-core",
            TransactionManagerTestTrait::class => "becklyn/ddd-core",
            TestCase::class => "phpunit/phpunit",
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getEntitySuffix (array $variables = []) : string
    {
        // should be named ${ActionName}${EntityName}HandlerTest in english
        // else ${EntityName}${ActionName}HandlerTest
        if ($variables["domain_language"] == "en") {
            return "HandlerTest";
        }
        return $variables["extra"]["command_action"] . "HandlerTest";
    }


    /**
     * @inheritDoc
     */
    protected function getEntityPrefix (array $variables = []) : string
    {
        // should be named ${ActionName}${EntityName}HandlerTest in english
        // else ${EntityName}${ActionName}HandlerTest
        if ($variables["domain_language"] == "en") {
            return $variables["extra"]["command_action"];
        }
        return "";
    }
}

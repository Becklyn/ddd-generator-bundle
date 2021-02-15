<?php declare(strict_types=1);

namespace C201\DddGeneratorBundle\Maker\Command;

use C201\Ddd\Events\Testing\DomainEventTestTrait;
use C201\Ddd\Transactions\Testing\TransactionManagerTestTrait;
use C201\DddGeneratorBundle\Maker\DddEntityCommandTestMaker;
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
            DomainEventTestTrait::class => "201created/ddd",
            TransactionManagerTestTrait::class => "201created/ddd",
            TestCase::class => "phpunit/phpunit",
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getEntitySuffix (array $variables = []) : string
    {
        return $variables["extra"]["command_action"] . "HandlerTest";
    }
}

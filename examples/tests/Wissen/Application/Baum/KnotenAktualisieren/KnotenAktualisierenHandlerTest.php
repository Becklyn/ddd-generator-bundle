<?php

namespace App\Tests\Wissen\Application\Baum\KnotenAktualisieren;

use App\Tests\Wissen\Domain\Baum\KnotenTestTrait;
use App\Wissen\Application\Baum\KnotenAktualisieren\KnotenAktualisierenCommand;
use App\Wissen\Application\Baum\KnotenAktualisieren\KnotenAktualisierenHandler;
use App\Wissen\Domain\Baum\Knoten;
use App\Wissen\Domain\Baum\KnotenId;
use C201\Ddd\Events\Domain\DomainEventTestTrait;
use C201\Ddd\Transactions\Application\TransactionManagerTestTrait;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * @covers \App\Wissen\Application\Baum\KnotenAktualisieren\KnotenAktualisierenHandler
 * @covers \App\Wissen\Application\Baum\KnotenAktualisieren\KnotenAktualisierenCommand
 */
class KnotenAktualisierenHandlerTest extends TestCase
{
    use KnotenTestTrait;
    use TransactionManagerTestTrait;
    use DomainEventTestTrait;

    private KnotenAktualisierenHandler $fixture;

    protected function setUp(): void
    {
        $this->initKnotenTestTrait();
        $this->initTransactionManagerTestTrait();
        $this->initDomainEventTestTrait();

        // TODO inject dependencies
        $this->fixture = new KnotenAktualisierenHandler();
        $this->fixture->setTransactionManager($this->transactionManager->reveal());
        $this->fixture->setEventRegistry($this->eventRegistry->reveal());
    }

    public function testTodo(): void
    {
        // TODO implement
    }

    // TODO implement additional tests
}

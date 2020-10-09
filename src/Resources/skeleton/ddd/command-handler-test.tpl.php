<?= "<?php declare(strict_types=1);"; ?><?= "\n"; ?>

namespace <?= $namespace; ?>;

use <?= $psr4Root; ?>\Tests\<?= $domain; ?>\Domain\<?= $domain_namespace; ?><?= $entity; ?>TestTrait;
use <?= $psr4Root; ?>\<?= $domain; ?>\Application\<?= $domain_namespace; ?><?= $entity; ?><?= $extra["command_action"]; ?>\<?= $entity; ?><?= $extra["command_action"]; ?>Handler;
use C201\Ddd\Events\Domain\DomainEventTestTrait;
use C201\Ddd\Transactions\Application\TransactionManagerTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @author <?= $author; ?><?= "\n"; ?>
 *
 * @since <?= $version; ?><?= "\n"; ?>
 *
 * @covers \<?= $psr4Root; ?>\<?= $domain; ?>\Application\<?= $domain_namespace; ?><?= $entity; ?><?= $extra["command_action"]; ?>\<?= $entity; ?><?= $extra["command_action"]; ?>Command;
 * @covers \<?= $psr4Root; ?>\<?= $domain; ?>\Application\<?= $domain_namespace; ?><?= $entity; ?><?= $extra["command_action"]; ?>\<?= $entity; ?><?= $extra["command_action"]; ?>Handler;
 */
class <?= $class_name; ?> extends TestCase
{
    use <?= $entity; ?>TestTrait;
    use TransactionManagerTestTrait;
    use DomainEventTestTrait;

    private <?= $entity; ?><?= $extra["command_action"]; ?>Handler $fixture;

    protected function setUp () : void
    {
        $this->init<?= $entity; ?>TestTrait();
        $this->initTransactionManagerTestTrait();
        $this->initDomainEventTestTrait();

        // TODO inject dependencies
        $this->fixture = new <?= $entity; ?><?= $extra["command_action"]; ?>Handler();
        $this->fixture->setTransactionManager($this->transactionManager->reveal());
        $this->fixture->setEventRegistry($this->eventRegistry->reveal());
    }

    // TODO implement test cases for
}

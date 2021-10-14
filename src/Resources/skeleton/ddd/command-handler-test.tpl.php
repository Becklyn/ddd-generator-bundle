<?= "<?php declare(strict_types=1);"; ?><?= "\n"; ?>

namespace <?= $namespace; ?>;

use <?= $psr4Root; ?>\Tests\<?= $domain; ?>\Domain\<?= $domain_namespace; ?><?= $entity; ?>TestTrait;
use <?= $psr4Root; ?>\<?= $domain; ?>\Application\<?= $domain_namespace; ?><?= $extra["command_namespace"]; ?>\<?= $extra["command_namespace"]; ?>Handler;
use Becklyn\Ddd\Commands\Testing\CommandHandlerTestTrait;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @author <?= $author; ?><?= "\n"; ?>
 *
 * @since <?= $version; ?><?= "\n"; ?>
 *
 * @covers \<?= $psr4Root; ?>\<?= $domain; ?>\Application\<?= $domain_namespace; ?><?= $extra["command_namespace"]; ?>\<?= $extra["command_namespace"]; ?>Command
 * @covers \<?= $psr4Root; ?>\<?= $domain; ?>\Application\<?= $domain_namespace; ?><?= $extra["command_namespace"]; ?>\<?= $extra["command_namespace"]; ?>Handler
 */
class <?= $class_name; ?> extends TestCase
{
    use ProphecyTrait;
    use <?= $entity; ?>TestTrait;
    use CommandHandlerTestTrait;

    /** @var <?= $extra["command_namespace"]; ?>Handler $fixture */
    protected $fixture;

    protected function setUp () : void
    {
        $this->init<?= $entity; ?>TestTrait();
        $this->initCommandHandlerTestTrait();

        // TODO inject dependencies
        $this->fixture = new <?= $extra["command_namespace"]; ?>Handler();
        $this->commandHandlerPostSetUp();
    }

    // TODO implement test cases for <?= $class_name; ?><?= "\n"; ?>
}

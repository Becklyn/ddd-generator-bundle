<?= "<?php declare(strict_types=1);"; ?><?= "\n"; ?>

namespace <?= $namespace; ?>;

use <?= $psr4Root; ?>\Tests\<?= $domain; ?>\Domain\<?= $domain_namespace; ?><?= $entity; ?>TestTrait;
use <?= $psr4Root; ?>\<?= $domain; ?>\Application\<?= $domain_namespace; ?><?= $extra["command_namespace"]; ?>\<?= $extra["command_namespace"]; ?>Command;
use <?= $psr4Root; ?>\<?= $domain; ?>\Application\<?= $domain_namespace; ?><?= $extra["command_namespace"]; ?>\<?= $extra["command_namespace"]; ?>Handler;
use Becklyn\Ddd\Commands\Testing\CommandHandlerTestTrait;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;

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
        $this->fixture = new <?= $extra["command_namespace"]; ?>Handler(
            $this-><?= $strtocamel($entity); ?>Repository->reveal()
        );
        $this->commandHandlerPostSetUp();
    }

    public function test_TESTED_LOGIC_Is_ACTIONED_And<?= $entity; ?>IsDequeuedByEventRegistry() : void
    {
        $<?= $strtocamel($entity); ?>Id = $this->given<?= $entity; ?>Id();
        // TODO add additional command params
        $<?= $strtocamel($entity); ?> = $this->given<?= $entity; ?>CanBeFoundById($<?= $strtocamel($entity); ?>Id);
        $this->then_SOMETHING_ShouldBe_ACTIONED_($<?= $strtocamel($entity); ?> /** TODO additional params **/);
        $this->then<?= $entity; ?>ShouldBeDequeuedByEventRegistry($<?= $strtocamel($entity); ?>->reveal());
        $this->when<?= $extra["command_namespace"]; ?>IsHandled($<?= $strtocamel($entity); ?>Id /** TODO additional command params **/);
    }

    private function then_SOMETHING_ShouldBe_ACTIONED_(ObjectProphecy | <?= $entity; ?> $<?= $strtocamel($entity); ?> /** TODO additional params **/) : void
    {
        $<?= $strtocamel($entity); ?>->_DO_ACTION_(/** TODO add params **/)->shouldBeCalled();
    }

    private function when<?= $extra["command_namespace"]; ?>IsHandled(<?= $entity; ?>Id $<?= $strtocamel($entity); ?>Id /** TODO additional command params **/) : void
    {
        $this->fixture->handle(new <?= $extra["command_namespace"]; ?>($<?= $strtocamel($entity); ?>Id /** TODO additional command params **/));
    }

    // TODO implement test cases for <?= $class_name; ?><?= "\n"; ?>
}

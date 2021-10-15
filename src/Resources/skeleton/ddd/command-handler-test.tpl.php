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

    public function test_TESTED_LOGIC_IS_ACTIONED_<?= $i18n["test"]["and"]; ?><?= $entity; ?><?= $i18n["test"]["is"]; ?><?= $i18n["test"]["dequeued_by_event_registry"]; ?>() : void
    {
        $<?= $strtocamel($entity); ?>Id = $this-><?= $i18n["test"]["_given"]; ?><?= $entity; ?>Id();
        // TODO add additional command params
        $<?= $strtocamel($entity); ?> = $this-><?= $i18n["test"]["_given"]; ?>?= $entity; ?><?= $i18n["test"]["can_be_found_by_id"]; ?>($<?= $strtocamel($entity); ?>Id);
        $this-><?= $i18n["test"]["_then"]; ?>_SOMETHING_<?= $i18n["test"]["should"]; ?>_ACTIONED_($<?= $strtocamel($entity); ?> /** TODO additional params **/);
        $this-><?= $i18n["test"]["_then"]; ?><?= $entity; ?><?= $i18n["test"]["should"]; ?><?= $i18n["test"]["dequeued_by_event_registry"]; ?>($<?= $strtocamel($entity); ?>->reveal());
        $this-><?= $i18n["test"]["_when"]; ?><?= $extra["command_namespace"]; ?><?= $i18n["test"]["is_handled"]; ?>($<?= $strtocamel($entity); ?>Id /** TODO additional command params **/);
    }

    private function <?= $i18n["test"]["_then"]; ?>_SOMETHING_<?= $i18n["test"]["should"]; ?>_ACTIONED_(ObjectProphecy | <?= $entity; ?> $<?= $strtocamel($entity); ?> /** TODO additional params **/) : void
    {
        $<?= $strtocamel($entity); ?>->_DO_ACTION_(/** TODO add params **/)->shouldBeCalled();
    }

    private function when<?= $extra["command_namespace"]; ?>IsHandled(<?= $entity; ?>Id $<?= $strtocamel($entity); ?>Id /** TODO additional command params **/) : void
    {
        $this->fixture->handle(new <?= $extra["command_namespace"]; ?>($<?= $strtocamel($entity); ?>Id /** TODO additional command params **/));
    }

    // TODO implement test cases for <?= $class_name; ?><?= "\n"; ?>
}

<?= "<?php declare(strict_types=1);\n"; ?>

namespace <?= $namespace; ?>;

use <?= $psr4Root; ?>\<?= $domain; ?>\Domain\<?= $domain_namespace; ?><?= $entity; ?>;
use <?= $psr4Root; ?>\<?= $domain; ?>\Domain\<?= $domain_namespace; ?><?= $entity; ?><?= $i18n["created"]; ?>;
use PHPUnit\Framework\TestCase;

/**
 * @author <?= $author; ?><?= "\n"; ?>
 *
 * @since <?= $version; ?><?= "\n"; ?>
 *
 * @covers \<?= $psr4Root; ?>\<?= $domain; ?>\Domain\<?= $domain_namespace; ?><?= $entity; ?><?= "\n"; ?>
 * @covers \<?= $psr4Root; ?>\<?= $domain; ?>\Domain\<?= $domain_namespace; ?><?= $entity; ?><?= $i18n["created"]; ?><?= "\n"; ?>
 * @covers \<?= $psr4Root; ?>\<?= $domain; ?>\Domain\<?= $domain_namespace; ?><?= $entity; ?>Event
 */
class <?= $class_name; ?> extends TestCase
{
    use <?= $entity; ?>TestTrait;

    public function testCreate<?=$i18n['test']['returns']; ?><?= $entity; ?><?= $i18n["test"]["with_correct_values"]; ?> () : void
    {
        $id = $this-><?= $i18n["test"]["_given"]; ?><?= $entity; ?>Id();
        // TODO implement additional properties

        $<?= $strtocamel($entity); ?> = $this-><?= $i18n["test"]["_given"]; ?><?= $entity; ?><?= $i18n["test"]["is_created"]; ?>($id);

        $this->assertTrue($id->equals($<?= $strtocamel($entity); ?>->id()));
        // TODO implement asserts for additional properties which have getters
    }

    public function testCreate<?= $i18n["test"]["raises"]; ?><?= $entity; ?><?= $i18n["created"]; ?>Event () : void
    {
        $id = $this-><?= $i18n["test"]["_given"]; ?><?= $entity; ?>Id();
        // TODO implement additional properties

        $<?= $strtocamel($entity); ?> = $this-><?= $i18n["test"]["_given"]; ?><?= $entity; ?><?= $i18n["test"]["is_created"]; ?>($id);

        $events = $<?= $strtocamel($entity); ?>->dequeueEvents();
        $this->assertCount(1, $events);
        $this->assertContainsOnly(<?= $entity; ?><?= $i18n["created"]; ?>::class, $events);

        /** @var <?= $entity; ?><?= $i18n["created"]; ?> $event */
        $event = $events[0];
        $this->assertTrue($id->equals($event->aggregateId()));
        $this->assertEquals(<?= $entity; ?>::class, $event->aggregateType());
        // TODO implement asserts for additional properties in event
    }
}

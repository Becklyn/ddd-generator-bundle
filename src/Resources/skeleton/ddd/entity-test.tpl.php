<?= "<?php declare(strict_types=1);\n"; ?>

namespace <?= $namespace; ?>;

use <?= $psr4Root; ?>\<?= $domain; ?>\Domain\<?= $domain_namespace; ?><?= $entity; ?>;
use <?= $psr4Root; ?>\<?= $domain; ?>\Domain\<?= $domain_namespace; ?><?= $entity; ?><?= $i18n["generated"]; ?>;
use PHPUnit\Framework\TestCase;

/**
 * @author <?= $author; ?><?= "\n"; ?>
 *
 * @since <?= $version; ?><?= "\n"; ?>
 *
 * @covers \<?= $psr4Root; ?>\<?= $domain; ?>\Domain\<?= $domain_namespace; ?><?= $entity; ?><?= "\n"; ?>
 * @covers \<?= $psr4Root; ?>\<?= $domain; ?>\Domain\<?= $domain_namespace; ?><?= $entity; ?><?= $i18n["generated"]; ?><?= "\n"; ?>
 * @covers \<?= $psr4Root; ?>\<?= $domain; ?>\Domain\<?= $domain_namespace; ?><?= $entity; ?>Event
 */
class <?= $class_name; ?> extends TestCase
{
    use <?= $entity; ?>TestTrait;

    public function test<?= $entity; ?><?= $i18n["test"]["is_generated_with_correct_values"]; ?> () : void
    {
        $id = $this-><?= $i18n["test"]["_get"]; ?><?= $entity; ?>Id();
        // TODO implement additional properties

        $<?= \strtolower($entity); ?> = <?= $entity; ?>::<?= $i18n["_generate"]; ?>($id);

        $this->assertTrue($id->equals($<?= \strtolower($entity); ?>->id()));
        // TODO implement asserts for additional properties which have getters
    }

    public function testCreate<?= $i18n["test"]["generate"]; ?><?= $entity; ?><?= $i18n["test"]["raises_event"]; ?> () : void
    {
        $id = $this-><?= $i18n["test"]["_get"]; ?><?= $entity; ?>Id();
        // TODO implement additional properties

        $<?= \strtolower($entity); ?> = <?= $entity; ?>::<?= $i18n["_generate"]; ?>($id);

        $events = $<?= \strtolower($entity); ?>->dequeueEvents();
        $this->assertCount(1, $events);
        $this->assertContainsOnly(<?= $entity; ?><?= $i18n["generated"]; ?>::class, $events);

        /** @var <?= $entity; ?><?= $i18n["generated"]; ?> $event */
        $event = $events[0];
        $this->assertTrue($id->equals($event->aggregateId()));
        $this->assertEquals(<?= $entity; ?>::class, $event->aggregateType());
        // TODO implement asserts for additional properties in event
    }
}

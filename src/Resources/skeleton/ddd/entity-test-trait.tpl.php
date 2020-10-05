<?= "<?php declare(strict_types=1);\n"; ?>

namespace <?= $namespace; ?>;

use <?= $psr4Root; ?>\<?= $domain; ?>\Domain\<?= $domain_namespace; ?><?= $entity; ?>;
use <?= $psr4Root; ?>\<?= $domain; ?>\Domain\<?= $domain_namespace; ?><?= $entity; ?>Id;
use <?= $psr4Root; ?>\<?= $domain; ?>\Domain\<?= $domain_namespace; ?><?= $entity; ?><?= $i18n["not_found"]; ?>Exception;
use <?= $psr4Root; ?>\<?= $domain; ?>\Domain\<?= $domain_namespace; ?><?= $entity; ?>Repository;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * @author <?= $author; ?><?= "\n"; ?>
 *
 * @since <?= $version; ?><?= "\n"; ?>
 */
trait <?= $class_name; ?><?= "\n"; ?>
{
    /**
     * @var ObjectProphecy|<?= $entity; ?>Repository
     */
    protected ObjectProphecy $<?= \strtolower($entity); ?>Repository;

    protected function init<?= $entity; ?>TestTrait () : void
    {
        $this-><?= \strtolower($entity); ?>Repository = $this->prophesize(<?= $entity; ?>Repository::class);
    }

    protected function <?= $i18n["test"]["_get"]; ?><?= $entity; ?>Id () : <?= $entity; ?>Id
    {
        return <?= $entity; ?>Id::next();
    }

    /**
     * @return ObjectProphecy|<?= $entity; ?><?= "\n"; ?>
     */
    protected function <?= $i18n["test"]["_get"]; ?><?= $entity; ?> () : ObjectProphecy
    {
        /** @var ObjectProphecy|<?= $entity; ?> $<?= \strtolower($entity); ?> */
        $<?= \strtolower($entity); ?> = $this->prophesize(<?= $entity; ?>::class);
        return $<?= \strtolower($entity); ?>;
    }

    /**
     * @param ObjectProphecy|<?= $entity; ?> $<?= \strtolower($entity); ?><?= "\n"; ?>
     */
    protected function <?= $i18n["test"]["_if"]; ?><?= $entity; ?>Id<?= $i18n["test"]["matches"]; ?> (ObjectProphecy $<?= \strtolower($entity); ?>, <?= $entity; ?>Id $id) : void
    {
        $<?= \strtolower($entity); ?>->id()->willReturn($id);
    }

    /**
     * @return ObjectProphecy|<?= $entity; ?><?= "\n"; ?>
     */
    protected function <?= $i18n["test"]["_if"]; ?><?= $entity; ?><?= $i18n["test"]["can_be_found_by_id"]; ?> (<?= $entity; ?>Id $<?= \strtolower($entity); ?>Id) : ObjectProphecy
    {
        $<?= \strtolower($entity); ?> = $this-><?= $i18n["test"]["_get"]; ?><?= $entity; ?>();
        $this-><?= $i18n["test"]["_if"]; ?><?= $entity; ?>Id<?= $i18n["test"]["matches"]; ?>($<?= \strtolower($entity); ?>, $<?= \strtolower($entity); ?>Id);
        $this-><?= \strtolower($entity); ?>Repository->findOneById($<?= \strtolower($entity); ?>Id)->willReturn($<?= \strtolower($entity); ?>->reveal());
        return $<?= \strtolower($entity); ?>;
    }

    protected function <?= $i18n["test"]["_if"]; ?><?= $entity; ?><?= $i18n["test"]["cannot_be_found_by_id"]; ?> (<?= $entity; ?>Id $<?= \strtolower($entity); ?>Id) : void
    {
        $this-><?= \strtolower($entity); ?>Repository->findOneById($<?= \strtolower($entity); ?>Id)->willThrow(new <?= $entity; ?><?= $i18n["not_found"]; ?>Exception());
    }
}

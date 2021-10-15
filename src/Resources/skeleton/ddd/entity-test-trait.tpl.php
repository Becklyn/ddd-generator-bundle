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
    protected ObjectProphecy|<?= $entity; ?>Repository $<?= $strtocamel($entity); ?>Repository;

    protected function init<?= $entity; ?>TestTrait () : void
    {
        $this-><?= $strtocamel($entity); ?>Repository = $this->prophesize(<?= $entity; ?>Repository::class);
    }

    protected function <?= $i18n["test"]["_given"]; ?><?= $entity; ?>Id () : <?= $entity; ?>Id
    {
        return <?= $entity; ?>Id::next();
    }

    protected function <?= $i18n["test"]["_given"]; ?><?= $entity; ?> () : ObjectProphecy|<?= $entity; ?><?= "\n"; ?>
    {
        /** @var ObjectProphecy|<?= $entity; ?> $<?= $strtocamel($entity); ?> */
        $<?= $strtocamel($entity); ?> = $this->prophesize(<?= $entity; ?>::class);
        return $<?= $strtocamel($entity); ?>;
    }

    protected function <?= $i18n["test"]["_given"]; ?><?= $entity; ?>Id<?= $i18n["test"]["matches"]; ?> (ObjectProphecy|<?= $entity; ?> $<?= $strtocamel($entity); ?>, <?= $entity; ?>Id $id) : void
    {
        $<?= $strtocamel($entity); ?>->id()->willReturn($id);
    }

    protected function <?= $i18n["test"]["_given"]; ?><?= $entity; ?><?= $i18n["test"]["can_be_found_by_id"]; ?> (<?= $entity; ?>Id $<?= $strtocamel($entity); ?>Id) : ObjectProphecy|<?= $entity; ?><?= "\n"; ?>
    {
        $<?= $strtocamel($entity); ?> = $this-><?= $i18n["test"]["_given"]; ?><?= $entity; ?>();
        $this-><?= $i18n["test"]["_given"]; ?><?= $entity; ?>Id<?= $i18n["test"]["matches"]; ?>($<?= $strtocamel($entity); ?>, $<?= $strtocamel($entity); ?>Id);
        $this-><?= $strtocamel($entity); ?>Repository->findOneById($<?= $strtocamel($entity); ?>Id)->willReturn($<?= $strtocamel($entity); ?>->reveal());
        return $<?= $strtocamel($entity); ?>;
    }

    protected function <?= $i18n["test"]["_given"]; ?><?= $entity; ?><?= $i18n["test"]["cannot_be_found_by_id"]; ?> (<?= $entity; ?>Id $<?= $strtocamel($entity); ?>Id) : void
    {
        $this-><?= $strtocamel($entity); ?>Repository->findOneById($<?= $strtocamel($entity); ?>Id)->willThrow(new <?= $entity; ?><?= $i18n["not_found"]; ?>Exception());
    }

    protected function <?= $i18n["test"]["_given"]; ?><?= $entity; ?><?= $i18n["test"]["is_created"]; ?> (
        ?<?= $entity; ?>Id $<?= $strtocamel($entity); ?>Id = null,
        // TODO add additional properties
    ) : <?= $entity; ?> {
        return <?= $entity; ?>::create(
            $<?= $strtocamel($entity); ?>Id ?? $this-><?= $i18n["test"]["_given"]; ?><?= $entity; ?>Id(),
            // TODO add additional properties
        );
    }

    protected function then<?= $entity; ?>ShouldBeDequeuedByEventRegistry($<?= $strtocamel($entity); ?>) : void
    {
        $this->thenEventRegistryShouldDequeueAndRegister($<?= $strtocamel($entity); ?>);
    }
}

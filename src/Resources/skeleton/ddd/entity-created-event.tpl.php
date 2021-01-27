<?= "<?php declare(strict_types=1);\n"; ?>

namespace <?= $namespace; ?>;

use C201\Ddd\Events\Domain\EventId;

/**
 * @author <?= $author; ?><?= "\n"; ?>
 *
 * @since <?= $version; ?><?= "\n"; ?>
 */
class <?= $class_name; ?> extends <?= $entity; ?>Event
{
    public function __construct (
        EventId $id,
        \DateTimeImmutable $raisedTs,
        <?= $entity; ?>Id $<?= \strtolower($entity); ?>Id
    )
    {
        parent::__construct($id, $raisedTs, $<?= \strtolower($entity); ?>Id);

        // TODO add additional properties
    }
}

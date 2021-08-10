<?= "<?php declare(strict_types=1);\n"; ?>

namespace <?= $namespace; ?>;

use Becklyn\Ddd\Events\Domain\AbstractDomainEvent;
use Becklyn\Ddd\Events\Domain\EventId;

/**
 * @author <?= $author; ?><?= "\n"; ?>
 *
 * @since <?= $version; ?><?= "\n"; ?>
 */
abstract class <?= $class_name; ?> extends AbstractDomainEvent
{
    public function __construct (
        EventId $id,
        \DateTimeImmutable $raisedTs,
        protected <?= $entity; ?>Id $<?= $strtocamel($entity); ?>Id,
    ) {
        parent::__construct($id, $raisedTs);
    }

    public function aggregateId () : <?= $entity; ?>Id
    {
        return $this-><?= $strtocamel($entity); ?>Id;
    }

    public function aggregateType () : string
    {
        return <?= $entity; ?>::class;
    }
}

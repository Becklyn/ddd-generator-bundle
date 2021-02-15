<?= "<?php declare(strict_types=1);\n"; ?>

namespace <?= $namespace; ?>;

use C201\Ddd\Events\Domain\AbstractDomainEvent;
use C201\Ddd\Events\Domain\EventId;

/**
 * @author <?= $author; ?><?= "\n"; ?>
 *
 * @since <?= $version; ?><?= "\n"; ?>
 */
abstract class <?= $class_name; ?> extends AbstractDomainEvent
{
    protected <?= $entity; ?>Id $<?= $strtocamel($entity); ?>Id;

    public function __construct (EventId $id, \DateTimeImmutable $raisedTs, <?= $entity; ?>Id $<?= $strtocamel($entity); ?>Id)
    {
        parent::__construct($id, $raisedTs);
        $this-><?= $strtocamel($entity); ?>Id = $<?= $strtocamel($entity); ?>Id;
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

<?php

namespace App\Wissen\Domain\Baum;

use Becklyn\Ddd\Events\Domain\AbstractDomainEvent;
use Becklyn\Ddd\Events\Domain\EventId;

class KnotenEvent extends AbstractDomainEvent
{
    protected KnotenId $knotenId;

    public function __construct(EventId $id, \DateTimeImmutable $raisedTs, KnotenId $knotenId)
    {
        parent::__construct($id, $raisedTs);
        $this->knotenId = $knotenId;
    }

    public function aggregateId(): KnotenId
    {
        return $this->knotenId;
    }

    public function aggregateType(): string
    {
        return Knoten::class;
    }
}

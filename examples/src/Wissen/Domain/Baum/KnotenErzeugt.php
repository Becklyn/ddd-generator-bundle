<?php

namespace App\Wissen\Domain\Baum;

use Becklyn\Ddd\Events\Domain\EventId;

class KnotenErzeugt extends KnotenEvent
{
    public function __construct(
        EventId $id,
        \DateTimeImmutable $raisedTs,
        KnotenId $knotenId
    ) {
        parent::__construct($id, $raisedTs, $knotenId);

        // TODO add additional properties
    }
}

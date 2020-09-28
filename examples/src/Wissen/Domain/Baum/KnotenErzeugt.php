<?php

namespace App\Wissen\Domain\Baum;

use C201\Ddd\Events\Domain\EventId;

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

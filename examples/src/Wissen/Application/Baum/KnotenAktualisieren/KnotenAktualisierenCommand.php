<?php

namespace App\Wissen\Application\Baum\KnotenAktualisieren;

use App\Wissen\Domain\Baum\KnotenId;

class KnotenAktualisierenCommand
{
    public function __construct(
        private KnotenId $knotenId,
        // TODO add additional properties
    ) {}

    public function knotenId(): KnotenId
    {
        return $this->knotenId;
    }
}

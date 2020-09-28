<?php

namespace App\Wissen\Application\Baum\KnotenAktualisieren;

use App\Wissen\Domain\Baum\KnotenId;

class KnotenAktualisierenCommand
{
    private KnotenId $knotenId;

    public function __construct(KnotenId $knotenId)
    {
        $this->knotenId = $knotenId;

        // TODO add additional properties
    }

    public function knotenId(): KnotenId
    {
        return $this->knotenId;
    }
}

<?php

namespace App\Wissen\Domain\Baum;

interface KnotenRepository
{
    public function nextIdentity(): KnotenId;

    public function add(Knoten $knoten): void;

    public function remove(Knoten $knoten): void;

    /**
     * @throws KnotenNichtGefundenException
     */
    public function findOneById(KnotenId $knotenId): Knoten;
}

<?php

namespace App\Tests\Wissen\Domain\Baum;

use App\Wissen\Domain\Baum\Knoten;
use App\Wissen\Domain\Baum\KnotenId;
use App\Wissen\Domain\Baum\KnotenNichtGefundenException;
use App\Wissen\Domain\Baum\KnotenRepository;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * @author Marko Vujnovic <mv@201created.de>
 * @since  2020-07-02
 */
trait KnotenTestTrait
{
    protected ObjectProphecy|KnotenRepository $knotenRepository;

    protected function initKnotenTestTrait(): void
    {
        $this->knotenRepository = $this->prophesize(KnotenRepository::class);
    }

    protected function angenommenEinKnotenId(): KnotenId
    {
        return KnotenId::next();
    }

    protected function angenommenEinKnoten(): ObjectProphecy|Knoten
    {
        /** @var ObjectProphecy|Knoten $knoten */
        $knoten = $this->prophesize(Knoten::class);
        return $knoten;
    }

    protected function angenommenKnotenHatId(ObjectProphecy|Knoten $knoten, KnotenId $id): void
    {
        $knoten->id()->willReturn($id);
    }

    protected function angenommenEinKnotenKannDurchIdGefundenWerden(KnotenId $knotenId): ObjectProphecy|Knoten
    {
        $knoten = $this->angenommenEinKnoten();
        $this->angenommenKnotenHatId($knoten, $knotenId);
        $this->knotenRepository->findOneById($knotenId)->willReturn($knoten->reveal());
        return $knoten;
    }

    protected function angenommenEinKnotenKannDurchIdNichtGefundenWerden(KnotenId $knotenId): void
    {
        $this->knotenRepository->findOneById($knotenId)->willThrow(new KnotenNichtGefundenException());
    }
}

<?php

namespace App\Tests\Wissen\Infrastructure\Domain\Baum\Doctrine;

use App\Tests\Wissen\Domain\Baum\KnotenTestTrait;
use App\Wissen\Domain\Baum\Knoten;
use App\Wissen\Domain\Baum\KnotenId;
use App\Wissen\Domain\Baum\KnotenNichtGefundenException;
use App\Wissen\Infrastructure\Domain\Baum\Doctrine\DoctrineKnotenRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * @author Marko Vujnovic <mv@201created.de>
 * @since  2020-07-03
 *
 * @covers \App\Wissen\Infrastructure\Domain\Baum\Doctrine\DoctrineKnotenRepository
 */
class DoctrineKnotenRepositoryTest extends TestCase
{
    use KnotenTestTrait;

    /**
     * @var ObjectProphecy|EntityManagerInterface
     */
    private ObjectProphecy $em;

    /**
     * @var ObjectProphecy|ObjectRepository
     */
    private ObjectProphecy $doctrineRepository;

    private DoctrineKnotenRepository $fixture;

    protected function setUp(): void
    {
        $this->em = $this->prophesize(EntityManagerInterface::class);
        $this->doctrineRepository = $this->prophesize(ObjectRepository::class);
        $this->em->getRepository(Knoten::class)->willReturn($this->doctrineRepository->reveal());
        $this->fixture = new DoctrineKnotenRepository($this->em->reveal());
    }

    public function testNextIdentityGibtKnotenIdZurueck(): void
    {
        $this->assertInstanceOf(KnotenId::class, $this->fixture->nextIdentity());
    }

    public function testAddPersistiertKnotenInEntityManager(): void
    {
        /** @var Knoten $knoten */
        $knoten = $this->prophesize(Knoten::class)->reveal();
        $this->fixture->add($knoten);
        $this->em->persist($knoten)->shouldHaveBeenCalled();
    }

    public function testRemoveEntferntKnotenAusEntityManager(): void
    {
        /** @var Knoten $knoten */
        $knoten = $this->prophesize(Knoten::class)->reveal();
        $this->fixture->remove($knoten);
        $this->em->remove($knoten)->shouldHaveBeenCalled();
    }

    public function testFindOneByIdGibtKnotenDurchDoctrineRepositoryGefundenZurueck(): void
    {
        $id = $this->angenommenEinKnotenId();
        $knoten = $this->angenommenDoctrineRepositoryFindetEinKnotenDurchId($id);
        $this->dannSollteKnotenZurueckgegebenWerden(
            $knoten->reveal(),
            $this->wennFindOneByIdAusgefuehrtIst($id)
        );
    }

    /**
     * @return ObjectProphecy|Knoten
     */
    private function angenommenDoctrineRepositoryFindetEinKnotenDurchId(KnotenId $id): ObjectProphecy
    {
        /** @var Knoten $knoten */
        $knoten = $this->prophesize(Knoten::class);
        $knoten->id()->willReturn($id);
        $this->doctrineRepository->findOneBy(['id' => $id->asString()])->willReturn($knoten->reveal());
        return $knoten;
    }

    private function dannSollteKnotenZurueckgegebenWerden(Knoten $erwarteteKnoten, Knoten $zurueckgegebeneKnoten): void
    {
        $this->assertSame($erwarteteKnoten, $zurueckgegebeneKnoten);
    }

    private function wennFindOneByIdAusgefuehrtIst(KnotenId $id): Knoten
    {
        return $this->fixture->findOneById($id);
    }

    public function testFindOneByIdWirftEineKnotenNichtGefundenExceptionWennDoctrineRepositoryNullStattKnotenFuerGegebenesIdZurueckGibt(): void
    {
        $id = $this->angenommenEinKnotenId();
        $this->angenommenDoctrineRepositoryFindOneByGibtNullFuerGegebenesKnotenIdZurueck($id);
        $this->dannSollteEineKnotenNichtGefundenExceptionGeworfenWerden();
        $this->wennFindOneByIdAusgefuehrtIst($id);
    }

    private function angenommenDoctrineRepositoryFindOneByGibtNullFuerGegebenesKnotenIdZurueck(KnotenId $id): void
    {
        $this->doctrineRepository->findOneBy(['id' => $id->asString()])->willReturn(null);
    }

    private function dannSollteEineKnotenNichtGefundenExceptionGeworfenWerden(): void
    {
        $this->expectException(KnotenNichtGefundenException::class);
    }
}

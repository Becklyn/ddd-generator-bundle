<?php

namespace App\Wissen\Infrastructure\Domain\Baum\Doctrine;

use App\Wissen\Domain\Baum\Knoten;
use App\Wissen\Domain\Baum\KnotenId;
use App\Wissen\Domain\Baum\KnotenNichtGefundenException;
use App\Wissen\Domain\Baum\KnotenRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class DoctrineKnotenRepository implements KnotenRepository
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Knoten::class);
    }

    public function nextIdentity(): KnotenId
    {
        return KnotenId::next();
    }

    public function add(Knoten $knoten): void
    {
        $this->entityManager->persist($knoten);
    }

    public function remove(Knoten $knoten): void
    {
        $this->entityManager->remove($knoten);
    }

    public function findOneById(KnotenId $knotenId): Knoten
    {
        /** @var ?Knoten $knoten */
        $knoten = $this->repository->findOneBy(['id' => $knotenId->asString()]);
        if ($knoten === null) {
            throw new KnotenNichtGefundenException("Knoten '{$knotenId->asString()}' konnte nicht gefunden werden");
        }

        return $knoten;
    }
}

<?= "<?php declare(strict_types=1);\n"; ?>

namespace <?= $namespace; ?>;

use <?= $psr4Root; ?>\Tests\<?= $domain; ?>\Domain\<?= $domain_namespace; ?><?= $entity; ?>TestTrait;
use <?= $psr4Root; ?>\<?= $domain; ?>\Domain\<?= $domain_namespace; ?><?= $entity; ?>;
use <?= $psr4Root; ?>\<?= $domain; ?>\Domain\<?= $domain_namespace; ?><?= $entity; ?>Id;
use <?= $psr4Root; ?>\<?= $domain; ?>\Domain\<?= $domain_namespace; ?><?= $entity; ?><?= $i18n["not_found"]; ?>Exception;
use <?= $psr4Root; ?>\<?= $domain; ?>\Infrastructure\Domain\<?= $domain_namespace; ?>Doctrine\Doctrine<?= $entity; ?>Repository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * @author <?= $author; ?><?= "\n"; ?>
 *
 * @since <?= $version; ?><?= "\n"; ?>
 *
 * @covers \<?= $psr4Root; ?>\<?= $domain; ?>\Infrastructure\Domain\<?= $domain_namespace; ?>Doctrine\Doctrine<?= $entity; ?>Repository
 */
class <?= $class_name; ?> extends TestCase
{
    use <?= $entity; ?>TestTrait;

    /**
     * @var ObjectProphecy|EntityManagerInterface
     */
    private ObjectProphecy $em;

    /**
     * @var ObjectProphecy|ObjectRepository
     */
    private ObjectProphecy $doctrineRepository;

    private Doctrine<?= $entity; ?>Repository $fixture;

    protected function setUp () : void
    {
        $this->em = $this->prophesize(EntityManagerInterface::class);
        $this->doctrineRepository = $this->prophesize(ObjectRepository::class);
        $this->em->getRepository(<?= $entity; ?>::class)->willReturn($this->doctrineRepository->reveal());
        $this->fixture = new Doctrine<?= $entity; ?>Repository($this->em->reveal());
    }

    public function testNextIdentity<?= $i18n["test"]["returns"]; ?><?= $entity; ?>Id () : void
    {
        $this->assertInstanceOf(<?= $entity; ?>Id::class, $this->fixture->nextIdentity());
    }

    public function testAdd<?= $i18n["test"]["persists"]; ?><?= $entity; ?><?= $i18n["test"]["in"]; ?>EntityManager () : void
    {
        /** @var <?= $entity; ?> $<?= \strtolower($entity); ?> */
        $<?= \strtolower($entity); ?> = $this->prophesize(<?= $entity; ?>::class)->reveal();
        $this->fixture->add($<?= \strtolower($entity); ?>);
        $this->em->persist($<?= \strtolower($entity); ?>)->shouldHaveBeenCalled();
    }

    public function testRemove<?= $i18n["test"]["removes"]; ?><?= $entity; ?><?= $i18n["test"]["from"]; ?>EntityManager () : void
    {
        /** @var <?= $entity; ?> $<?= \strtolower($entity); ?> */
        $<?= \strtolower($entity); ?> = $this->prophesize(<?= $entity; ?>::class)->reveal();
        $this->fixture->remove($<?= \strtolower($entity); ?>);
        $this->em->remove($<?= \strtolower($entity); ?>)->shouldHaveBeenCalled();
    }

    public function testFindOneById<?= $i18n["test"]["returns"]; ?><?= $entity; ?><?= $i18n["test"]["from"]; ?>DoctrineRepository () : void
    {
        $id = $this-><?= $i18n["test"]["_get"]; ?><?= $entity; ?>Id();
        $<?= \strtolower($entity); ?> = $this-><?= $i18n["test"]["_if"]; ?>DoctrineRepository<?= $i18n["test"]["did_find"]; ?><?= $entity; ?><?= $i18n["test"]["by_id"]; ?>($id);
        $this-><?= $i18n["test"]["_then"]; ?><?= $i18n["test"]["expect"]; ?><?= $entity; ?><?= $i18n["test"]["matches"]; ?>(
            $<?= \strtolower($entity); ?>->reveal(),
            $this-><?= $i18n["test"]["_if"]; ?>FindOneById<?= $i18n["test"]["was_executed"]; ?>($id)
        );
    }

    /**
     * @return ObjectProphecy|<?= $entity; ?>
     */
    private function <?= $i18n["test"]["_if"]; ?>DoctrineRepository<?= $i18n["test"]["did_find"]; ?><?= $entity; ?><?= $i18n["test"]["by_id"]; ?> (<?= $entity; ?>Id $id) : ObjectProphecy
    {
        /** @var <?= $entity; ?> $<?= \strtolower($entity); ?> */
        $<?= \strtolower($entity); ?> = $this->prophesize(<?= $entity; ?>::class);
        $<?= \strtolower($entity); ?>->id()->willReturn($id);
        $this->doctrineRepository->findOneBy(['id' => $id->asString()])->willReturn($<?= \strtolower($entity); ?>->reveal());

        return $<?= \strtolower($entity); ?>;
    }

    private function <?= $i18n["test"]["_then"]; ?><?= $i18n["test"]["expect"]; ?><?= $entity; ?><?= $i18n["test"]["matches"]; ?> (<?= $entity; ?> $<?= $i18n["test"]["_expected"]; ?>, <?= $entity; ?> $<?= $i18n["test"]["_actual"]; ?>) : void
    {
        $this->assertSame($<?= $i18n["test"]["_expected"]; ?>, $<?= $i18n["test"]["_actual"]; ?>);
    }

    private function <?= $i18n["test"]["_if"]; ?>FindOneById<?= $i18n["test"]["was_executed"]; ?> (<?= $entity; ?>Id $id) : <?= $entity; ?><?= "\n"; ?>
    {
        return $this->fixture->findOneById($id);
    }

    public function testFindOneById<?= $i18n["test"]["throws"]; ?><?= $entity; ?><?= $i18n["not_found"]; ?>Exception<?= $i18n["test"]["if"]; ?>DoctrineRepository<?= $i18n["test"]["returns_null"]; ?><?= $i18n["test"]["instead_of"]; ?><?= $entity; ?> () : void
    {
        $id = $this-><?= $i18n["test"]["_get"]; ?><?= $entity; ?>Id();
        $this-><?= $i18n["test"]["_if"]; ?>DoctrineRepositoryFindOneBy<?= $i18n["test"]["returns"]; ?>null<?= $i18n["test"]["for_given"]; ?><?= $entity; ?>Id($id);
        $this-><?= $i18n["test"]["_then"]; ?><?= $i18n["test"]["expect"]; ?><?= $entity; ?><?= $i18n["not_found"]; ?>Exception();
        $this-><?= $i18n["test"]["_if"]; ?>FindOneById<?= $i18n["test"]["was_executed"]; ?>($id);
    }

    private function <?= $i18n["test"]["_if"]; ?>DoctrineRepositoryFindOneBy<?= $i18n["test"]["returns"]; ?>null<?= $i18n["test"]["for_given"]; ?><?= $entity; ?>Id (<?= $entity; ?>Id $id) : void
    {
        $this->doctrineRepository->findOneBy(['id' => $id->asString()])->willReturn(null);
    }

    private function <?= $i18n["test"]["_then"]; ?><?= $i18n["test"]["expect"]; ?><?= $entity; ?><?= $i18n["not_found"]; ?>Exception () : void
    {
        $this->expectException(<?= $entity; ?><?= $i18n["not_found"]; ?>Exception::class);
    }
}

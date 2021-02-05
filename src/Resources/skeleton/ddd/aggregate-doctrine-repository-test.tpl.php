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
        /** @var <?= $entity; ?> $<?= $strtocamel($entity); ?> */
        $<?= $strtocamel($entity); ?> = $this->prophesize(<?= $entity; ?>::class)->reveal();
        $this->fixture->add($<?= $strtocamel($entity); ?>);
        $this->em->persist($<?= $strtocamel($entity); ?>)->shouldHaveBeenCalled();
    }

    public function testRemove<?= $i18n["test"]["removes"]; ?><?= $entity; ?><?= $i18n["test"]["from"]; ?>EntityManager () : void
    {
        /** @var <?= $entity; ?> $<?= $strtocamel($entity); ?> */
        $<?= $strtocamel($entity); ?> = $this->prophesize(<?= $entity; ?>::class)->reveal();
        $this->fixture->remove($<?= $strtocamel($entity); ?>);
        $this->em->remove($<?= $strtocamel($entity); ?>)->shouldHaveBeenCalled();
    }

    public function testFindOneById<?= $i18n["test"]["returns"]; ?><?= $entity; ?><?= $i18n["test"]["from"]; ?>DoctrineRepository () : void
    {
        $id = $this-><?= $i18n["test"]["_given"]; ?><?= $entity; ?>Id();
        $<?= $strtocamel($entity); ?> = $this-><?= $i18n["test"]["_given"]; ?>DoctrineRepository<?= $i18n["test"]["finds"]; ?><?= $entity; ?><?= $i18n["test"]["by_id"]; ?>($id);
        $this-><?= $i18n["test"]["_then"]; ?><?= $i18n["test"]["should"]; ?><?= $entity; ?><?= $i18n["test"]["be_returned"]; ?>(
            $<?= $strtocamel($entity); ?>->reveal(),
            $this-><?= $i18n["test"]["_when"]; ?>FindOneById<?= $i18n["test"]["was_executed"]; ?>($id)
        );
    }

    /**
     * @return ObjectProphecy|<?= $entity; ?><?= "\n"; ?>
     */
    private function <?= $i18n["test"]["_given"]; ?>DoctrineRepository<?= $i18n["test"]["finds"]; ?><?= $entity; ?><?= $i18n["test"]["by_id"]; ?> (<?= $entity; ?>Id $id) : ObjectProphecy
    {
        /** @var <?= $entity; ?> $<?= $strtocamel($entity); ?> */
        $<?= $strtocamel($entity); ?> = $this->prophesize(<?= $entity; ?>::class);
        $<?= $strtocamel($entity); ?>->id()->willReturn($id);
        $this->doctrineRepository->findOneBy(['id' => $id->asString()])->willReturn($<?= $strtocamel($entity); ?>->reveal());

        return $<?= $strtocamel($entity); ?>;
    }

    private function <?= $i18n["test"]["_then"]; ?><?= $i18n["test"]["should"]; ?><?= $entity; ?><?= $i18n["test"]["be_returned"]; ?> (<?= $entity; ?> $<?= $i18n["test"]["_expected"]; ?>, <?= $entity; ?> $<?= $i18n["test"]["_actual"]; ?>) : void
    {
        $this->assertSame($<?= $i18n["test"]["_expected"]; ?>, $<?= $i18n["test"]["_actual"]; ?>);
    }

    private function <?= $i18n["test"]["_when"]; ?>FindOneById<?= $i18n["test"]["was_executed"]; ?> (<?= $entity; ?>Id $id) : <?= $entity; ?><?= "\n"; ?>
    {
        return $this->fixture->findOneById($id);
    }

    public function testFindOneById<?= $i18n["test"]["throws"]; ?><?= $entity; ?><?= $i18n["not_found"]; ?>Exception<?= $i18n["test"]["if"]; ?>DoctrineRepository<?= $i18n["test"]["returns_null"]; ?><?= $i18n["test"]["instead_of"]; ?><?= $entity; ?> () : void
    {
        $id = $this-><?= $i18n["test"]["_given"]; ?><?= $entity; ?>Id();
        $this-><?= $i18n["test"]["_given"]; ?>DoctrineRepositoryFindOneBy<?= $i18n["test"]["returns_null"]; ?><?= $i18n["test"]["for_given"]; ?><?= $entity; ?>Id($id);
        $this-><?= $i18n["test"]["_then"]; ?><?= $i18n["test"]["expect"]; ?><?= $entity; ?><?= $i18n["not_found"]; ?>Exception();
        $this-><?= $i18n["test"]["_when"]; ?>FindOneById<?= $i18n["test"]["was_executed"]; ?>($id);
    }

    private function <?= $i18n["test"]["_given"]; ?>DoctrineRepositoryFindOneBy<?= $i18n["test"]["returns_null"]; ?><?= $i18n["test"]["for_given"]; ?><?= $entity; ?>Id (<?= $entity; ?>Id $id) : void
    {
        $this->doctrineRepository->findOneBy(['id' => $id->asString()])->willReturn(null);
    }

    private function <?= $i18n["test"]["_then"]; ?><?= $i18n["test"]["expect"]; ?><?= $entity; ?><?= $i18n["not_found"]; ?>Exception () : void
    {
        $this->expectException(<?= $entity; ?><?= $i18n["not_found"]; ?>Exception::class);
    }
}

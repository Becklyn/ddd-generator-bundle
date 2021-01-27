<?= "<?php declare(strict_types=1);\n"; ?>

namespace <?= $namespace; ?>;

use <?= $psr4Root; ?>\<?= $domain; ?>\Domain\<?= $domain_namespace; ?><?= $entity; ?>;
use <?= $psr4Root; ?>\<?= $domain; ?>\Domain\<?= $domain_namespace; ?><?= $entity; ?>Id;
use <?= $psr4Root; ?>\<?= $domain; ?>\Domain\<?= $domain_namespace; ?><?= $entity; ?><?= $i18n["not_found"]; ?>Exception;
use <?= $psr4Root; ?>\<?= $domain; ?>\Domain\<?= $domain_namespace; ?><?= $entity; ?>Repository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

/**
 * @author <?= $author; ?><?= "\n"; ?>
 *
 * @since <?= $version; ?><?= "\n"; ?>
 */
class <?= $class_name; ?> implements <?= $entity; ?>Repository
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct (EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(<?= $entity; ?>::class);
    }

    public function nextIdentity () : <?= $entity; ?>Id
    {
        return <?= $entity; ?>Id::next();
    }

    public function add (<?= $entity; ?> $<?= \strtolower($entity); ?>) : void
    {
        $this->entityManager->persist($<?= \strtolower($entity); ?>);
    }

    public function remove (<?= $entity; ?> $<?= \strtolower($entity); ?>) : void
    {
        $this->entityManager->remove($<?= \strtolower($entity); ?>);
    }

    public function findOneById (<?= $entity; ?>Id $<?= \strtolower($entity); ?>Id) : <?= $entity; ?><?= "\n"; ?>
    {
        /** @var <?= $entity; ?> $<?= \strtolower($entity); ?> */
        $<?= \strtolower($entity); ?> = $this->repository->findOneBy(['id' => $<?= \strtolower($entity); ?>Id->asString()]);

        if (null === $<?= \strtolower($entity); ?>) {
            throw new <?= $entity; ?><?= $i18n["not_found"]; ?>Exception("<?= $entity; ?> \"{$<?= \strtolower($entity); ?>Id->asString()}\" cannot be found.");
        }

        return $<?= \strtolower($entity); ?>;
    }
}

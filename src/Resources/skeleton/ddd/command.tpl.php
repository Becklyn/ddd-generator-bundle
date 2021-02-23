<?= "<?php declare(strict_types=1);"; ?><?= "\n"; ?>

namespace <?= $namespace; ?>;

use <?= $psr4Root; ?>\<?= $domain; ?>\Domain\<?= $domain_namespace; ?><?= $entity; ?>Id;

/**
 * @author <?= $author; ?><?= "\n"; ?>
 *
 * @since <?= $version; ?><?= "\n"; ?>
 */
class <?= $class_name; ?><?= "\n"; ?>
{
    private <?= $entity; ?>Id $<?= \strtolower($entity); ?>Id;

    public function __construct (<?= $entity; ?>Id $<?= \strtolower($entity); ?>Id)
    {
        $this-><?= \strtolower($entity); ?>Id = $<?= \strtolower($entity); ?>Id;

        // TODO add additional properties to <?= $class_name; ?>::__construct
    }

    public function <?= \strtolower($entity); ?>Id () : <?= $entity; ?>Id
    {
        return $this-><?= \strtolower($entity); ?>Id;
    }
}

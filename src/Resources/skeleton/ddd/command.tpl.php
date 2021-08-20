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
    private <?= $entity; ?>Id $<?= $strtocamel($entity); ?>Id;

    public function __construct (<?= $entity; ?>Id $<?= $strtocamel($entity); ?>Id)
    {
        $this-><?= $strtocamel($entity); ?>Id = $<?= $strtocamel($entity); ?>Id;

        // TODO add additional properties to <?= $class_name; ?>::__construct
    }

    public function <?= $strtocamel($entity); ?>Id () : <?= $entity; ?>Id
    {
        return $this-><?= $strtocamel($entity); ?>Id;
    }
}

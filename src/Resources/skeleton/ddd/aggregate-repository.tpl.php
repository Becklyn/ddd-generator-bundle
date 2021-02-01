<?= "<?php declare(strict_types=1);\n"; ?>

namespace <?= $namespace; ?>;

/**
 * @author <?= $author; ?><?= "\n"; ?>
 *
 * @since <?= $version; ?><?= "\n"; ?>
 */
interface <?= $class_name; ?><?= "\n"; ?>
{
    public function nextIdentity () : <?= $entity; ?>Id;

    public function add (<?= $entity; ?> $<?= $strtocamel($entity); ?>) : void;

    public function remove (<?= $entity; ?> $<?= $strtocamel($entity); ?>) : void;

    /**
     * @throws <?= $entity; ?><?= $i18n["not_found"]; ?>Exception
     */
    public function findOneById (<?= $entity; ?>Id $<?= $strtocamel($entity); ?>Id) : <?= $entity; ?>;
}

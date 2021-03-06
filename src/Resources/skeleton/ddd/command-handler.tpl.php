<?= "<?php declare(strict_types=1);"; ?><?= "\n"; ?>

namespace <?= $namespace; ?>;

use <?= $psr4Root; ?>\<?= $domain; ?>\Domain\<?= $domain_namespace; ?><?= $entity; ?>Repository;
use Becklyn\Ddd\Commands\Application\CommandHandler;
use Becklyn\Ddd\Events\Domain\EventProvider;

/**
 * @author <?= $author; ?><?= "\n"; ?>
 *
 * @since <?= $version; ?><?= "\n"; ?>
 */
class <?= $class_name; ?> extends CommandHandler
{
    private <?= $entity; ?>Repository $<?= $strtocamel($entity); ?>Repository;

    public function __construct (
        <?= $entity; ?>Repository $<?= $strtocamel($entity); ?>Repository
    ) {
        $this->$<?= $strtocamel($entity); ?>Repository = $<?= $strtocamel($entity); ?>Repository;

        // TODO inject dependencies into <?= $class_name; ?>::__construct
    }

    public function handle (<?= $extra["command_namespace"]; ?>Command $command) : void
    {
        $this->handleCommand($command);
    }

    /**
     * @param <?= $extra["command_namespace"]; ?>Command $command
     */
    protected function execute ($command) : ?EventProvider
    {
        $<?= $strtocamel($entity); ?> = $this-><?= $strtocamel($entity); ?>Repository->findOneById($command-><?= $strtocamel($entity); ?>Id());

        // TODO implement <?= $class_name; ?>::execute

        return $<?= $strtocamel($entity); ?>;
    }
}

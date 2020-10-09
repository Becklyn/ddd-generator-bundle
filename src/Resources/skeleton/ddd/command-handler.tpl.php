<?= "<?php declare(strict_types=1);"; ?><?= "\n"; ?>

namespace <?= $namespace; ?>;

use C201\Ddd\Commands\Application\CommandHandler;
use C201\Ddd\Events\Domain\EventProvider;

/**
 * @author <?= $author; ?><?= "\n"; ?>
 *
 * @since <?= $version; ?><?= "\n"; ?>
 */
class <?= $class_name; ?> extends CommandHandler
{
    public function __construct ()
    {
        // TODO inject dependencies into <?= $class_name; ?>::__construct
    }

    public function handle (<?= $entity; ?><?= $extra["command_action"]; ?>Command $command) : void
    {
        $this->handleCommand($command);
    }

    /**
     * @param <?= $entity; ?><?= $extra["command_action"]; ?>Command $command
     */
    protected function execute ($command) : ?EventProvider
    {
        // TODO implement <?= $class_name; ?>::execute
    }
}

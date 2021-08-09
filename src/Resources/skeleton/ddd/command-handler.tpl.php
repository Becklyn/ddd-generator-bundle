<?= "<?php declare(strict_types=1);"; ?><?= "\n"; ?>

namespace <?= $namespace; ?>;

use Becklyn\Ddd\Commands\Application\CommandHandler;
use Becklyn\Ddd\Events\Domain\EventProvider;

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

    public function handle (<?= $extra["command_namespace"]; ?>Command $command) : void
    {
        $this->handleCommand($command);
    }

    /**
     * @param <?= $extra["command_namespace"]; ?>Command $command
     */
    protected function execute ($command) : ?EventProvider
    {
        // TODO implement <?= $class_name; ?>::execute
    }
}

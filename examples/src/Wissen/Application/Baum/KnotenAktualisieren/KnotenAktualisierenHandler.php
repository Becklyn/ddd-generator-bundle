<?php

namespace App\Wissen\Application\Baum\KnotenAktualisieren;

use Becklyn\Ddd\Commands\Application\CommandHandler;
use Becklyn\Ddd\Events\Domain\EventProvider;

class KnotenAktualisierenHandler extends CommandHandler
{
    public function __construct()
    {
        // TODO inject dependencies
    }

    public function handle(KnotenAktualisierenCommand $command): void
    {
        $this->handleCommand($command);
    }

    /**
     * @param KnotenAktualisierenCommand $command
     */
    protected function execute($command): ?EventProvider
    {
        // TODO implement
    }
}

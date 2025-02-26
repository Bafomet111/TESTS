<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame\IoC\Commands;

use App\Modules\SpaceGame\IoC\StorageSingleton\IoCStorage;

final class RegisterCommand implements ICommand
{
    public function __construct(
        private string $key,
        private \Closure $command,
    ) {
    }

    public function execute(): void
    {
        IoCStorage::getInstance()->addValue($this->key, $this->command);
    }
}
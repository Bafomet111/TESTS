<?php

declare(strict_types=1);

namespace App\Modules\IoC\Commands;

use App\Modules\IoC\StorageSingleton\IoCStorage;

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
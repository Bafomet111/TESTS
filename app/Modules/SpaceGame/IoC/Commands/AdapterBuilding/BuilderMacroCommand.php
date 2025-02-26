<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame\IoC\Commands\AdapterBuilding;

use App\Modules\SpaceGame\IoC\Commands\ICommand;

final readonly class BuilderMacroCommand implements ICommand
{
    public function __construct(
        private array $commands,
    ) {
    }

    public function execute(): void
    {
        foreach ($this->commands as $command) {
            $command->execute();
        }
    }
}
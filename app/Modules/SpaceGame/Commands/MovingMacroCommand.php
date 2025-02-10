<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame\Commands;

/**
 * @property ICommand[] $commands
 */
final class MovingMacroCommand implements ICommand
{

    public function __construct(
        private readonly array $commands,
    ) {
    }

    public function execute(): void
    {
        foreach ($this->commands as $command) {
            $command->execute();
        }
    }
}
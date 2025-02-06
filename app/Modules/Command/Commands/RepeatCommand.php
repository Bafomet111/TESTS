<?php

declare(strict_types=1);

namespace App\Modules\Command\Commands;

final readonly class RepeatCommand implements ICommand
{
    public function __construct(
        private ICommand $command,
    ) {
    }

    public function execute(): void
    {
        $this->command->execute();
    }
}
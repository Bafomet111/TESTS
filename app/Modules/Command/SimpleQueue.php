<?php

declare(strict_types=1);

namespace App\Modules\Command;

final class SimpleQueue implements IQueue
{
    /**
     * @var ICommand[]
     */
    private array $commands = [];

    public function shiftCommand(): ?ICommand
    {
        return array_shift($this->commands);
    }

    public function addCommand(ICommand $command): void
    {
        $this->commands[] = $command;
    }
}
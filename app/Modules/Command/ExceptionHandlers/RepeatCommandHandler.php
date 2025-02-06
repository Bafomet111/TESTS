<?php

declare(strict_types=1);

namespace App\Modules\Command\ExceptionHandlers;

use App\Modules\Command\Commands\ICommand;
use App\Modules\Command\Commands\RepeatCommand;
use App\Modules\Command\IQueue;

final readonly class RepeatCommandHandler implements IHandler
{
    public function __construct(
        private IQueue $queue,
        private ICommand $command,
        private \Exception $exception,
    ) {
    }

    public function handle(): void
    {
        $command = new RepeatCommand($this->command);

        $this->queue->addCommand($command);
    }
}
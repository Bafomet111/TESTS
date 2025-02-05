<?php

declare(strict_types=1);

namespace App\Modules\Command\ExceptionHandlers;

use App\Modules\Command\Commands\SaveLogCommand;
use App\Modules\Command\ICommand;
use App\Modules\Command\IQueue;

final readonly class LogCommandHandler
{
    public function __construct(
        private IQueue $queue,
        private \Exception $exception,
        private ICommand   $command,
    ) {
    }

    public function handle(): void
    {
        $command = new SaveLogCommand($this->exception, $this->command);

        $this->queue->addCommand($command);
    }
}
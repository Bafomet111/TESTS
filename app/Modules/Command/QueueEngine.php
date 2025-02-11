<?php

declare(strict_types=1);

namespace App\Modules\Command;

use App\Modules\Command\ExceptionHandlers\ExceptionHandler;

final readonly class QueueEngine implements IEngine
{
    public function __construct(
        private IQueue $queue,
    ) {
    }

    public function start(): void
    {
        while(true) {
            $command = $this->queue->shiftCommand();
            if ($command === null) {
                break;
            }

            try {
                $command?->execute();
            } catch (\Exception $e) {
                ExceptionHandler::handle($this->queue, $command, $e)->handle();
            }
        }
    }
}
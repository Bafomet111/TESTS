<?php

declare(strict_types=1);

namespace App\Modules\Command;

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

            try {
                $command->execute();
            } catch (\Exception $e) {
                // обработчики
            }
        }
    }
}
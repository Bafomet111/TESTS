<?php

declare(strict_types=1);

namespace Command;

use App\Modules\Command\Commands\FirstCommand;
use App\Modules\Command\Commands\SaveLogCommand;
use App\Modules\Command\ExceptionHandlers\LogCommandHandler;
use App\Modules\Command\SimpleQueue;
use PHPUnit\Framework\TestCase;

class LogCommandHandlerTest extends TestCase
{
    public function testCommandWasAddedToQueue(): void
    {
        $queue = new SimpleQueue();
        $exception = new \Exception();
        $command = new FirstCommand();

        $handler = new LogCommandHandler($queue, $command, $exception);
        $handler->handle();

        $this->assertEquals($queue->shiftCommand(), new SaveLogCommand($exception, $command));
    }
}
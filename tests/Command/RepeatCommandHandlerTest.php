<?php

declare(strict_types=1);

namespace Command;

use App\Modules\Command\Commands\FirstCommand;
use App\Modules\Command\Commands\RepeatCommand;
use App\Modules\Command\ExceptionHandlers\RepeatCommandHandler;
use App\Modules\Command\SimpleQueue;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class RepeatCommandHandlerTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testCommandAddedToQueue(): void
    {
        $queue = new SimpleQueue();
        $command = new FirstCommand();
        $exception = new \Exception();

        $handler = new RepeatCommandHandler($queue, $command, $exception);

        $repeatCommand = new RepeatCommand($command);

        $handler->handle();

        $this->assertEquals($repeatCommand, $queue->shiftCommand());
    }
}
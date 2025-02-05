<?php

declare(strict_types=1);

namespace Command;

use App\Modules\Command\Commands\FirstCommand;
use App\Modules\Command\Commands\SaveLogCommand;
use App\Modules\Command\SimpleQueue;
use PHPUnit\Framework\TestCase;

class SimpleQueueTest extends TestCase
{
    public function testGetFromEmptyQueue(): void
    {
        $queue = new SimpleQueue();

        $command = $queue->shiftCommand();

        $this->assertSame(null, $command);
    }

    public function testCorrectFIFO(): void
    {
        $command1 = new FirstCommand();
        $command2 = new SaveLogCommand();

        $queue = new SimpleQueue();

        $queue->addCommand($command1);
        $queue->addCommand($command2);

        $this->assertSame($command1, $queue->shiftCommand());
        $this->assertSame($command2, $queue->shiftCommand());
    }
}
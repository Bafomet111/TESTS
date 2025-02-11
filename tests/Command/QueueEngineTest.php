<?php

declare(strict_types=1);

namespace Command;

use App\Modules\Command\Commands\FirstCommand;
use App\Modules\Command\Commands\RepeatCommand;
use App\Modules\Command\Commands\SecondCommand;
use App\Modules\Command\Log\Logger;
use App\Modules\Command\QueueEngine;
use App\Modules\Command\SimpleQueue;
use PHPUnit\Framework\TestCase;

class QueueEngineTest extends TestCase
{
    public function testEngineWithFirstCommand(): void
    {
        $queue = new SimpleQueue();
        $queue->addCommand(new FirstCommand());

        $engine = new QueueEngine($queue);

        file_put_contents(Logger::$file, '');

        $engine->start();

        $logFileContent = file_get_contents(Logger::$file);

        $this->assertStringContainsString('First command successful', $logFileContent);
    }

    public function testEngineWithSecondCommand(): void
    {
        $queue = new SimpleQueue();
        $queue->addCommand(new SecondCommand());

        file_put_contents(Logger::$file, '');

        $engine = new QueueEngine($queue);
        $engine->start();

        $logFileContent = file_get_contents(Logger::$file);

        $commandName = RepeatCommand::class;
        $message = "The command {$commandName} failed with exception:";

        $this->assertStringContainsString($message, $logFileContent);
    }
}
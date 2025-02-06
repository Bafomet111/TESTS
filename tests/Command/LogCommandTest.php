<?php

declare(strict_types=1);

namespace Command;

use App\Modules\Command\Commands\SaveLogCommand;
use App\Modules\Command\Commands\SecondCommand;
use App\Modules\Command\Exceptions\SimpleException;
use App\Modules\Command\Log\Logger;
use PHPUnit\Framework\TestCase;

class LogCommandTest extends TestCase
{
    public function testCommandWritingLog(): void
    {
        $message = 'This first test exception';
        $command = new SecondCommand();
        $secondException = new SimpleException($message);

        $command = new SaveLogCommand($secondException, $command);

        file_put_contents(Logger::$file, '');

        $command->execute();

        $logFileContent = file_get_contents(Logger::$file);

        $commandName = SecondCommand::class;
        $exceptionName = SimpleException::class;

        $logMessage = "The command {$commandName} failed with exception: {$exceptionName}. Message: {$message}";

        $this->assertStringContainsString($logMessage, $logFileContent);
    }
}
<?php

declare(strict_types=1);

namespace Command;

use App\Modules\Command\Commands\ICommand;
use App\Modules\Command\Commands\RepeatCommand;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class RepeatCommandTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testExecuteMethod(): void
    {
        $repeatableCommand = $this->createMock(ICommand::class);
        $repeatableCommand->expects($this->once())->method('execute');

        $command = new RepeatCommand($repeatableCommand);

        $command->execute();
    }
}
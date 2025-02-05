<?php

declare(strict_types=1);

namespace Command;

use App\Modules\Command\Commands\FirstCommand;
use App\Modules\Command\Commands\SaveLogCommand;
use App\Modules\Command\SimpleQueue;
use PHPUnit\Framework\TestCase;

class FirstCommandTest extends TestCase
{
    public function testGetFromEmptyQueue(): void
    {
        $command = new FirstCommand();

        $command->execute();

        $this->assertSame(null, $command);
    }
}
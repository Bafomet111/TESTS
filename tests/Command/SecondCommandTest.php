<?php

declare(strict_types=1);

namespace Command;

use App\Modules\Command\Commands\SecondCommand;
use App\Modules\Command\Exceptions\SimpleException;
use PHPUnit\Framework\TestCase;

class SecondCommandTest extends TestCase
{
    /**
     * @throws SimpleException
     */
    public function testGetFromEmptyQueue(): void
    {
        $command = new SecondCommand();

        $this->expectException(SimpleException::class);

        $command->execute();
    }
}
<?php

declare(strict_types=1);

namespace Ioc;

use App\Modules\IoC\Commands\ICommand;
use App\Modules\IoC\Exceptions\CommandNotFoundException;
use App\Modules\IoC\IoCContainer;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class IoCTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testResolveReturnsICommand(): void
    {
        $registerCommand = IoCContainer::resolve('ioc.register', 'demonstration', fn ($message) =>
            $this->createMock(ICommand::class),
        );

        $this->assertInstanceOf(ICommand::class, $registerCommand);
    }

    /**
     * @throws \Exception
     */
    public function testCommandNotFound(): void
    {
        $this->expectException(CommandNotFoundException::class);

        IoCContainer::resolve('demonstration', 'this is demonstration command');
    }

    /**
     * @throws Exception
     * @throws CommandNotFoundException
     */
    public function testResolveRegisteredCommand(): void
    {
        $message = 'this is demonstration command';

        $mock = $this->createMock(ICommand::class);
        $mock->method('execute')->willThrowException(new \Exception($message));

        IoCContainer::resolve(
            'ioc.register',
            'demonstration',
            fn ($message) => $mock,
        )->execute();

        $command = IoCContainer::resolve('demonstration', $message);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage($message);

        $command->execute();
    }
}
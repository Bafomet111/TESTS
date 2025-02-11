<?php

declare(strict_types=1);

namespace App\Modules\Command\ExceptionHandlers;

use App\Modules\Command\Commands\ICommand;
use App\Modules\Command\Commands\RepeatCommand;
use App\Modules\Command\Commands\SecondCommand;
use App\Modules\Command\Exceptions\SimpleException;
use App\Modules\Command\IQueue;

final class ExceptionHandler
{
    private const DEFAULT_HANDLER = DefaultHandler::class;

    private static array $handlers = [
        SecondCommand::class => [
            SimpleException::class => RepeatCommandHandler::class,
        ],
        RepeatCommand::class => [
            SimpleException::class => LogCommandHandler::class,
        ],
    ];

    public static function handle(IQueue $queue, ICommand $command, \Exception $exception): IHandler
    {
        $handler = self::$handlers[$command::class][$exception::class] ?? self::DEFAULT_HANDLER;

        return new $handler($queue, $command, $exception);
    }
}
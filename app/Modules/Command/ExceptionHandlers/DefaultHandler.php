<?php

namespace App\Modules\Command\ExceptionHandlers;

use App\Modules\Command\Commands\ICommand;
use App\Modules\Command\IQueue;
use App\Modules\Command\Log\Logger;

class DefaultHandler implements IHandler
{
    public function __construct(
        IQueue $queue,
        ICommand $command,
        \Exception $exception,
    ) {
    }

    public function handle(): void
    {
        Logger::log('default handler');
    }
}
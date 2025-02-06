<?php

declare(strict_types=1);

namespace App\Modules\Command\Commands;

use App\Modules\Command\Log\Logger;

final readonly class SaveLogCommand implements ICommand
{
    public function __construct(
        private \Exception $exception,
        private ICommand   $command,
    ) {
    }

    public function execute(): void
    {
        $commandName = get_class($this->command);
        $exceptionName = get_class($this->exception);

        Logger::log("The command {$commandName} failed with exception: {$exceptionName}. Message: {$this->exception->getMessage()}");
    }
}
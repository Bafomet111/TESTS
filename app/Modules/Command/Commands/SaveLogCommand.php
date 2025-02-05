<?php

declare(strict_types=1);

namespace App\Modules\Command\Commands;

use App\Modules\Command\ICommand;
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
        Logger::log("
            The command {$this->command::class} 
            failed with exception: {$this->exception::class}. 
            Message: {$this->exception->getMessage()}
        ");
    }
}
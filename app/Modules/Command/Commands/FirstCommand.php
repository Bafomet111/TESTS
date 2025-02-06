<?php

declare(strict_types=1);

namespace App\Modules\Command\Commands;

use App\Modules\Command\Log\Logger;

final class FirstCommand implements ICommand
{
    public function execute(): void
    {
        Logger::log('First command successful!');
    }
}
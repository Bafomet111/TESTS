<?php

declare(strict_types=1);

namespace App\Modules\Command\Commands;

use App\Modules\Command\Exceptions\FirstException;
use App\Modules\Command\ICommand;

final class SecondCommand implements ICommand
{
    /**
     * @throws FirstException
     */
    public function execute(): void
    {
        throw new FirstException();
    }
}
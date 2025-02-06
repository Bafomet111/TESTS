<?php

declare(strict_types=1);

namespace App\Modules\Command\Commands;

use App\Modules\Command\Exceptions\SimpleException;

final class SecondCommand implements ICommand
{
    /**
     * @throws SimpleException
     */
    public function execute(): void
    {
        throw new SimpleException();
    }
}
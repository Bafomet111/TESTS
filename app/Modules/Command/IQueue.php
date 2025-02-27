<?php

declare(strict_types=1);

namespace App\Modules\Command;

use App\Modules\Command\Commands\ICommand;

interface IQueue
{
    public function shiftCommand(): ?ICommand;

    public function addCommand(ICommand $command): void;
}
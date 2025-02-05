<?php

declare(strict_types=1);

namespace App\Modules\Command;

interface ICommand
{
    public function execute(): void;
}
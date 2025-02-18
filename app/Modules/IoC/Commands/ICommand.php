<?php

declare(strict_types=1);

namespace App\Modules\IoC\Commands;

interface ICommand
{
    public function execute(): void;
}
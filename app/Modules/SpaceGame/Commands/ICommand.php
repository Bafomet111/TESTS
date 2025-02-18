<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame\Commands;

interface ICommand
{
    public function execute(): void;
}
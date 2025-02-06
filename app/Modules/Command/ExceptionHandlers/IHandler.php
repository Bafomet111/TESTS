<?php

declare(strict_types=1);

namespace App\Modules\Command\ExceptionHandlers;

interface IHandler
{
    public function handle(): void;
}
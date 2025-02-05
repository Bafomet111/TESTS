<?php

declare(strict_types=1);

namespace App\Modules\Command;

interface IEngine
{
    public function start(): void;
}
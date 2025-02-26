<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame\IoC\Providers;

interface ServiceProvider
{
    public function bind(): void;
}
<?php

declare(strict_types=1);

namespace App\Modules\IoC;

interface IContainer
{
    public static function resolve(string $name, object ...$args);
}
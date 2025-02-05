<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame;

interface UObject
{
    public function getProperty(string $key): object;

    public function setProperty(string $key, object $value): void;
}
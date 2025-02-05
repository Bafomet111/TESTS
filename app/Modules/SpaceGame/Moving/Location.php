<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame\Moving;

final class Location
{
    public function __construct(
        public int $x,
        public int $y,
    ) {
    }
}
<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame\FuelBurning;

final class Fuel
{
    public function __construct(
        public int $count = 0,
    ) {
    }
}
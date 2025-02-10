<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame\FuelBurning;

interface IHaveFuel
{
    public function getFuel(): Fuel;

    public function setFuel(Fuel $fuel): void;
}
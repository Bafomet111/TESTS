<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame\FuelBurning;

use App\Modules\SpaceGame\UObject;

final readonly class HaveFuelAdapter implements IHaveFuel
{
    public function __construct(
        private UObject $uObject,
    ) {
    }

    public function getFuel(): Fuel
    {
        return $this->uObject->getProperty('fuel');
    }

    public function setFuel(Fuel $fuel): void
    {
        $this->uObject->setProperty('fuel', $fuel);
    }
}
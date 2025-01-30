<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame\Moving;

use App\Modules\SpaceGame\UObject;

readonly class MovingObjectAdapter implements IMovable
{
    public function __construct(
        private UObject $uObject,
    ) {
    }

    public function getLocation(): Location
    {
        return $this->uObject->getProperty('location');
    }

    public function setLocation(Location $location): void
    {
        $this->uObject->setProperty('location', $location);
    }

    public function getVelocity(): Velocity
    {
        return $this->uObject->getProperty('velocity');
    }
}
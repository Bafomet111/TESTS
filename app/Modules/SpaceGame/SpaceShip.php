<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame;

final class SpaceShip implements IMovable
{
    private Location $location;

    private Velocity $velocity;

    public function __construct()
    {
        $this->velocity = new Velocity(1, 2);
    }

    public function getLocation(): Location
    {
        return $this->location;
    }

    public function setLocation(Location $location): void
    {
        $this->location = $location;
    }

    public function getVelocity(): Velocity
    {
        return $this->velocity;
    }
}
<?php

namespace App\Modules\SpaceGame\Moving;

interface IMovable
{
    public function getLocation(): Location;

    public function setLocation(Location $location): void;

    public function getVelocity(): Velocity;
}
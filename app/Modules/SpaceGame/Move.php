<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame;

final class Move
{
    public function run(IMovable $movableObject): void
    {
        $location = $movableObject->getLocation();
        $velocity = $movableObject->getVelocity();

        $location->x += $velocity->x;
        $location->y += $velocity->y;
    }
}
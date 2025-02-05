<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame\Moving;

final class Move
{
    public function __construct(
        private IMovable $movableObject,
    ) {
    }

    public function execute(): void
    {
        $location = $this->movableObject->getLocation();
        $velocity = $this->movableObject->getVelocity();

        $location->x += $velocity->x;
        $location->y += $velocity->y;
    }
}
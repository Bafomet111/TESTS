<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame\Commands;

use App\Modules\SpaceGame\Moving\IMovable;
use App\Modules\SpaceGame\Rotating\Angle;

final readonly class ChangeVelocityCommand implements ICommand
{
    public function __construct(
        private IMovable $movable,
        private Angle    $angle,
    ) {
    }

    public function execute(): void
    {
        $velocity = $this->movable->getVelocity();

        $angleValue = $this->angle->value;

        $velocity->x = (int) ($velocity->x * cos($angleValue) - $velocity->y * sin($angleValue));
        $velocity->y = (int) ($velocity->x * sin($angleValue) + $velocity->y * cos($angleValue));
    }
}

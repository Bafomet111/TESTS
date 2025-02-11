<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame\Commands;

use App\Modules\SpaceGame\Moving\IMovable;
use App\Modules\SpaceGame\Rotating\Angle;
use App\Modules\SpaceGame\Rotating\IRotatable;
use App\Modules\SpaceGame\Rotating\Rotate;

final readonly class RotateCommand implements ICommand
{
    public function __construct(
        private IRotatable $rotatable,
        private IMovable   $movable,
        private Angle      $angle,
    ) {
    }

    public function execute(): void
    {
        $rotate = new Rotate($this->rotatable);
        $rotate->execute($this->angle);

        $changeVelocityCommand = new ChangeVelocityCommand($this->movable, $this->angle);

        $changeVelocityCommand->execute();
    }
}

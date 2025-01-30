<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame\Rotating;

readonly class Rotate
{
    public function __construct(
        private IRotatable $rotatable,
    ) {
    }

    public function execute(Angle $angle): void
    {
        $currentAngle = $this->rotatable->getAngle();

        $this->rotatable->setAngle($currentAngle->plus($angle));
    }
}
<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame\Rotating;

use App\Modules\SpaceGame\UObject;

final class RotatingObjectAdapter implements IRotatable
{
    public function __construct(
        private UObject $uObject,
    ) {
    }

    public function getAngle(): Angle
    {
        return $this->uObject->getProperty('angle');
    }

    public function setAngle(Angle $angle): void
    {
        $this->uObject->setProperty('angle', $angle);
    }
}
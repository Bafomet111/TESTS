<?php

namespace App\Modules\SpaceGame\Rotating;

interface IRotatable
{
    public function getAngle(): Angle;

    public function setAngle(Angle $angle): void;
}
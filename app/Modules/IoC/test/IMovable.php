<?php

namespace App\Modules\IoC\test;

interface IMovable
{
    public function getLocation();
    public function getVelocity();

    public function setLocation($location);
}
<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame\Rotating\Exceptions;

class DifferentAngleDimensionException extends \Exception
{
    public function __construct()
    {
        parent::__construct("The angle has a different dimension");
    }
}
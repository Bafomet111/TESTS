<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame\Rotating;

use App\Modules\SpaceGame\Rotating\Exceptions\DifferentAngleDimensionException;

final readonly class Angle
{
    public function __construct(
        public int $value,
        public int|float $dimension,
    ) {
    }

    /**
     * @throws DifferentAngleDimensionException
     */
    public function plus(self $angle): self
    {
        if ($angle->dimension !== $this->dimension) {
            throw new DifferentAngleDimensionException();
        }

        return new self(($this->value + $angle->value) % $this->dimension, $this->dimension);
    }
}
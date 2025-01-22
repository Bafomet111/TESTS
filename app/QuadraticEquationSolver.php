<?php

declare(strict_types=1);

namespace App;

class QuadraticEquationSolver
{
    /**
     * @throws \Exception
     */
    public function solve(float $a, float $b, float $c): array
    {
        if ($a < PHP_FLOAT_MIN && $a > -PHP_FLOAT_MIN) {
            throw new \Exception('A coefficient cannot be zero');
        }

        $discriminant = $b * $b - (4 * $a * $c);

        if ($discriminant < -PHP_FLOAT_EPSILON) {
            return [];
        }

        if ($discriminant <= PHP_FLOAT_EPSILON) {
            return [-$b / (2 * $a)];
        }

        $firstRoot = (-$b + sqrt($discriminant)) / (2 * $a);
        $secondRoot = (-$b - sqrt($discriminant)) / (2 * $a);

        return [$firstRoot, $secondRoot];
    }
}
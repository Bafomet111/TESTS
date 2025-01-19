<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function testCorrectSum()
    {
        $sum = $this->calculateSum(1, 3);
        $this->assertSame(4, $sum);
    }

    private function calculateSum(int $first, int $second): int
    {
        return $first + $second;
    }
}
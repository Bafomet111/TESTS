<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\QuadraticEquationSolver;

class QuadraticEquationsTest extends TestCase
{
    public function testNoRoots()
    {
        $result = $this->getSolver()->solve(1, 0, 1);

        $this->assertSame([], $result);
    }

    public function testHasTwoRoots()
    {
        $result = $this->getSolver()->solve(1, 0, -1);

        $this->assertSame([], array_diff([1, -1], $result));
    }

    public function testHasOnlyOneRoot()
    {
        $result = $this->getSolver()->solve(1, 2, 1);

        // equals сравнивает не строго. Как быть здесь?
        $this->assertEquals([-1], $result);
    }

    /**
     * @throws Exception
     */
    public function testACanNotBeZero() {
        $this->expectException(\Throwable::class);

        $this->getSolver()->solve(0, 0, 1);
    }

    /**
     * @throws Exception
     */
//    public function testWithDiscriminantLessEpsilon()
//    {
//        $coefficient = (1 - PHP_FLOAT_MIN) / 4;
//
//        $result = $this->getSolver()->solve(1, 1, $coefficient);
//
//        $this->assertEquals([-1], $result);
//    }

    private function getSolver(): QuadraticEquationSolver
    {
        return new QuadraticEquationSolver();
    }
}
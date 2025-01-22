<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\QuadraticEquationSolver;

class QuadraticEquationsTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testNoRoots(): void
    {
        $result = $this->getSolver()->solve(1, 0, 1);

        $this->assertSame([], $result);
    }

    /**
     * @throws Exception
     */
    public function testHasTwoRoots(): void
    {
        $result = $this->getSolver()->solve(1, 0, -1);

        $this->assertSame([], array_diff([1, -1], $result));
    }

    /**
     * @throws Exception
     */
    public function testHasOnlyOneRoot(): void
    {
        $result = $this->getSolver()->solve(1, 2, 1);

        $this->assertEquals([-1], $result);
    }

    /**
     * @throws Exception
     */
    public function testACanNotBeZero(): void
    {
        $this->expectException(\Exception::class);

        $this->getSolver()->solve(0, 0, 1);
    }

    /**
     * @throws Exception
     */
    public function testWithDiscriminantLessEpsilon(): void
    {
        $a = 1;
        $b = 2;
        $c = (4 - PHP_FLOAT_EPSILON / 2.0) / 4;

        $result = $this->getSolver()->solve($a, $b, $c);

        $this->assertEquals([-1], $result);
    }

    /**
     * @dataProvider invalidStringArguments
     * @return void
     * @throws Exception
     */
    public function testStringArguments(mixed $a, mixed $b, mixed $c): void
    {
        $this->expectException(\TypeError::class);

        $this->getSolver()->solve($a, $b, $c);
    }

    /**
     * @dataProvider invalidNullArguments
     * @return void
     * @throws Exception
     */
    public function testNullArguments(mixed $a, mixed $b, mixed $c): void
    {
        $this->expectException(\TypeError::class);

        $this->getSolver()->solve($a, $b, $c);
    }

    public static function invalidStringArguments(): array
    {
        return [
            ['string', 1.0, 1.0], // $a
            [1.0, 'string', 1.0], // $b
            [1.0, 1.0, 'string'], // $c
        ];
    }

    public static function invalidNullArguments(): array
    {
        return [
            [null, 1.0, 1.0], // $a
            [1.0, null, 1.0], // $b
            [1.0, 1.0, null], // $c
        ];
    }

    private function getSolver(): QuadraticEquationSolver
    {
        return new QuadraticEquationSolver();
    }
}
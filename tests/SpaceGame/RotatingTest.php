<?php

declare(strict_types=1);

namespace SpaceGame;

use App\Modules\SpaceGame\Rotating\Angle;
use App\Modules\SpaceGame\Rotating\Exceptions\DifferentAngleDimensionException;
use App\Modules\SpaceGame\Rotating\Rotate;
use App\Modules\SpaceGame\Rotating\RotatingObjectAdapter;
use App\Modules\SpaceGame\SpaceShip;
use Exception;
use PHPUnit\Framework\TestCase;

class RotatingTest extends TestCase
{
    public function testRotateObject(): void
    {
        $spaceShip = new SpaceShip();
        $currentAngle = new Angle(45, 360);
        $anglePlus = new Angle(60, 360);

        $spaceShip->setProperty('angle', $currentAngle);

        $rotatingAdapter = new RotatingObjectAdapter($spaceShip);
        $move = new Rotate($rotatingAdapter);

        $move->execute($anglePlus);

        $newAngle = $rotatingAdapter->getAngle();

        $this->assertSame($newAngle->dimension, 360);
        $this->assertSame($newAngle->value, 105);
    }

    public function testRotateWithBigValueObject(): void
    {
        $spaceShip = new SpaceShip();
        $currentAngle = new Angle(45, 360);
        $anglePlus = new Angle(355, 360);

        $spaceShip->setProperty('angle', $currentAngle);

        $rotatingAdapter = new RotatingObjectAdapter($spaceShip);
        $move = new Rotate($rotatingAdapter);

        $move->execute($anglePlus);

        $newAngle = $rotatingAdapter->getAngle();

        $this->assertSame($newAngle->dimension, 360);
        $this->assertSame($newAngle->value, 40);
    }


    public function testRotateWithoutAngle(): void
    {
        $spaceShip = new SpaceShip();

        $anglePlus = new Angle(rand(1, 360), 360);

        $rotatingAdapter = new RotatingObjectAdapter($spaceShip);
        $rotate = new Rotate($rotatingAdapter);

        $this->expectException(Exception::class);

        $rotate->execute($anglePlus);
    }

    public function testRotateWithDifferentAngleDimensions(): void
    {
        $spaceShip = new SpaceShip();
        $currentAngle = new Angle(45, 360);
        $anglePlus = new Angle(200, 256);

        $spaceShip->setProperty('angle', $currentAngle);

        $rotatingAdapter = new RotatingObjectAdapter($spaceShip);
        $move = new Rotate($rotatingAdapter);

        $this->expectException(DifferentAngleDimensionException::class);

        $move->execute($anglePlus);
    }
}
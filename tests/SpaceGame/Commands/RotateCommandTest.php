<?php

declare(strict_types=1);

namespace SpaceGame\Commands;

use App\Modules\SpaceGame\Commands\RotateCommand;
use App\Modules\SpaceGame\Moving\MovingObjectAdapter;
use App\Modules\SpaceGame\Moving\Velocity;
use App\Modules\SpaceGame\Rotating\Angle;
use App\Modules\SpaceGame\Rotating\RotatingObjectAdapter;
use App\Modules\SpaceGame\SpaceShip;
use PHPUnit\Framework\TestCase;

class RotateCommandTest extends TestCase
{
    public function testRotate(): void
    {
        $spaceShip = new SpaceShip();

        $velocity = new Velocity(1, 2);
        $angle = new Angle(30, round(2*M_PI));

        $spaceShip->setProperty('velocity', $velocity);
        $spaceShip->setProperty('angle', $angle);

        $angleForAdd = new Angle(3, round(2*M_PI));

        $movingAdapter = new MovingObjectAdapter($spaceShip);
        $rotatableAdapter = new RotatingObjectAdapter($spaceShip);

        $command = new RotateCommand($rotatableAdapter, $movingAdapter, $angleForAdd);

        $command->execute();

        $newAngle = $rotatableAdapter->getAngle();


        $this->assertSame(-1, $velocity->x);
        $this->assertSame(-2, $velocity->y);

        $this->assertSame(3, $newAngle->value);
    }

    public function testRotateIfStartVelocityIsZero(): void
    {
        $spaceShip = new SpaceShip();

        $velocity = new Velocity(0, 0);
        $angle = new Angle(30, round(2*M_PI));

        $spaceShip->setProperty('velocity', $velocity);
        $spaceShip->setProperty('angle', $angle);

        $angleForAdd = new Angle(3, round(2*M_PI));

        $movingAdapter = new MovingObjectAdapter($spaceShip);
        $rotatableAdapter = new RotatingObjectAdapter($spaceShip);

        $command = new RotateCommand($rotatableAdapter, $movingAdapter, $angleForAdd);

        $command->execute();

        $newAngle = $rotatableAdapter->getAngle();

        $this->assertEquals(0, $velocity->x);
        $this->assertEquals(0, $velocity->y);

        $this->assertEquals(3, $newAngle->value);
    }
}
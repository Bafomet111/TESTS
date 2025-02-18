<?php

declare(strict_types=1);

namespace SpaceGame\Commands;

use App\Modules\SpaceGame\Commands\ChangeVelocityCommand;
use App\Modules\SpaceGame\Moving\MovingObjectAdapter;
use App\Modules\SpaceGame\Moving\Velocity;
use App\Modules\SpaceGame\Rotating\Angle;
use App\Modules\SpaceGame\SpaceShip;
use PHPUnit\Framework\TestCase;

class ChangeVelocityCommandTest extends TestCase
{
    public function testChangeVelocity(): void
    {
        $spaceShip = new SpaceShip();

        $velocity = new Velocity(1, 2);

        $spaceShip->setProperty('velocity', $velocity);
        $angleForAdd = new Angle(30, 2*M_PI);

        $movingAdapter = new MovingObjectAdapter($spaceShip);

        $command = new ChangeVelocityCommand($movingAdapter, $angleForAdd);

        $command->execute();

        $this->assertSame(2, $velocity->x);
        $this->assertSame(-1, $velocity->y);
    }

    public function testChangeVelocityIfStartVelocityIsZero(): void
    {
        $spaceShip = new SpaceShip();

        $velocity = new Velocity(0, 0);

        $spaceShip->setProperty('velocity', $velocity);
        $angleForAdd = new Angle(30, 2*M_PI);

        $movingAdapter = new MovingObjectAdapter($spaceShip);

        $command = new ChangeVelocityCommand($movingAdapter, $angleForAdd);

        $command->execute();

        $this->assertSame(0, $velocity->x);
        $this->assertSame(0, $velocity->y);
    }
}
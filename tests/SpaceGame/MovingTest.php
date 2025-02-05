<?php

declare(strict_types=1);

namespace SpaceGame;

use App\Modules\SpaceGame\Moving\Location;
use App\Modules\SpaceGame\Moving\Move;
use App\Modules\SpaceGame\Moving\MovingObjectAdapter;
use App\Modules\SpaceGame\Moving\Velocity;
use App\Modules\SpaceGame\SpaceShip;
use Exception;
use PHPUnit\Framework\TestCase;

class MovingTest extends TestCase
{
    public function testMoveObject(): void
    {
        $spaceShip = new SpaceShip();
        $location = new Location(12, 5);
        $velocity = new Velocity(-7, 3);

        $spaceShip->setProperty('location', $location);
        $spaceShip->setProperty('velocity', $velocity);


        $movingAdapter = new MovingObjectAdapter($spaceShip);
        $move = new Move($movingAdapter);

        $move->execute();

        $newLocation = $movingAdapter->getLocation();

        $this->assertSame($newLocation->x, 5);
        $this->assertSame($newLocation->y, 8);
    }

    public function testMoveWithoutLocation(): void
    {
        $spaceShip = new SpaceShip();
        $velocity = new Velocity(-7, 3);

        $spaceShip->setProperty('velocity', $velocity);

        $movingAdapter = new MovingObjectAdapter($spaceShip);
        $move = new Move($movingAdapter);

        $this->expectException(Exception::class);

        $move->execute();
    }

    public function testMoveWithoutVelocity(): void
    {
        $spaceShip = new SpaceShip();
        $location = new Location(1, 2);

        $spaceShip->setProperty('location', $location);

        $movingAdapter = new MovingObjectAdapter($spaceShip);
        $move = new Move($movingAdapter);

        $this->expectException(Exception::class);

        $move->execute();
    }
}
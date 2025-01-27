<?php

use App\Modules\SpaceGame\Location;
use App\Modules\SpaceGame\Move;
use App\Modules\SpaceGame\SpaceShip;
use App\Modules\SpaceGame\Velocity;
use PHPUnit\Framework\TestCase;

class SpaceShipTest extends TestCase
{
    public function testMoveObject(): void
    {
        $spaceShip = new SpaceShip();

        $reflection = new ReflectionClass($spaceShip);
        $reflectionVelocity = $reflection->getProperty('velocity');

        $reflectionVelocity->setValue($spaceShip, new Velocity(-7, 3));

        $spaceShip->setLocation(new Location(12, 5));

        $move = new Move();

        $move->run($spaceShip);
        $newLocation = $spaceShip->getLocation();

        $this->assertSame($newLocation->x, 5);
        $this->assertSame($newLocation->y, 8);
    }

    public function testWithoutLocation(): void
    {
        $spaceShip = new SpaceShip();

        $move = new Move();

        $this->expectException(\Error::class);

        $move->run($spaceShip);
    }
}
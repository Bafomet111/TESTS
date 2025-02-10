<?php

declare(strict_types=1);

namespace SpaceGame\Commands;

use App\Modules\SpaceGame\Commands\BurnFuelCommand;
use App\Modules\SpaceGame\Commands\CheckFuelCommand;
use App\Modules\SpaceGame\Commands\MoveCommand;
use App\Modules\SpaceGame\Commands\MovingMacroCommand;
use App\Modules\SpaceGame\Exceptions\CommandException;
use App\Modules\SpaceGame\FuelBurning\Fuel;
use App\Modules\SpaceGame\FuelBurning\HaveFuelAdapter;
use App\Modules\SpaceGame\Moving\Location;
use App\Modules\SpaceGame\Moving\MovingObjectAdapter;
use App\Modules\SpaceGame\Moving\Velocity;
use App\Modules\SpaceGame\SpaceShip;
use PHPUnit\Framework\TestCase;

class MovingMacroCommandTest extends TestCase
{
    public function testMovingIfNotEnoughFuel(): void
    {
        $spaceShip = new SpaceShip();

        $currentFuelCount = 5;
        $consumptionFuel = 6;

        $fuel = new Fuel($currentFuelCount);

        $spaceShip->setProperty('fuel', $fuel);

        $movingAdapter = new MovingObjectAdapter($spaceShip);
        $fuelAdapter = new HaveFuelAdapter($spaceShip);

        $commands = [
            new CheckFuelCommand($fuelAdapter, $consumptionFuel),
            new BurnFuelCommand($fuelAdapter, $consumptionFuel),
            new MoveCommand($movingAdapter),
        ];

        $macroCommand = new MovingMacroCommand($commands);

        $this->expectException(CommandException::class);

        $macroCommand->execute();
    }

    public function testMovingWithEnoughFuel(): void
    {
        $spaceShip = new SpaceShip();

        $currentFuelCount = 5;
        $consumptionFuel = 5;

        $fuel = new Fuel($currentFuelCount);
        $location = new Location(1, 2);
        $velocity = new Velocity(3, 1);

        $spaceShip->setProperty('fuel', $fuel);
        $spaceShip->setProperty('location', $location);
        $spaceShip->setProperty('velocity', $velocity);

        $movingAdapter = new MovingObjectAdapter($spaceShip);
        $fuelAdapter = new HaveFuelAdapter($spaceShip);

        $commands = [
            new CheckFuelCommand($fuelAdapter, $consumptionFuel),
            new BurnFuelCommand($fuelAdapter, $consumptionFuel),
            new MoveCommand($movingAdapter),
        ];

        $macroCommand = new MovingMacroCommand($commands);

        $macroCommand->execute();

        $this->assertSame($location->x, 4);
        $this->assertSame($location->y, 3);
        $this->assertSame($fuel->count, 0);
    }
}
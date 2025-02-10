<?php

declare(strict_types=1);

namespace SpaceGame\Commands;

use App\Modules\SpaceGame\Commands\CheckFuelCommand;
use App\Modules\SpaceGame\Exceptions\CommandException;
use App\Modules\SpaceGame\FuelBurning\Fuel;
use App\Modules\SpaceGame\FuelBurning\HaveFuelAdapter;
use App\Modules\SpaceGame\SpaceShip;
use PHPUnit\Framework\TestCase;

class CheckFuelCommandTest extends TestCase
{
    public function testNotEnoughFuel(): void
    {
        $spaceShip = new SpaceShip();
        $fuel = new Fuel(5);

        $spaceShip->setProperty('fuel', $fuel);

        $fuelAdapter = new HaveFuelAdapter($spaceShip);

        $command = new CheckFuelCommand($fuelAdapter, 6);

        $this->expectException(CommandException::class);

        $command->execute();
    }

    /**
     * @throws CommandException
     */
    public function testEnoughFuel(): void
    {
        $spaceShip = new SpaceShip();
        $fuel = new Fuel(5);

        $spaceShip->setProperty('fuel', $fuel);

        $fuelAdapter = new HaveFuelAdapter($spaceShip);

        $command = new CheckFuelCommand($fuelAdapter, 5);

        $this->expectNotToPerformAssertions();

        $command->execute();
    }
}
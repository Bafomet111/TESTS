<?php

declare(strict_types=1);

namespace SpaceGame\Commands;

use App\Modules\SpaceGame\Commands\BurnFuelCommand;
use App\Modules\SpaceGame\FuelBurning\Fuel;
use App\Modules\SpaceGame\FuelBurning\HaveFuelAdapter;
use App\Modules\SpaceGame\SpaceShip;
use PHPUnit\Framework\TestCase;

class BurnFuelCommandTest extends TestCase
{
    public function testFuelIsBurning(): void
    {
        $spaceShip = new SpaceShip();
        $fuel = new Fuel(7);

        $spaceShip->setProperty('fuel', $fuel);

        $fuelAdapter = new HaveFuelAdapter($spaceShip);

        $command = new BurnFuelCommand($fuelAdapter, 7);
        $command->execute();

        $this->assertSame(0, $fuel->count);
    }


}
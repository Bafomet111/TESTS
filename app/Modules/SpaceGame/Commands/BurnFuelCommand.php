<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame\Commands;

use App\Modules\SpaceGame\FuelBurning\IHaveFuel;

final readonly class BurnFuelCommand implements ICommand
{
    public function __construct(
        private IHaveFuel $iHaveFuel,
        private int       $consumption,
    ) {
    }

    /**
     * @throws \Exception
     */
    public function execute(): void
    {
        $fuel = $this->iHaveFuel->getFuel();

        $fuel->count -= $this->consumption;
    }
}
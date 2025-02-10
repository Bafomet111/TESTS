<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame\Commands;

use App\Modules\SpaceGame\Exceptions\CommandException;
use App\Modules\SpaceGame\FuelBurning\IHaveFuel;

final readonly class CheckFuelCommand implements ICommand
{
    public function __construct(
        private IHaveFuel $iHaveFuel,
        private int       $consumption,
    ) {
    }

    /**
     * @throws CommandException
     */
    public function execute(): void
    {
        $fuel = $this->iHaveFuel->getFuel();

        if ($fuel->count < $this->consumption) {
            throw new CommandException('Недостаточно топлива');
        }
    }
}
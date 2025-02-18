<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame\Commands;

use App\Modules\SpaceGame\Moving\IMovable;
use App\Modules\SpaceGame\Moving\Move;

final readonly class MoveCommand implements ICommand
{
    public function __construct(
        private IMovable $movable,
    ) {
    }

    public function execute(): void
    {
        $move = new Move($this->movable);

        $move->execute();
    }
}
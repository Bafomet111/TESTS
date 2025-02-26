<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame\IoC\Commands\AdapterBuilding;

use App\Modules\SpaceGame\IoC\Commands\ICommand;
use App\Modules\SpaceGame\IoC\ValueObjects\AdapterBuilderVO;

final readonly class MethodsCommand implements ICommand
{
    public function __construct(
        private AdapterBuilderVO $adapterVO,
        private \ReflectionClass $interface,
    ) {
    }

    public function execute(): void
    {
        $methods = $this->interface->getMethods();

        foreach ($methods as $method) {
            (
                new ConcreteMethodCommand(
                    $this->interface,
                    $method,
                    $this->adapterVO,
                )
            )->execute();
        }
    }
}
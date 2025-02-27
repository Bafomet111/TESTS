<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame\GeneratingAdapter\Commands;

use App\Modules\SpaceGame\GeneratingAdapter\ValueObjects\AdapterBuilderVO;
use App\Modules\SpaceGame\IoC\Commands\ICommand;

final readonly class InterfaceCommand implements ICommand
{
    public function __construct(
        private AdapterBuilderVO $adapterVO,
        private \ReflectionClass $interface,
    ) {
    }

    public function execute(): void
    {
        $this->adapterVO->setInterface(
            $this->interface->getName(),
        );
    }
}
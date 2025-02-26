<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame\IoC\Commands\AdapterBuilding;

use App\Modules\SpaceGame\IoC\Commands\ICommand;
use App\Modules\SpaceGame\IoC\ValueObjects\AdapterBuilderVO;

final readonly class ConstructorCommand implements ICommand
{
    public function __construct(
        private AdapterBuilderVO $adapterVO,
    ) {
    }

    public function execute(): void
    {
        $this->adapterVO->addMethod(
            'public function __construct(private $obj) {}',
        );
    }
}
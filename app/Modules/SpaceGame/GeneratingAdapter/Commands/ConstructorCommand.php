<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame\GeneratingAdapter\Commands;

use App\Modules\SpaceGame\GeneratingAdapter\ValueObjects\AdapterBuilderVO;
use App\Modules\SpaceGame\IoC\Commands\ICommand;

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
<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame\GeneratingAdapter\Commands;

use App\Modules\SpaceGame\GeneratingAdapter\ValueObjects\AdapterBuilderVO;
use App\Modules\SpaceGame\IoC\Commands\ICommand;
use App\Modules\SpaceGame\IoC\Exceptions\DependencyNotFound;
use App\Modules\SpaceGame\IoC\IoC;

final readonly class ConcreteMethodCommand implements ICommand
{
    public function __construct(
        private \ReflectionClass  $interface,
        private \ReflectionMethod $method,
        private AdapterBuilderVO  $adapterVO,
    ) {
    }

    /**
     * @throws DependencyNotFound
     */
    public function execute(): void
    {
        $methodName = $this->method->getName();
        $prefix = $this->parseMethodPrefix($methodName);

        $function = IoC::resolve(
            "Spaceship.Operations.Adapter.Generate.{$prefix}",
            $this->interface->getShortName(),
            $this->parsePropertyName($methodName, $prefix),
            $this->method->getReturnType()->getName(),
            ...array_map(fn ($parameter) => $parameter->getName(), $this->method->getParameters())
        );

        $this->adapterVO->addMethod($function);
    }

    private function parsePropertyName(string $methodName, string $prefix): string
    {
        return substr($methodName, strlen($prefix));
    }

    private function parseMethodPrefix(string $methodName): string
    {
        preg_match('/^[a-z]+/', $methodName, $matches);

        return $matches[0];
    }
}
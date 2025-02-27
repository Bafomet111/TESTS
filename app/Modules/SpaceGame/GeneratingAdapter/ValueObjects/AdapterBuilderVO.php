<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame\GeneratingAdapter\ValueObjects;

class AdapterBuilderVO
{
    private string $className;

    private string $interface;

    private array $methods = [];

    public function getClassName(): string
    {
        return $this->className;
    }

    public function setClassName(string $className): void
    {
        $this->className = $className;
    }

    public function setInterface(string $interface): void
    {
        $this->interface = $interface;
    }

    public function addMethod(string $method): void
    {
        $this->methods[] = $method;
    }

    public function getAdapterAsString(): string
    {
        $methods = implode(PHP_EOL, $this->methods);

        return "class {$this->className} implements $this->interface \n { \n $methods \n } \n";
    }
}
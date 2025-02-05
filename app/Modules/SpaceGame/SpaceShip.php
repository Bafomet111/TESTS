<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame;

final class SpaceShip implements UObject
{
    private array $properties = [];

    /**
     * @throws \Exception
     */
    public function getProperty(string $key): object
    {
        if (!array_key_exists($key, $this->properties)) {
            throw new \Exception("Undefined property $key");
        }

        return $this->properties[$key];
    }

    public function setProperty(string $key, object $value): void
    {
        $this->properties[$key] = $value;
    }
}
<?php

declare(strict_types=1);

namespace App\Modules\IoC\StorageSingleton;

use App\Modules\IoC\Commands\RegisterCommand;

class IoCStorage implements IStorage
{
    private static array $instances = [];

    private array $containerItems = [];


    protected function __construct(
    ) {
        $this->addValue('ioc.register', fn (...$args) => new RegisterCommand(...$args));
    }

    protected function __clone() { }

    /**
     * @throws \Exception
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): self
    {
        $cls = static::class;

        self::$instances[$cls] = self::$instances[$cls] ?? new static();

        return self::$instances[$cls];
    }

    public function getByKey(string $key): ?\Closure
    {
        return $this->containerItems[$key] ?? null;
    }

    public function addValue(string $key, \Closure $value): void
    {
        $this->containerItems[$key] = $value;
    }
}
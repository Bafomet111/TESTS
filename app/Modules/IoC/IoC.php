<?php

declare(strict_types=1);

namespace App\Modules\IoC;

use App\Modules\IoC\StorageSingleton\IoCStorage;
use App\Modules\IoC\Exceptions\DependencyNotFound;

class IoC implements IContainer
{

    /**
     * @throws DependencyNotFound
     */
    public static function resolve(string $name, mixed ...$args): mixed
    {
        $function = IoCStorage::getInstance()->getByKey($name);

        if ($function === null) {
            throw new DependencyNotFound();
        }

        return $function(...$args);
    }
}
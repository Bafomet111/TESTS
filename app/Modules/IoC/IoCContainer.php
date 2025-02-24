<?php

declare(strict_types=1);

namespace App\Modules\IoC;

use App\Modules\IoC\Commands\ICommand;
use App\Modules\IoC\StorageSingleton\IoCStorage;
use App\Modules\IoC\Exceptions\CommandNotFoundException;

class IoCContainer implements IContainer
{

    /**
     * @throws CommandNotFoundException
     */
    public static function resolve(string $name, mixed ...$args): ICommand
    {
        $command = IoCStorage::getInstance()->getByKey($name);

        if ($command === null) {
            throw new CommandNotFoundException();
        }

        return $command(...$args);
    }
}
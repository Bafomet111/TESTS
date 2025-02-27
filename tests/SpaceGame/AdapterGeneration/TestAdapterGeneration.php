<?php

declare(strict_types=1);

namespace SpaceGame\AdapterGeneration;

use JetBrains\PhpStorm\NoReturn;
use PHPUnit\Framework\TestCase;
use App\Modules\SpaceGame\IoC\IoC;
use App\Modules\SpaceGame\Moving\IMovable;
use App\Modules\SpaceGame\IoC\Exceptions\DependencyNotFound;
use App\Modules\SpaceGame\GeneratingAdapter\Providers\AdapterGenerationServiceProvider;

class TestAdapterGeneration extends TestCase
{
    /**
     * @throws DependencyNotFound
     */
    public function testGeneratingCorrectAdapterType(): void
    {
        $provider = new AdapterGenerationServiceProvider();
        $provider->bind();

        $adapter = IoC::resolve('Adapter', IMovable::class, new \stdClass);

        $this->assertInstanceOf(IMovable::class, $adapter);
    }

    /**
     * @throws DependencyNotFound
     */
    #[NoReturn] public function testGeneratingCorrectAdapterWithMethods(): void
    {
        $checkString = md5((string) microtime(true));
        eval('interface ITesting { public function getAboba(): string; }');

        $interface = new \ReflectionClass(\ITesting::class);

        IoC::resolve(
            'ioc.register',
            'Spaceship.Operations.ITesting:aboba.get',
            fn () => $checkString,
        )->execute();

        $provider = new AdapterGenerationServiceProvider();
        $provider->bind();

        $adapter = IoC::resolve('Adapter', \ITesting::class, new \stdClass);

        $this->assertInstanceOf(\ITesting::class, $adapter);
        $this->assertSame($checkString, $adapter->getAboba());
    }
}
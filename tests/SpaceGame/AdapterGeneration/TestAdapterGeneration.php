<?php

declare(strict_types=1);

namespace SpaceGame\AdapterGeneration;

use App\Modules\SpaceGame\IoC\Exceptions\DependencyNotFound;
use App\Modules\SpaceGame\IoC\IoC;
use App\Modules\SpaceGame\IoC\Providers\AdapterGenerationServiceProvider;
use App\Modules\SpaceGame\Moving\IMovable;
use App\Modules\SpaceGame\UObject;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class TestAdapterGeneration extends TestCase
{
    /**
     * @throws DependencyNotFound
     * @throws Exception
     */
    public function testGeneratingCorrectAdapter(): void
    {
        $provider = new AdapterGenerationServiceProvider();
        $provider->bind();

//        $uObjMock = $this->createMock(UObject::class);

        $adapter = IoC::resolve('Adapter', IMovable::class, new \stdClass);

        $this->assertInstanceOf(IMovable::class, $adapter);
    }
}
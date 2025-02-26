<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame\IoC\Providers;

use App\Modules\SpaceGame\IoC\Commands\AdapterBuilding\BuilderMacroCommand;
use App\Modules\SpaceGame\IoC\Commands\AdapterBuilding\ClassNameCommand;
use App\Modules\SpaceGame\IoC\Commands\AdapterBuilding\ConstructorCommand;
use App\Modules\SpaceGame\IoC\Commands\AdapterBuilding\InterfaceCommand;
use App\Modules\SpaceGame\IoC\Commands\AdapterBuilding\MethodsCommand;
use App\Modules\SpaceGame\IoC\Exceptions\DependencyNotFound;
use App\Modules\SpaceGame\IoC\IoC;
use App\Modules\SpaceGame\IoC\ValueObjects\AdapterBuilderVO;

final class AdapterGenerationServiceProvider implements ServiceProvider
{

    /**
     * @throws DependencyNotFound
     */
    public function bind(): void
    {
        $this->bindGetter();
        $this->bindSetter();
        $this->bindBuilderMacroCommand();
        $this->bindIocAdapterDependency();
    }

    /**
     * @throws DependencyNotFound
     */
    private function bindGetter(): void
    {
        IoC::resolve(
            'ioc.register',
            'Spaceship.Operations.Adapter.Generate.get',
            function ($interface, $propertyName, $returnType) {
                return "
                    public function get{$propertyName}(): {$returnType} { 
                        return IoC.resolve('Spaceship.Operations.{$interface}:position.get');
                    }
                ";
            }
        )->execute();
    }

    /**
     * @throws DependencyNotFound
     */
    private function bindSetter(): void
    {
        IoC::resolve(
            'ioc.register',
            'Spaceship.Operations.Adapter.Generate.set',
            function (string $interface, string $propertyName, ?string $returnType, string $argPropertyName) {
                $returnType = $returnType ?? 'void';
                return "
                    public function set{$propertyName}(\${$argPropertyName}): {$returnType} { 
                        IoC.Resolve('Spaceship.Operations.{$interface}:position.set', \$this->obj, \$$argPropertyName).execute(); 
                    }
                ";
            }
        )->execute();
    }

    /**
     * @throws DependencyNotFound
     */
    private function bindBuilderMacroCommand(): void
    {
        IoC::resolve(
            'ioc.register',
            'Spaceship.Adapter.Builder.Command',
            fn(AdapterBuilderVO $adapterBuilderVO, \ReflectionClass $interface) =>
                new BuilderMacroCommand([
                    new ClassNameCommand($adapterBuilderVO, $interface),
                    new InterfaceCommand($adapterBuilderVO, $interface),
                    new ConstructorCommand($adapterBuilderVO),
                    new MethodsCommand($adapterBuilderVO, $interface),
                ])
        )->execute();
    }

    /**
     * @throws DependencyNotFound
     */
    private function bindIocAdapterDependency(): void
    {
        IoC::resolve('ioc.register', 'Adapter', function (string $interface, object $object) {
            $interface = new \ReflectionClass($interface);
            $adapterVO = new AdapterBuilderVO();

            IoC::resolve(
                'Spaceship.Adapter.Builder.Command',
                $adapterVO,
                $interface,
            )->execute();

            eval($adapterVO->getAdapterAsString());
            $className = $adapterVO->getClassName();

            return new $className($object);
        })->execute();
    }
}
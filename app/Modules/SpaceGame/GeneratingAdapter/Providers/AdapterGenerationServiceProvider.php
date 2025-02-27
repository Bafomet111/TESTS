<?php

declare(strict_types=1);

namespace App\Modules\SpaceGame\GeneratingAdapter\Providers;

use App\Modules\SpaceGame\GeneratingAdapter\Commands\BuilderMacroCommand;
use App\Modules\SpaceGame\GeneratingAdapter\Commands\ClassNameCommand;
use App\Modules\SpaceGame\GeneratingAdapter\Commands\ConstructorCommand;
use App\Modules\SpaceGame\GeneratingAdapter\Commands\InterfaceCommand;
use App\Modules\SpaceGame\GeneratingAdapter\Commands\MethodsCommand;
use App\Modules\SpaceGame\GeneratingAdapter\ValueObjects\AdapterBuilderVO;
use App\Modules\SpaceGame\IoC\Exceptions\DependencyNotFound;
use App\Modules\SpaceGame\IoC\IoC;

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
                $property = strtolower($propertyName);
                $ioc = IoC::class;
                return "
                    public function get{$propertyName}(): {$returnType} { 
                        return {$ioc}::resolve('Spaceship.Operations.{$interface}:{$property}.get');
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
                $ioc = IoC::class;
                return "
                    public function set{$propertyName}(\${$argPropertyName}): {$returnType} { 
                        {$ioc}::resolve('Spaceship.Operations.{$interface}:{$argPropertyName}.set', \$this->obj, \$$argPropertyName).execute(); 
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
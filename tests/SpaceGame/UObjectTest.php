<?php

declare(strict_types=1);

namespace SpaceGame;

use App\Modules\SpaceGame\SpaceShip;
use PHPUnit\Framework\TestCase;

class UObjectTest extends TestCase
{
    public function testUndefinedArrayKey(): void
    {
        $object = new SpaceShip();

        $this->expectException(\Exception::class);

        $object->getProperty('aboba');
    }

    /**
     * @throws \Exception
     */
    public function testHasArrayKey(): void
    {
        $object = new SpaceShip();
        $std = new \stdClass();
        $std->test = 'test';

        $object->setProperty('aboba', $std);
        $property = $object->getProperty('aboba');

        $this->assertSame($std, $property);
    }
}
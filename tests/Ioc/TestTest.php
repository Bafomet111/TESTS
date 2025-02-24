<?php

namespace Ioc;

use App\Modules\IoC\test\INdex;
use PHPUnit\Framework\TestCase;

class TestTest extends TestCase
{
    public function testSimple(): void
    {
        $index = new INdex();

        $index->index();
    }
}
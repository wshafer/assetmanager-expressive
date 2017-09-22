<?php

namespace AssetManager\Expressive\Test;

use AssetManager\Expressive\Module;
use PHPUnit\Framework\TestCase;

class ModuleTest extends TestCase
{
    public function testInvoke()
    {
        $module = new Module();

        $result = $module();

        $this->assertTrue(is_array($result));
    }
}

<?php

/**
 * Unit test for Markatom\Accessor\Registry.
 */

use Markatom\Accessor\Accessor;
use Markatom\Accessor\Factory;
use Markatom\Accessor\Registry;
use Tester\Assert;

require __DIR__ . '/bootstrap.php';

$factory = Mockery::mock(Factory::class);
$foo     = Mockery::mock(Accessor::class);
$bar     = Mockery::mock(Accessor::class);

$factory->shouldReceive('create')->with('Foo')->once()->andReturn($foo);
$factory->shouldReceive('create')->with('Bar')->once()->andReturn($bar);

$registry = new Registry($factory);

Assert::same($foo, $registry->getAccessor('Foo'));
Assert::same($foo, $registry->getAccessor('Foo'));
Assert::same($bar, $registry->getAccessor('Bar'));
Assert::same($bar, $registry->getAccessor('Bar'));

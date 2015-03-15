<?php

/**
 * Unit test for Markatom\Accessor\Factory.
 */

namespace _Accessor; // namespace for testing purposes

use Markatom\Accessor\Cache;
use Markatom\Accessor\Factory;
use Markatom\Accessor\Generator;
use Markatom\Accessor\Naming;
use Mockery;
use Tester\Assert;

require __DIR__ . '/bootstrap.php';

$naming    = Mockery::mock(Naming::class);
$generator = Mockery::mock(Generator::class);
$cache     = Mockery::mock(Cache::class);

$naming->shouldReceive('getNamespace')->andReturn('_Accessor');
$naming->shouldReceive('deriveClassName')->with('One')->andReturn('_One');
$naming->shouldReceive('deriveClassName')->with('Foo\Bar\Baz')->andReturn('_Foo_Bar_Baz');
$naming->shouldReceive('deriveClassName')->with('Lorem\Ipsum')->andReturn('_Lorem_Ipsum');
$naming->shouldReceive('deriveClassName')->with('Alpha\Beta\Gamma\Delta')->andReturn('_Alpha_Beta_Gamma_Delta');

$generator->shouldReceive('generate')->with('Foo\Bar\Baz')->once()->andReturn('namespace _Accessor; class _Foo_Bar_Baz { }');
$generator->shouldReceive('generate')->with('Lorem\Ipsum')->once()->andReturn('namespace _Accessor; class _Lorem_Ipsum { }');

$cache->shouldReceive('load')->with('_Lorem_Ipsum')->andReturn(FALSE);
$cache->shouldReceive('load')->with('_Alpha_Beta_Gamma_Delta')->andReturnUsing(function () {
		class _Alpha_Beta_Gamma_Delta { }
		return TRUE;
	});

$cache->shouldReceive('save')->with('_Lorem_Ipsum', 'namespace _Accessor; class _Lorem_Ipsum { }')->once();

$factory = new Factory($naming, $generator);

// existing class
class _One { }
Assert::type('_Accessor\_One', $factory->create('One'));

// no cache
Assert::type('_Accessor\_Foo_Bar_Baz', $factory->create('Foo\Bar\Baz'));

$factory->setCache($cache);

// cache miss
Assert::type('_Accessor\_Lorem_Ipsum', $factory->create('Lorem\Ipsum'));

// cache hit
Assert::type('_Accessor\_Alpha_Beta_Gamma_Delta', $factory->create('Alpha\Beta\Gamma\Delta'));

Mockery::close();

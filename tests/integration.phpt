<?php

/**
 * Integration test of whole Markatom\Accessor library.
 */

use Markatom\Accessor\Factory;
use Markatom\Accessor\Generator;
use Markatom\Accessor\Naming;
use Markatom\Accessor\Registry;
use Tester\Assert;

require __DIR__ . '/bootstrap.php';

class Foo
{
	public $public = 1;
	protected $protected = 2;
	private $private = 3;
}

$foo = new Foo;

// wire up
$naming    = new Naming;
$generator = new Generator($naming);
$factory   = new Factory($naming, $generator);
$registry  = new Registry($factory);

$fooAccessor = $registry->getAccessor('Foo');

Assert::same([
	'public'    => 1,
	'protected' => 2,
	'private'   => 3,
], $fooAccessor->read($foo));

$fooAccessor->write($foo, [
	'public'    => 4,
	'protected' => 5,
	'private'   => 6,
]);

ob_start();
var_dump($foo);
$actual = ob_get_clean();

$expected = <<<'END'
object(Foo)#5 (3) {
  ["public"]=>
  int(4)
  ["protected":protected]=>
  int(5)
  ["private":"Foo":private]=>
  int(6)
}

END;

Assert::same($expected, $actual);

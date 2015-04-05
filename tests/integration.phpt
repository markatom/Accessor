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
	public $public;
	protected $protected;
	private $private;

	public function __construct($public, $protected, $private)
	{
		$this->public    = $public;
		$this->protected = $protected;
		$this->private   = $private;
	}
}

$foo = new Foo(1, 2, 3);

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

Assert::equal($foo, new Foo(4, 5, 6));

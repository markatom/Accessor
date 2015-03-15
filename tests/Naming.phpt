<?php

/**
 * Unit test for Markatom\Accessor\Naming.
 */

use Markatom\Accessor\Naming;
use Tester\Assert;

require __DIR__ . '/bootstrap.php';

$naming = new Naming;

Assert::same('_Accessor', $naming->getNamespace());
Assert::same('_Foo_Bar', $naming->deriveClassName('\Foo\Bar'));
Assert::same('_Lorem_Ipsum_Dolor', $naming->deriveClassName('Lorem\Ipsum\Dolor'));

$naming = new Naming('Foo');

Assert::same('Foo', $naming->getNamespace());

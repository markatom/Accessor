<?php

/**
 * Unit test for Markatom\Accessor\FileCache.
 */

use Markatom\Accessor\FileCache;
use Markatom\Accessor\Naming;
use Tester\Assert;

require __DIR__ . '/bootstrap.php';

// create temporary directory
umask(0);
$directory = '/tmp/markatom-accessor-test-' . getmypid();
Tester\Helpers::purge($directory);

$fileCache = new FileCache($directory);

Assert::false($fileCache->load('_Foo_Bar_Baz'));

$fileCache->save('_Foo_Bar_Baz', 'class _Foo_Bar_Baz { }');

Assert::false(class_exists('_Foo_Bar_Baz'));
Assert::true($fileCache->load('_Foo_Bar_Baz'));
Assert::true(class_exists('_Foo_Bar_Baz'));

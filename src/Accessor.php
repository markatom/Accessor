<?php

/**
 * Copyright 2015 Tomáš Markacz <tomas@markacz.com>.
 *
 * For the full copyright and license information, please view the file LICENSE.md
 * that was distributed with this source code.
 */

namespace Markatom\Accessor;

/**
 * Accessor can fast access all properties of object.
 * Every accessor is bound to instances of particular class.
 *
 * @author Tomáš Markacz <tomas@markacz.com>
 */
interface Accessor
{

	/**
	 * @param object $object
	 * @return array
	 */
	function read($object);

	/**
	 * @param object $object
	 * @param array $data
	 */
	function write($object, array $data);

}

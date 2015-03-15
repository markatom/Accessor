<?php

/**
 * Copyright 2015 Tomáš Markacz <tomas@markacz.com>.
 *
 * For the full copyright and license information, please view the file LICENSE.md
 * that was distributed with this source code.
 */

namespace Markatom\Accessor;

/**
 * Cache for accessor's definition.
 *
 * @author Tomáš Markacz <tomas@markacz.com>
 */
interface Cache
{

	/**
	 * @param string $class
	 * @param string $definition
	 * @return void
	 */
	function save($class, $definition);

	/**
	 * @param string $class
	 * @return bool
	 */
	function load($class);

}

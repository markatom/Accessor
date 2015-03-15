<?php

/**
 * Copyright 2015 Tomáš Markacz <tomas@markacz.com>.
 *
 * For the full copyright and license information, please view the file LICENSE.md
 * that was distributed with this source code.
 */

namespace Markatom\Accessor;

/**
 * Naming for generated accessor classes.
 *
 * @author Tomáš Markacz <tomas@markacz.com>
 */
class Naming
{

	/** @var string */
	private $namespace;

	/**
	 * @param string $namespace
	 */
	public function __construct($namespace = '_Accessor')
	{
	    $this->namespace = $namespace;
	}

	/**
	 * @param string $class
	 * @return string
	 */
	public function deriveClassName($class)
	{
		return '_' . str_replace('\\', '_', ltrim($class, '\\'));
    }

	/**
	 * @return string
	 */
	public function getNamespace()
	{
		return $this->namespace;
	}

}

<?php

/**
 * Copyright 2015 Tomáš Markacz <tomas@markacz.com>.
 *
 * For the full copyright and license information, please view the file LICENSE.md
 * that was distributed with this source code.
 */

namespace Markatom\Accessor;

/**
 * Accessor registry.
 *
 * @author Tomáš Markacz <tomas@markacz.com>
 */
class Registry
{

	/** @var Factory */
	private $factory;

	/** @var Accessor[] */
	private $accessors = [];

	/**
	 * @param Factory $factory
	 */
	public function __construct(Factory $factory)
	{
		$this->factory = $factory;
	}

	/**
	 * Gets accessor for instances of given class.
	 * @param $class
	 * @return Accessor
	 */
	public function getAccessor($class)
	{
		return isset($this->accessors[$class])
			? $this->accessors[$class]
			: $this->accessors[$class] = $this->factory->create($class);
	}

}

<?php

/**
 * Copyright 2015 Tomáš Markacz <tomas@markacz.com>.
 *
 * For the full copyright and license information, please view the file LICENSE.md
 * that was distributed with this source code.
 */

namespace Markatom\Accessor;

/**
 * Accessor factory.
 *
 * @author Tomáš Markacz <tomas@markacz.com>
 */
class Factory
{

	/** @var Naming */
	private $naming;

	/** @var Generator */
	private $generator;

	/** @var Cache|NULL */
	private $cache;

	/**
	 * @param Naming $naming
	 * @param Generator $generator
	 */
	public function __construct(Naming $naming, Generator $generator)
	{
		$this->naming    = $naming;
		$this->generator = $generator;
	}

	/**
	 * @param Cache $cache
	 */
	public function setCache(Cache $cache)
	{
		$this->cache = $cache;
	}

	/**
	 * Creates accessor for instances of given class.
	 * @param string $class
	 * @return Accessor
	 */
	public function create($class)
	{
		$name       = $this->naming->deriveClassName($class);
		$namespaced = $this->naming->getNamespace() . '\\' . $name;

		if (class_exists($namespaced) || $this->cache && $this->cache->load($name)) {
			return new $namespaced;
		}

		$definition = $this->generator->generate($class);

		if ($this->cache) {
			$this->cache->save($name, $definition);
		}

		eval($definition);

		return new $namespaced;
	}

}

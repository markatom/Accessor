<?php

/**
 * Copyright 2015 Tomáš Markacz <tomas@markacz.com>.
 *
 * For the full copyright and license information, please view the file LICENSE.md
 * that was distributed with this source code.
 */

namespace Markatom\Accessor;

/**
 * File cache for accessor's definition.
 *
 * @author Tomáš Markacz <tomas@markacz.com>
 */
class FileCache implements Cache
{

	/** @var string */
	private $directory;

	/**
	 * @param string $directory
	 */
    public function __construct($directory)
    {
        $this->directory = rtrim($directory, '/');
    }

	/**
	 * @param string $class
	 * @param string $definition
	 */
	public function save($class, $definition)
	{
		@mkdir($this->directory, 0777, TRUE); // directory may exists

		$path    = $this->directory . '/' . $class . '.php';
		$content = "<?php\n\n$definition";

		if (@file_put_contents($path, $content) === FALSE) { // check for errors
			throw new CacheWriteException("Unable to write file $path.");
		}
	}

	/**
	 * @param string $class
	 * @return bool
	 */
	public function load($class)
	{
		$path = $this->directory . '/' . $class . '.php';

		if (file_exists($path)) {
			require $path;

			return TRUE;
		}

		return FALSE;
	}

}

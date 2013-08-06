<?php namespace Modulework\Modules\File;
/*
 * (c) Christian Gärtner <christiangaertner.film@googlemail.com>
 * This file is part of the Modulework Framework
 * License: View distributed LICENSE file
 */

use SplFileInfo;
use Modulework\Modules\File\Exceptions\FileNotFoundException;

/**
* File
* This class represents a file.
*/
class File extends SplFileInfo
{

	/**
	 * Constructor.
	 * Create a new File instance for a file
	 * @param string  $path   The file' s path
	 * @param boolean $verify Whether to check for existens
	 */
	public function __construct($path, $verify = true)
	{
		if ($verify && !FileSystem::exists($path)) {
			throw new FileNotFoundException($path);
		}

		parent::__construct($path);
	}

	public function getExtension()
	{
		return pathinfo($this->getBasename(), PATHINFO_EXTENSION);
	}

	public function move($targetDir, $targetName = null, $mode = 0666)
	{
		$target = $this->getTargetFile($targetDir, $targetName);

		FileSystem::move($this->getPathname(), $target);

		// Fix perms
		FileSystem::chmod($target, $mode);

		return $target;
	}

	protected function getTargetFile($dir, $name = null, $mode = 0666)
	{
		if (!FileSystem::isDirectory($dir)) {
			FileSystem::makeDirectory($dir, $mode, true);
		}
	}

}
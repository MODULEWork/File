<?php namespace Modulework\Modules\File;
/*
 * (c) Christian Gärtner <christiangaertner.film@googlemail.com>
 * This file is part of the Modulework Framework
 * License: View distributed LICENSE file
 */

use Modulework\Modules\File\Filesystem;
use Modulework\Modules\File\FileSystemInterface;
use Modulework\Modules\File\Exceptions\FileNotFoundException;

/**
* File
* This class represents a file.
*/
class File
{
	protected $path;

	protected $filesystem;

	public static function open($path, $verify = false, FileSystemInterface $filesystem = null)
	{
		return new static($path, $verify, $filesystem);
	}

	public function __construct($path, $verify = false, FileSystemInterface $filesystem = null)
	{
		$this->setFilesystem($filesystem);
		if ($verify && !$this->filesystem->exists($path)) {
			throw new FileNotFoundException('File not found at "' . $path . '".');
		}

		$this->path = (string) $path;
	}

	public function __toString()
	{
		return $this->path;
	}

	public function setFileSystem(FileSystemInterface $filesystem = null)
	{
		if ($filesystem === null) {
			$this->filesystem = new Filesystem;
		} else {
			$this->filesystem = $filesystem;
		}
	}

	public function getFileSystem()
	{
		return $this->filesystem;
	}

	public function create()
	{
		return $this->filesystem->create($this->path);
	}

	public function extension()
	{
		return $this->filesystem->extension($this->path);
	}

	public function get()
	{
		return $this->filesystem->get($this->path);
	}

	public function size()
	{
		return $this->filesystem->size($this->path);
	}

	public function put($data)
	{
		return $this->filesystem->put($this->path, $data);
	}

	public function append($data)
	{
		return $this->filesystem->append($this->path, $data);
	}

	public function delete()
	{
		return $this->filesystem->delete($this->path);
	}

	public function move($dest)
	{
		return $this->filesystem->move($this->path, $dest);
	}

	public function copy($dest)
	{
		return $this->filesystem->copy($this->path, $dest);
	}

	public function symlink($dest)
	{
		return $this->filesystem->symlink($this->path, $dest);
	}

	public function isWritable()
	{
		return $this->filesystem->isWritable($this->path);
	}

	public function isReadable()
	{
		return $this->filesystem->isReadable($this->path);
	}

	public function isDirectory()
	{
		return $this->filesystem->isDirectory($this->path);
	}

	public function isFile()
	{
		return $this->filesystem->isFile($this->path);
	}

	public function type()
	{
		return $this->filesystem->type($this->path);
	}

	public function accessTime()
	{
		return $this->filesystem->accessTime($this->path);
	}

	public function modifiedTime()
	{
		return $this->filesystem->modifiedTime($this->path);
	}

	public function creationTime()
	{
		return $this->filesystem->creationTime($this->path);
	}

	public function chmod($permissions)
	{
		return $this->filesystem->chmod($this->path, $permissions);
	}

	public function chown($owner)
	{
		return $this->filesystem->chown($this->path, $owner);
	}

	public function setPermissions($permissions)
	{
		return $this->filesystem->setPermissions($this->path, $permissions);
	}

	public function getPermissions()
	{
		return $this->filesystem->getPermissions($this->path);
	}


}
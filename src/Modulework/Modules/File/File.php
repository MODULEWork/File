<?php namespace Modulework\Modules\File;
/*
 * (c) Christian Gärtner <christiangaertner.film@googlemail.com>
 * This file is part of the Modulework Framework
 * License: View distributed LICENSE file
 */

use Modulework\Modules\File\Exceptions\FileNotFoundException;

/**
* File
* This class represents a file.
*/
class File
{
	protected $path;

	protected $filesystem;

	/**
	 * Factory.
	 * Open a file from the filesystem
	 * @param  string  $path       The path to the file
	 * @param  boolean $verify     Whether to check for file existings (default: TRUE)
	 * 
	 * @param  \Modulework\Modules\File\FileSystemInterface  $filesystem The FileSystem
	 * @return Modulework\Modules\File\File             				 The new file instance
	 */
	public static function open($path, $verify = true, FileSystemInterface $filesystem = null)
	{
		return new static($path, $verify, $filesystem);
	}

	/**
	 * Factory.
	 * Load a file.
	 * @param  string  $path       The path to the file
	 * @param  boolean $verify     Whether to check for file existings (default: FALSE)
	 * 
	 * @param  \Modulework\Modules\File\FileSystemInterface  $filesystem The FileSystem
	 * @return Modulework\Modules\File\File             				 The new file instance
	 */
	public static function load($path, $verify = false, FileSystemInterface $filesystem = null)
	{
		return new static($path, $verify, $filesystem);
	}

	/**
	 * Constructor.
	 * @param  string  $path       The path to the file
	 * @param  boolean $verify     Whether to check for file existings (default: FALSE)
	 * 
	 * @param  \Modulework\Modules\File\FileSystemInterface  $filesystem The FileSystem
	 */
	public function __construct($path, $verify = false, FileSystemInterface $filesystem = null)
	{
		$this->setFilesystem($filesystem);
		if ($verify && !$this->filesystem->exists($path)) {
			throw new FileNotFoundException('File not found at "' . $path . '".');
		}

		$this->path = (string) $path;
	}

	/**
	 * Magic Method
	 * @return string The path to the file
	 */
	public function __toString()
	{
		return $this->path;
	}

	/**
	 * Dependecy Injection.
	 * Set the FileSystem
	 * @param \Modulework\Modules\File\FileSystemInterface  $filesystem The FileSystem
	 */
	public function setFileSystem(FileSystemInterface $filesystem = null)
	{
		if ($filesystem === null) {
			$this->filesystem = new FileSystem;
		} else {
			$this->filesystem = $filesystem;
		}
	}

	/**
	 * Returns the current FileSystem
	 * @return \Modulework\Modules\File\FileSystemInterface 	The FileSystem
	 */
	public function getFileSystem()
	{
		return $this->filesystem;
	}

	/**
	 * Create the file
	 * @return int The bytes written
	 *
	 * @throws IOException (FileSystemInterface::create())
	 */
	public function create()
	{
		return $this->filesystem->create($this->path);
	}

	/**
	 * Get the extension of the file
	 * @return string The extension
	 *
	 * @throws FileNotFoundException (FileSystemInterface::extension())
	 */
	public function extension()
	{
		return $this->filesystem->extension($this->path);
	}

	/**
	 * Get the contents of the file
	 * @return string The data
	 *
	 * @throws FileNotFoundException (FileSystemInterface::get())
	 */
	public function get()
	{
		return $this->filesystem->get($this->path);
	}

	/**
	 * Get the filesize
	 * @return int The size
	 *
	 * @throws FileNotFoundException (FileSystemInterface::size())
	 */
	public function size()
	{
		return $this->filesystem->size($this->path);
	}

	/**
	 * Put data into the file
	 * Overwrittes current values
	 * @param  mixed $data The data to save
	 * @return int       The bytes written
	 *
	 * @throws IOException (FileSystemInterface::put())
	 */
	public function put($data)
	{
		return $this->filesystem->put($this->path, $data);
	}

	/**
	 * Append data to the file
	 * @param  mixed $data The data to append
	 * @return int       The bytes written
	 *
	 * @throws FileNotFoundException (FileSystemInterface::append())
	 * @throws IOException (FileSystemInterface::append())
	 */
	public function append($data)
	{
		return $this->filesystem->append($this->path, $data);
	}

	/**
	 * Deletes the file
	 * @return bool Whether the delete was successfull
	 *
	 * @throws IOException (FileSystemInterface::delete())
	 */
	public function delete()
	{
		return $this->filesystem->delete($this->path);
	}

	/**
	 * Move the file
	 * @param  string $dest The destination path
	 * @return bool       Whether the move was successfull
	 *
	 * @throws FileNotFoundException (FileSystemInterface::move())
	 * @throws IOException (FileSystemInterface::move())
	 */
	public function move($dest)
	{
		return $this->filesystem->move($this->path, $dest);
	}

	/**
	 * Copy the file
	 * @param  string $dest The destination path
	 * @return bool       Whether the copy was successfull
	 *
	 * @throws FileNotFoundException (FileSystemInterface::copy())
	 * @throws IOException (FileSystemInterface::copy())
	 */
	public function copy($dest)
	{
		return $this->filesystem->copy($this->path, $dest);
	}

	/**
	 * Symlink the file
	 * @param  string $dest The destination path
	 * @return bool       Whether the symlink was successfull
	 *
	 * @throws FileNotFoundException (FileSystemInterface::symlink())
	 * @throws IOException (FileSystemInterface::symlink())
	 */
	public function symlink($dest)
	{
		return $this->filesystem->symlink($this->path, $dest);
	}

	/**
	 * Whether the file is writable
	 * @return boolean Whether the file is writable
	 *
	 * @throws FileNotFoundException (FileSystemInterface::isWritable())
	 */
	public function isWritable()
	{
		return $this->filesystem->isWritable($this->path);
	}

	/**
	 * Whether the file is readable
	 * @return boolean Whether the file is readable
	 *
	 * @throws FileNotFoundException (FileSystemInterface::isReadable())
	 */
	public function isReadable()
	{
		return $this->filesystem->isReadable($this->path);
	}

	/**
	 * Get the type of this file
	 * @return string The file type
	 *
	 * @throws FileNotFoundException (FileSystemInterface::type())
	 * @throws IOException (FileSystemInterface::type())
	 */
	public function type()
	{
		return $this->filesystem->type($this->path);
	}

	/**
	 * Get the access time of this file
	 * @return int The file access time
	 *
	 * @throws FileNotFoundException (FileSystemInterface::accessTime())
	 * @throws IOException (FileSystemInterface::accessTime())
	 */
	public function accessTime()
	{
		return $this->filesystem->accessTime($this->path);
	}

	/**
	 * Get the modified time of this file
	 * @return int The file modified time
	 *
	 * @throws FileNotFoundException (FileSystemInterface::modifiedTime())
	 * @throws IOException (FileSystemInterface::modifiedTime())
	 */
	public function modifiedTime()
	{
		return $this->filesystem->modifiedTime($this->path);
	}

	/**
	 * Get the creation time of this file
	 * @return int The file creation time
	 *
	 * @throws FileNotFoundException (FileSystemInterface::creationTime())
	 * @throws IOException (FileSystemInterface::creationTime())
	 */
	public function creationTime()
	{
		return $this->filesystem->creationTime($this->path);
	}

	/**
	 * Chmod the file
	 * @param  string $permissions The new permissions of this file
	 * @return bool        Whether the chmod was successfull
	 *
	 * @throws FileNotFoundException (FileSystemInterface::chmod())
	 * @throws IOException (FileSystemInterface::chmod())
	 */
	public function chmod($permissions)
	{
		return $this->filesystem->chmod($this->path, $permissions);
	}

	/**
	 * Chown the file
	 * @param  string $owner The new owner of this file
	 * @return bool        Whether the chown was successfull
	 *
	 * @throws FileNotFoundException (FileSystemInterface::chown())
	 * @throws IOException (FileSystemInterface::chown())
	 */
	public function chown($owner)
	{
		return $this->filesystem->chown($this->path, $owner);
	}

	/**
	 * Set the permissions for this file
	 * @uses chmod()
	 * @param string $permissions The new permissions of this file
	 *
	 * @throws FileNotFoundException (chmod())
	 * @throws IOException (chmod())
	 */
	public function setPermissions($permissions)
	{
		return $this->filesystem->setPermissions($this->path, $permissions);
	}

	/**
	 * Get the current permissions of this file
	 * @return null
	 * 
	 * @throws FileNotFoundException (FileSystemInterface::getPermissions())
	 * @throws Exception (FileSystemInterface::getPermissions())
	 */
	public function getPermissions()
	{
		return $this->filesystem->getPermissions($this->path);
	}


}
<?php namespace Modulework\Modules\File
{

}
/*
 * (c) Christian Gärtner <christiangaertner.film@googlemail.com>
 * This file is part of the Modulework Framework
 * License: View distributed LICENSE file
 */

/**
* {@inheritdoc}
*/
class FileSystem implements FileSystemInterface
{



	/**
	 * {@inheritdoc}
	 */
	public static function glob($path, $flags = 0)
	{
		return glob($pattern, $flags);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function files($path)
	{
		$glob = $this->glob($path . '/*');

		if ($glob === false) return array();

		return array_filter($glob, function($item)
		{
			return filetype($item) == 'file';
		});
	}

	/**
	 * {@inheritdoc}
	 */
	public static function all($path)
	{
		// TO BE WRITTEN
		throw new Exception('Unsupported Operation.');
		
	}

	/**
	 * {@inheritdoc}
	 */
	public static function directories($path)
	{
		// TO BE WRITTEN
		throw new Exception('Unsupported Operation.');
	}

	/**
	 * {@inheritdoc}
	 */
	public static function makeDirectory($path, $mode, $recursive = false)
	{
		return mkdir($path, $mode, $recursive);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function copyDirectory($path, $dest)
	{
		if (!$this->isDirectory($path)) return false;

		if (!$this->isDirectory($dest)) {
			$this->makeDirectory($dest, 0777, true);
		}

		$items = new FilesystemIterator($path, FilesystemIterator::SKIP_DOTS);

		foreach ($items as $item) {
			$tar = $dest . '/' . $item->getBaseName();

			if ($item->isDir()) {
				$tmp_path = $item->getPathname();

				if (!$this->copyDirectory($tmp_path, $tar)) return false;
			} else {
				if (!$this->copy($item->getPathname(), $tar)) return false;

			}
		}

		return true;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function deleteDirectory($path, $preserve = false)
	{
		if (!$this->isDirectory($path)) return;

		$items = new FilesystemIterator($path);

		foreach ($items as $item) {
			if ($item->isDir()) {
				$this->deleteDirectory($item->getPathname());
			} else {
				$this->delete($item->getPathname());
			}
		}

		if (!$preserve) @rmdir($path);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function emptyDirectory($path)
	{
		return $this->deleteDirectory($path, true);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function exists($path)
	{
		return file_exists($path);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function create($path)
	{
		return file_put_contents($path, null);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function extension($path)
	{
		return pathinfo($path, PATHINFO_EXTENSION);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function get($path)
	{
		if ($this->isFile($path)) return file_get_contents($path);

		throw new FileNotFoundException('File does not exist at "' . $path . '".');
	}

	/**
	 * {@inheritdoc}
	 */
	public static function getRemote($path)
	{
		return file_get_contents($path);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function size($path)
	{
		return filesize($path);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function put($path, $data)
	{
		return file_put_contents($path, $data);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function append($path, $data)
	{
		return file_put_contents($path, $data, FILE_APPEND);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function delete($path)
	{
		return @unlink($path);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function move($org, $dest)
	{
		return rename($org, $dest);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function copy($org, $dest)
	{
		return copy($org, $dest);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function symLink($org, $dest)
	{
		return symlink($org, $dest);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function isWritable($path)
	{
		return is_writable($path);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function isReadable($path)
	{
		return is_readable($path);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function isDirectory($path)
	{
		return is_dir($path);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function isFile($path)
	{
		return is_file($file);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function type($path)
	{
		return filetype($path);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function accessTime($path)
	{
		return fileatime($path);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function modifiedTime($path)
	{
		return filemtime($path);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function creationTime($path)
	{
		return filectime($path);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function chmod($path, $permissions)
	{
		if (is_string($permissions)) {
			$permissions = '0' . ltrim($permissions, '0');
			$permissions = octdec($permissions);
		}

		return chmod($this->path, $permissions);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function chown($path, $owner)
	{
		return chmod($this->path, $owner);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function setPermissions($path, $permissions)
	{
		self::chmod($path, $permissions);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function getPermissions($path)
	{

	}
}
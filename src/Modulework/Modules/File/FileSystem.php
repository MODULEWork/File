<?php namespace Modulework\Modules\File;
/*
 * (c) Christian Gärtner <christiangaertner.film@googlemail.com>
 * This file is part of the Modulework Framework
 * License: View distributed LICENSE file
 */

use Modulework\Modules\File\Exceptions\FileNotFoundException;
use Modulework\Modules\File\Exceptions\IOException;

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
		$ret = glob($path, $flags);
		if ($ret === false) {
			throw new IOExceptionException('Could not glob directory.');
		} else {
			return $ret;
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public static function files($path)
	{
		$glob = self::glob($path . '/*');

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
		$ret = @file_put_contents($path, null);
		if ($ret === false) {
			throw new IOException('Could not put data.');
		} else {
			return $ret;
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public static function extension($path)
	{
		if (!self::isFile($path)) {
			throw new FileNotFoundException('File does not exist at "' . $path . '".');
		}
		return pathinfo($path, PATHINFO_EXTENSION);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function get($path)
	{
		if (self::isFile($path)) return file_get_contents($path);

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
		if (!self::isFile($path)) {
			throw new FileNotFoundException('File does not exist at "' . $path . '".');
		}
		return filesize($path);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function put($path, $data)
	{
		$ret = @file_put_contents($path, $data);
		if ($ret === false) {
			throw new IOException('Could not put data.');
		} else {
			return $ret;
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public static function append($path, $data)
	{
		if (!self::isFile($path)) {
			throw new FileNotFoundException('File does not exist at "' . $path . '".');
		}
		$ret = file_put_contents($path, $data, FILE_APPEND);

		if ($ret === false) {
			throw new IOException('Could not put data.');
		} else {
			return $ret;
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public static function delete($path)
	{
		$ret = @unlink($path);
		if ($ret === false) {
			throw new IOException('Could not delete file.');
		} else {
			return $ret;
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public static function move($org, $dest)
	{
		if (!self::isFile($org)) {
			throw new FileNotFoundException('File does not exist at "' . $org . '".');
		}
		$ret = rename($org, $dest);
		if ($ret === false) {
			throw new IOException('Could not move file.');
		} else {
			return $ret;
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public static function copy($org, $dest)
	{
		if (!self::isFile($org)) {
			throw new FileNotFoundException('File does not exist at "' . $org . '".');
		}
		$ret = copy($org, $dest);
		if ($ret === false) {
			throw new IOException('Could not copy file.');
		} else {
			return $ret;
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public static function symLink($org, $dest)
	{
		if (!self::isFile($org)) {
			throw new FileNotFoundException('File does not exist at "' . $org . '".');
		}
		$ret = symlink($org, $dest);
		if ($ret === false) {
			throw new IOException('Could not symlink file.');
		} else {
			return $ret;
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public static function isWritable($path)
	{
		if (!self::isFile($path)) {
			throw new FileNotFoundException('File does not exist at "' . $path . '".');
		}
		return is_writable($path);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function isReadable($path)
	{
		if (!self::isFile($path)) {
			throw new FileNotFoundException('File does not exist at "' . $path . '".');
		}
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
		if (!self::isFile($path)) {
			throw new FileNotFoundException('File does not exist at "' . $path . '".');
		}
		$ret = @filetype($path);
		if ($ret === false) {
			throw new IOException('Could not get type of file.');
		} else {
			return $ret;
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public static function accessTime($path)
	{
		if (!self::isFile($path)) {
			throw new FileNotFoundException('File does not exist at "' . $path . '".');
		}
		$ret = @fileatime($path);
		if ($ret === false) {
			throw new IOException('Could not get access time of file.');
		} else {
			return $ret;
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public static function modifiedTime($path)
	{
		if (!self::isFile($path)) {
			throw new FileNotFoundException('File does not exist at "' . $path . '".');
		}
		$ret = @filemtime($path);
		if ($ret === false) {
			throw new IOException('Could not get modified time of file.');
		} else {
			return $ret;
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public static function creationTime($path)
	{
		if (!self::isFile($path)) {
			throw new FileNotFoundException('File does not exist at "' . $path . '".');
		}
		$ret = @filectime($path);
		if ($ret === false) {
			throw new IOException('Could not get creation time of file.');
		} else {
			return $ret;
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public static function chmod($path, $permissions)
	{
		if (!self::isFile($path)) {
			throw new FileNotFoundException('File does not exist at "' . $path . '".');
		}
		if (is_string($permissions)) {
			$permissions = '0' . ltrim($permissions, '0');
			$permissions = octdec($permissions);
		}

		$ret = chmod($path, $owner);
		if ($ret === false) {
			throw new IOException('Could not chmod the file.');
		} else {
			return $ret;
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public static function chown($path, $owner)
	{
		if (!self::isFile($path)) {
			throw new FileNotFoundException('File does not exist at "' . $path . '".');
		}
		$ret = chown($path, $owner);
		if ($ret === false) {
			throw new IOException('Could not chown the file.');
		} else {
			return $ret;
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public static function setPermissions($path, $permissions)
	{
		if (!self::isFile($path)) {
			throw new FileNotFoundException('File does not exist at "' . $path . '".');
		}
		self::chmod($path, $permissions);
	}

	/**
	 * {@inheritdoc}
	 */
	public static function getPermissions($path)
	{
		if (!self::isFile($path)) {
			throw new FileNotFoundException('File does not exist at "' . $path . '".');
		}
		// TO BE WRITTEN
		throw new Exception('Unsupported Operation.');
	}
}
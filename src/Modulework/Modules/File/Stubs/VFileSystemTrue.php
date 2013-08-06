<?php namespace Modulework\Modules\File\Stubs;
/*
 * (c) Christian Gärtner <christiangaertner.film@googlemail.com>
 * This file is part of the Modulework Framework Tests
 * License: View distributed LICENSE file
 *
 * 
 * This file is meant to be used in PHPUnit Tests as a stub
 */

use Modulework\Modules\File\FileSystemInterface;

/**
* PHPUnit Test
*/
class VFileSystemTrue implements FileSystemInterface
{
	public static function glob($path, $flags = 0)
	{
		return true;
	}
	public static function files($path)
	{
		return true;
	}
	public static function all($path)
	{
		return true;
	}
	public static function directories($path)
	{
		return true;
	}
	public static function makeDirectory($path, $mode, $recursive = false)
	{
		return true;
	}
	public static function copyDirectory($path, $dest)
	{
		return true;
	}
	public static function deleteDirectory($path, $preserve = false)
	{
		return true;
	}
	public static function emptyDirectory($path)
	{
		return true;
	}

	public static function exists($path)
	{
		return true;
	}
	public static function create($path)
	{
		return true;
	}
	public static function extension($path)
	{
		return true;
	}
	public static function get($path)
	{
		return true;
	}
	public static function getRemote($path)
	{
		return true;
	}
	public static function size($path)
	{
		return true;
	}
	public static function put($path, $data)
	{
		return true;
	}
	public static function append($path, $data)
	{
		return true;
	}
	public static function delete($path)
	{
		return true;
	}
	public static function move($org, $dest)
	{
		return true;
	}
	public static function copy($org, $dest)
	{
		return true;
	}
	public static function symLink($org, $dest)
	{
		return true;
	}
	public static function isWritable($path)
	{
		return true;
	}
	public static function isReadable($path)
	{
		return true;
	}
	public static function isDirectory($path)
	{
		return true;
	}
	public static function isFile($path)
	{
		return true;
	}
	public static function type($path)
	{
		return true;
	}
	public static function accessTime($path)
	{
		return true;
	}
	public static function modifiedTime($path)
	{
		return true;
	}
	public static function creationTime($path)
	{
		return true;
	}
	public static function chmod($path, $permissions)
	{
		return true;
	}
	public static function chown($path, $owner)
	{
		return true;
	}
	public static function setPermissions($path, $permissions)
	{
		return true;
	}
	public static function getPermissions($path)
	{
		return true;
	}
}
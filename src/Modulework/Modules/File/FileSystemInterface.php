<?php namespace Modulework\Modules\File;
/*
 * (c) Christian Gärtner <christiangaertner.film@googlemail.com>
 * This file is part of the Modulework Framework
 * License: View distributed LICENSE file
 */

/**
* FileSystem
* Represents the Filesystem.
*/
interface FileSystemInterface
{

	public static function glob($path);
	public static function files($path);
	public static function all($path);
	public static function directories($path);
	public static function makeDirectory($path, $mode, $recursive = false);
	public static function copyDirectory($path, $dest);
	public static function deleteDirectory($path, $preserve = false);
	public static function emptyDirectory($path);

	public static function exists($path);
	public static function touch($path);
	public static function extension($path);
	public static function get($path);
	public static function size($path);
	public static function put($path, $data);
	public static function append($path, $data);
	public static function delete($path);
	public static function move($org, $dest);
	public static function copy($org, $dest);
	public static function symLink($org, $dest);
	public static function isWritable($path);
	public static function isReadable($path);
	public static function isDirectory($path);
	public static function isFile($path);
	public static function type($path);
	public static function accessTime($path);
	public static function modifiedTime($path);
	public static function creationTime($path);
	public static function setPermissions($path, $permissions);
	public static function getPermissions($path);
}
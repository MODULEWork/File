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
	/**
	 * Glob a directory
	 * @param  string  $path  The pattern
	 * @param  integer $flags The flags
	 * @return array         The files
	 *
	 * @throws IOException
	 */
	public static function glob($path, $flags = 0);

	/**
	 * List a files of the given diretory
	 * @param  string $path The pattern
	 * @return array       The files
	 *
	 * @uses glob()
	 * 
	 * @throws IOException
	 */
	public static function files($path);
	
	/**
	 * To be written
	 * @throws Exception
	 */
	public static function all($path);

	/**
	 * To be written
	 * @throws Exception
	 */
	public static function directories($path);
	public static function makeDirectory($path, $mode, $recursive = false);
	public static function copyDirectory($path, $dest);
	public static function deleteDirectory($path, $preserve = false);
	public static function emptyDirectory($path);

	/**
	 * Checks if a file exists
	 * @param  string $path The path to the file
	 * @return bool       Whether the file exists
	 */
	public static function exists($path);

	/**
	 * Create the file
	 * @param string $path The filename
	 * @return int The bytes written
	 *
	 * @throws IOException
	 */
	public static function create($path);

	/**
	 * Returns the extension for the given file
	 * @param  string $path The path to the file
	 * @return string       The extension
	 */
	public static function extension($path);

	/**
	 * Returns the contents of the file
	 * @param  string $path The path to the file
	 * @return string       The file' s content
	 *
	 * @throws \Modulework\Modules\File\Exceptions\FileNotFoundException
	 */
	public static function get($path);

	/**
	 * Returns the content of a remote file
	 * @param  string $path The URL
	 * @return string       The content
	 */
	public static function getRemote($path);
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
	public static function chmod($path, $permissions);
	public static function chown($path, $owner);
	public static function setPermissions($path, $permissions);
	public static function getPermissions($path);
}
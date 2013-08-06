<?php
/*
 * (c) Christian Gärtner <christiangaertner.film@googlemail.com>
 * This file is part of the Modulework Framework Tests
 * License: View distributed LICENSE file
 *
 * 
 * This file is meant to be used in PHPUnit Tests
 */

use Modulework\Modules\File\File;
use Modulework\Modules\File\FileSystem;
use Modulework\Modules\File\Stubs\VFileSystemTrue;

/**
* PHPUnit Test
*/
class FileTest extends PHPUnit_Framework_TestCase
{

	protected $VFileSystem;

	public function setUp()
	{
		$this->VFileSystem = new VFileSystemTrue;
	}

	public function testOpen()
	{
		$file = File::open('foo');

		$this->assertInstanceOf('Modulework\Modules\File\File', $file);
	}

	public function testConstruct()
	{
		$file = File::open('foo');

		$path = new ReflectionProperty($file, 'path');
		$path->setAccessible(true);

		$filesystem = new ReflectionProperty($file, 'filesystem');
		$filesystem->setAccessible(true);

		$this->assertInstanceOf('Modulework\Modules\File\FileSystem', $filesystem->getValue($file));
	}

	/**
	 * @expectedException Modulework\Modules\File\Exceptions\FileNotFoundException
	 */
	public function testConstructException()
	{
		$file = File::open('foo', true);
	}

	public function testSetFileSystem()
	{
		$file = File::open('foo');
		$file->setFileSystem(new FileSystem);

		$filesystem = new ReflectionProperty($file, 'filesystem');
		$filesystem->setAccessible(true);

		$this->assertInstanceOf('Modulework\Modules\File\FileSystem', $filesystem->getValue($file));
	}

	public function testGetFileSystem()
	{
		$file = File::open('foo');
		$file->setFileSystem(new FileSystem);

		$this->assertInstanceOf('Modulework\Modules\File\FileSystem', $file->getFileSystem());
	}

	public function testToString()
	{
		$file = File::open('foo');

		$this->assertEquals('foo', $file);
	}

	public function testCreate()
	{
		$file = File::open('foo', false, $this->VFileSystem);

		$this->assertTrue($file->create());
	}

	public function testExtension()
	{
		$file = File::open('foo', false, $this->VFileSystem);

		$this->assertTrue($file->extension());
	}

	public function testGet()
	{
		$file = File::open('foo', false, $this->VFileSystem);

		$this->assertTrue($file->get());
	}

	public function testSize()
	{
		$file = File::open('foo', false, $this->VFileSystem);

		$this->assertTrue($file->size());
	}

	public function testPut()
	{
		$file = File::open('foo', false, $this->VFileSystem);

		$this->assertTrue($file->put(null));
	}

	public function testAppend()
	{
		$file = File::open('foo', false, $this->VFileSystem);

		$this->assertTrue($file->append(null));
	}

	public function testDelete()
	{
		$file = File::open('foo', false, $this->VFileSystem);

		$this->assertTrue($file->delete());
	}

	public function testMove()
	{
		$file = File::open('foo', false, $this->VFileSystem);

		$this->assertTrue($file->move(null));
	}

	public function testCopy()
	{
		$file = File::open('foo', false, $this->VFileSystem);

		$this->assertTrue($file->copy(null));
	}

	public function testSymlink()
	{
		$file = File::open('foo', false, $this->VFileSystem);

		$this->assertTrue($file->symlink(null));
	}

	public function testIsWritable()
	{
		$file = File::open('foo', false, $this->VFileSystem);

		$this->assertTrue($file->isWritable());
	}

	public function testIsReadable()
	{
		$file = File::open('foo', false, $this->VFileSystem);

		$this->assertTrue($file->isReadable());
	}

	public function testIsDirectoy()
	{
		$file = File::open('foo', false, $this->VFileSystem);

		$this->assertTrue($file->isDirectory());
	}

	public function testIsFile()
	{
		$file = File::open('foo', false, $this->VFileSystem);

		$this->assertTrue($file->isFile());
	}

	public function testType()
	{
		$file = File::open('foo', false, $this->VFileSystem);

		$this->assertTrue($file->type());
	}

	public function testAccessTime()
	{
		$file = File::open('foo', false, $this->VFileSystem);

		$this->assertTrue($file->accessTime());
	}

	public function testModifiedTime()
	{
		$file = File::open('foo', false, $this->VFileSystem);

		$this->assertTrue($file->modifiedTime());
	}

	public function testCreationTime()
	{
		$file = File::open('foo', false, $this->VFileSystem);

		$this->assertTrue($file->creationTime());
	}

	public function testChmod()
	{
		$file = File::open('foo', false, $this->VFileSystem);

		$this->assertTrue($file->chmod(null));
	}

	public function testChown()
	{
		$file = File::open('foo', false, $this->VFileSystem);

		$this->assertTrue($file->chown(null));
	}

	public function testSetPermissions()
	{
		$file = File::open('foo', false, $this->VFileSystem);

		$this->assertTrue($file->setPermissions(null));
	}

	public function testGetPermissions()
	{
		$file = File::open('foo', false, $this->VFileSystem);

		$this->assertTrue($file->getPermissions());
	}

}
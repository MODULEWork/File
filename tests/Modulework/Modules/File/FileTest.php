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
/**
* PHPUnit Test
*/
class FileTest extends PHPUnit_Framework_TestCase
{

	public function testOpen()
	{
		$file = File::open('foo');


	}

}
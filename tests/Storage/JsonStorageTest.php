<?php

namespace Gandung\Berat\Tests;

use Gandung\Berat\Storage\JsonStorage;
use PHPUnit\Framework\TestCase;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
class JsonStorageTest extends TestCase
{
	public function testCanImportDataFromArray()
	{
		$storage = new JsonStorage();
		$storage->fromArray(['foo' => 1, 'bar' => 2]);
		$this->assertTrue(true);
	}

	public function testCanGetData()
	{
		$storage = new JsonStorage();
		$storage->set('foo', 10);
		$storage->set('bar', 20);
		$storage->set('baz', 30);
		$this->assertEquals(10, $storage->get('foo'));
		$this->assertEquals(20, $storage->get('bar'));
		$this->assertEquals(30, $storage->get('baz'));
		$this->assertNull($storage->get('nonexistent-key'));
	}

	/**
	 * @expectedException RuntimeException
	 */
	public function testTryToOverwriteDataWhenOverwriteFlagIsFalse()
	{
		$storage = new JsonStorage();
		$storage->set('foo', 1);
		$storage->set('foo', 20);
	}

	public function testCanSetFromConstructor()
	{
		$storage = new JsonStorage('{"foo": 10, "bar": 20}');
		$this->assertTrue(true);
	}
}

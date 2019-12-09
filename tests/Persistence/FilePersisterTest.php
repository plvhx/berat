<?php

namespace Gandung\Berat\Tests;

use Gandung\Berat\Persistence\FilePersister;
use Gandung\Berat\Storage\JsonStorage;
use PHPUnit\Framework\TestCase;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
class FilePersisterTest extends TestCase
{
	public function testCanGetInstance()
	{
		$persister = new FilePersister(new JsonStorage);
		$this->assertInstanceOf(FilePersister::class, $persister);
	}

	public function testCanGetStorageObject()
	{
		$persister = new FilePersister(new JsonStorage);
		$storage = $persister->getStorage();
		$this->assertInstanceOf(JsonStorage::class, $storage);
	}

	public function testCanSetAndGetFile()
	{
		$persister = new FilePersister(new JsonStorage);
		$persister->setFile(
			__DIR__ . DIRECTORY_SEPARATOR . '../storage-fixtures/data.json'
		);
		$this->assertEquals(
			__DIR__ . DIRECTORY_SEPARATOR . '../storage-fixtures/data.json',
			$persister->getFile()
		);
	}

	public function testCanPersistStorage()
	{
		$storage = new JsonStorage();
		$storage->set('foo', 10);
		$storage->set('bar', 20);
		$storage->set('baz', 30);
		$storage->save();

		$persister = new FilePersister($storage);
		$persister->setFile(
			__DIR__ . DIRECTORY_SEPARATOR . '../storage-fixtures/data.json'
		);

		$persister->persist();
		$this->assertTrue(true);
	}

	public function testCanGetContentsFromPersister()
	{
		$persister = new FilePersister();
		$persister->setFile(
			__DIR__ . DIRECTORY_SEPARATOR . '../storage-fixtures/data.json'
		);
		$contents = $persister->getContents();
		$this->assertNotEmpty($contents);
	}
}

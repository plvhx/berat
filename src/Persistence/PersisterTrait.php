<?php

declare(strict_types=1);

namespace Gandung\Berat\Persistence;

use Gandung\Berat\StorageInterface;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
trait PersisterTrait
{
	/**
	 * @var StorageInterface
	 */
	private $storage;

	public function __construct(StorageInterface $storage = null)
	{
		$this->setStorage($storage);
	}

	/**
	 * Set storage object.
	 *
	 * @param StorageInterface $storage Storage object.
	 * @return PersistenceInterface
	 */
	public function setStorage(StorageInterface $storage = null)
	{
		$this->storage = $storage;
		return $this;
	}

	/**
	 * Get associated storage object.
	 *
	 * @return StorageInterface
	 */
	public function getStorage()
	{
		return $this->storage;
	}
}

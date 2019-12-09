<?php

declare(strict_types=1);

namespace Gandung\Berat\Storage;

use RuntimeException;
use Gandung\Berat\StorageInterface;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
class JsonStorage implements StorageInterface
{
	/**
	 * @var mixed[]
	 */
	private $data = [];

	/**
	 * @var mixed[][]
	 */
	private $container;

	public function __construct(string $data = '')
	{
		$this->setFromSerializedData($data);
	}

	/**
	 * Set data array.
	 *
	 * @param array $data Data array.
	 * @return void
	 */
	public function fromArray(array $data)
	{
		$this->container = $data;
	}

	/**
	 * Check if storage has data with given index.
	 *
	 * @param string $key Storage index.
	 * @return bool
	 */
	public function has(string $key)
	{
		return isset($this->data[$key]);
	}

	/**
	 * Get storage data with given index.
	 *
	 * @param string $key Storage index.
	 * @return null|mixed
	 */
	public function get(string $key)
	{
		return !$this->has($key)
			? null
			: $this->data[$key];
	}

	/**
	 * Set storage data with given index.
	 *
	 * @param string $key Storage index.
	 * @param mixed $value Storage value.
	 * @param boolean $overwrite Want overwrite existing value?
	 * @return void
	 */
	public function set(string $key, $value, bool $overwrite = false)
	{
		if ($this->has($key) && !$overwrite) {
			throw new RuntimeException(
				"Key %s exists, but overwrite parameter has been set to false."
			);
		}

		$this->data[$key] = $value;
	}

	/**
	 * {@inheritdoc}
	 */
	public function save()
	{
		$this->data['index'] = count($this->container);
		$this->container[] = $this->data;
	}

	/**
	 * Set data from serialized JSON string.
	 *
	 * @param string $data Serialized JSON data.
	 * @return void
	 */
	private function setFromSerializedData(string $data = '')
	{
		$this->container = empty($data)
			? []
			: json_decode($data, true);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getContent()
	{
		return json_encode($this->container);
	}
}

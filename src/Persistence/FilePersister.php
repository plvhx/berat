<?php

declare(strict_types=1);

namespace Gandung\Berat\Persistence;

use Gandung\Berat\PersistenceInterface;

use function file_get_contents;
use function file_put_contents;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
class FilePersister implements PersistenceInterface
{
	use PersisterTrait;

	/**
	 * @var string
	 */
	private $file;

	/**
	 * {@inheritdoc}
	 */
	public function persist()
	{
		file_put_contents(
			$this->getFile(),
			$this->storage->getContent()
		);
	}

	/**
	 * Set file name where current storage object will
	 * saved to.
	 *
	 * @param string $file File name.
	 * @return void
	 */
	public function setFile(string $file)
	{
		$this->file = $file;
	}

	/**
	 * Get associated file name.
	 *
	 * @return string
	 */
	public function getFile()
	{
		return $this->file;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getContents()
	{
		return file_get_contents($this->getFile());
	}
}

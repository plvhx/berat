<?php

namespace Gandung\Berat;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
interface PersistenceInterface
{
	/**
	 * Persist current storage object on disk.
	 *
	 * @return void
	 */
	public function persist();

	/**
	 * Get contents from associated file name.
	 *
	 * @return string
	 */
	public function getContents();
}

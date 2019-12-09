<?php

declare(strict_types=1);

namespace Gandung\Berat;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
interface StorageInterface
{
	/**
	 * Get serialized JSON data.
	 *
	 * @return string
	 */
	public function getContent();

	/**
	 * Save current modified data array.
	 *
	 * @return void
	 */
	public function save();
}

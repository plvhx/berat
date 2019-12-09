<?php

declare(strict_types=1);

namespace App;

use Gandung\Berat\AbstractKernel;

use function realpath;
use function sprintf;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
class Kernel extends AbstractKernel
{
	/**
	 * {@inheritdoc}
	 */
	protected function getRootDirectory()
	{
		$rootDir = realpath(__DIR__ . '/..');
		return $rootDir;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function configureRoutes()
	{
		$routesData = sprintf(
			"%s/config/routes.php",
			$this->getRootDirectory()
		);

		$callback = require $routesData;
		$callback($this->container);
	}
}

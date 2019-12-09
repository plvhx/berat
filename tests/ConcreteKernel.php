<?php

namespace Gandung\Berat\Tests;

use Gandung\Berat\AbstractKernel;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
class ConcreteKernel extends AbstractKernel
{
	/**
	 * {@inheritdoc}
	 */
	protected function getRootDirectory()
	{
		return __DIR__ . DIRECTORY_SEPARATOR . '../';
	}

	/**
	 * {@inheritdoc}
	 */
	protected function configureRoutes()
	{
		return;
	}
}

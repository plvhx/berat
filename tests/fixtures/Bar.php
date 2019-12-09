<?php

namespace Gandung\Berat\Tests\Fixtures;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
class Bar
{
	/**
	 * @var FooInterface
	 */
	private $foo;

	public function __construct(FooInterface $foo)
	{
		$this->foo = $foo;
	}
}

<?php

namespace Gandung\Berat\Tests;

use DI\Container;
use PHPUnit\Framework\TestCase;
use Zend\Diactoros\RequestFactory;
/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
class ConcreteKernelTest extends TestCase
{
	public function testCanGetInstance()
	{
		$kernel = new ConcreteKernel();
		$this->assertInstanceOf(ConcreteKernel::class, $kernel);
	}

	public function testCanGetAssociatedContainer()
	{
		$kernel = new ConcreteKernel();
		$this->assertInstanceOf(
			Container::class,
			$kernel->getContainer()			
		);
	}

	public function testCanHandleRequest()
	{
		$factory = new RequestFactory();
		$kernel = new ConcreteKernel();
		$kernel->handle($factory->createRequest('GET', '/foobar'));
		$this->assertEquals('GET', $kernel->getRequest()->getMethod());
	}
}

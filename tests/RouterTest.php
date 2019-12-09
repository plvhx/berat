<?php

namespace Gandung\Berat\Tests;

use Gandung\Berat\Router;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Zend\Diactoros\RequestFactory;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
class RouterTest extends TestCase
{
	public function testCanGetInstance()
	{
		$router = new Router();
		$this->assertInstanceOf(Router::class, $router);
	}

	public function testCanSetGetRoute()
	{
		$router = new Router();
		$router->get('/foo', function() {
			return null;
		});
		$this->assertTrue(true);
	}

	public function testCanSetPostRoute()
	{
		$router = new Router();
		$router->post('/foo', function() {
			return null;
		});
		$this->assertTrue(true);
	}

	public function testCanSetPutRoute()
	{
		$router = new Router();
		$router->put('/foo', function() {
			return null;
		});
		$this->assertTrue(true);
	}

	public function testCanSetPatchRoute()
	{
		$router = new Router();
		$router->patch('/foo', function() {
			return null;
		});
		$this->assertTrue(true);
	}

	public function testCanSetDeleteRoute()
	{
		$router = new Router();
		$router->delete('/foo', function() {
			return null;
		});
		$this->assertTrue(true);
	}

	public function testCanSuccessfullyDispatchRoute()
	{
		$factory = new RequestFactory();
		$router = new Router();

		$router->get('/foo', function(RequestInterface $request) {
			return true;
		});

		$router->dispatch($factory->createRequest('GET', '/foo'));
		$this->assertTrue(true);
	}

	public function testCanUnsuccessfullyDispatchRoute()
	{
		$factory = new RequestFactory();
		$router = new Router();

		$router->get('/foo', function(RequestInterface $request) {
			return true;
		});

		$router->dispatch($factory->createRequest('GET', '/foobarbaz'));
		$this->assertTrue(true);
	}

	/**
	 * @expectedException RuntimeException
	 */
	public function testTryToGetNonexistentCallbackID()
	{
		$router = new Router();
		$router->getCallback('foobar');
	}

	public function testCanGetAllCallbacks()
	{
		$router = new Router();
		$router->getCallbacks();
		$this->assertEmpty($router->getCallbacks());
	}
}

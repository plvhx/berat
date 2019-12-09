<?php

namespace Gandung\Berat;

use RuntimeException;
use FastRoute\RouteParser;
use FastRoute\DataGenerator;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use FastRoute\RouteParser\Std;
use FastRoute\DataGenerator\GroupCountBased as GCBDataGenerator;
use FastRoute\Dispatcher\GroupCountBased as GCBDispatcher;
use Psr\Http\Message\RequestInterface;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
class Router implements RouterInterface
{
	use RouterTrait;

	/**
	 * @var RouteCollector
	 */
	private $routeCollector;

	/**
	 * @var Closure[]
	 */
	private $callbacks = [];

	public function __construct(
		RouteParser $parser = null,
		DataGenerator $dataGenerator = null,
		RouteCollector $routeCollector = null
	) {
		$this->routeCollector = $routeCollector ?? new RouteCollector(
			$parser ?? new Std(),
			$dataGenerator ?? new GCBDataGenerator()
		);
	}

	public function get(string $route, $handler)
	{
		$this->routeCollector->addRoute(
			'GET',
			$route,
			$this->getHandlerId($handler)
		);
	}

	public function post(string $route, $handler)
	{
		$this->routeCollector->addRoute(
			'POST',
			$route,
			$this->getHandlerId($handler)
		);
	}

	public function put(string $route, $handler)
	{
		$this->routeCollector->addRoute(
			'PUT',
			$route,
			$this->getHandlerId($handler)
		);
	}

	public function patch(string $route, $handler)
	{
		$this->routeCollector->addRoute(
			'PATCH',
			$route,
			$this->getHandlerId($handler)
		);
	}

	public function delete(string $route, $handler)
	{
		$this->routeCollector->addRoute(
			'DELETE',
			$route,
			$this->getHandlerId($handler)
		);
	}

	public function dispatch(RequestInterface $request)
	{
		$dispatcher = new GCBDispatcher($this->routeCollector->getData());
		$ret = $dispatcher->dispatch(
			$request->getMethod(),
			$request->getUri()->getPath()
		);

		if ($ret[0] === GCBDispatcher::NOT_FOUND ||
			$ret[0] === GCBDispatcher::METHOD_NOT_ALLOWED) {
			return [
				'status' => $ret[0]
			];
		}

		return [
			'status' => $ret[0],
			'response' => $this->resolveCallback($request, $ret[1], $ret[2])
		];
	}

	public function addCallback(\Closure $callback)
	{
		$key = sprintf(
			"handler%d",
			!count($this->callbacks) ? 0 : count($this->callbacks)
		);

		$this->callbacks[$key] = $callback;
	}

	public function hasCallback(string $id)
	{
		return array_key_exists($id, $this->callbacks);
	}

	public function getCallback(string $id)
	{
		if (!$this->hasCallback($id)) {
			throw new RuntimeException(
				sprintf(
					"Callback with id '%s' not exist.",
					$id
				)
			);
		}

		return $this->callbacks[$id];
	}

	public function getCallbacks()
	{
		return $this->callbacks;
	}
}

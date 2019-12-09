<?php

declare(strict_types=1);

namespace Gandung\Berat;

use InvalidArgumentException;
use RuntimeException;
use ReflectionFunction;
use Psr\Http\Message\RequestInterface;

use function count;
use function is_callable;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
trait RouterTrait
{
	public function resolveCallback(RequestInterface $request, $callback, array $parameters)
	{
		if (!is_callable($callback) && !$this->hasCallback($callback)) {
			throw new InvalidArgumentException(
				sprintf(
					"Callback with id '%s' not exist.",
					$callback
				)
			);
		}

		$callback = is_callable($callback)
			? $callback
			: $this->getCallback($callback);

		$refCallback = new ReflectionFunction($callback);
		$res = $refCallback->getParameters();

		if (count($res) - 1 !== count($parameters)) {
			throw new RuntimeException(
				sprintf(
					"Number of route parameters is different than callback parameters (" .
					"route params: %d, callback params: %d)",
					count($parameters),
					count($res)
				)
			);
		}

		$routeParams = array_keys($parameters);

		foreach (array_slice($res, 1) as $key => $value) {
			if ($value->getName() === $routeParams[$key]) {
				continue;
			}

			throw new RuntimeException(
				sprintf(
					"Route parameters in position (%d) must be (%s), but in " .
					"callback got (%s)",
					$key,
					$routeParams[$key],
					$value->getName()
				)
			);
		}

		$args = array_merge(
			[$request],
			array_values($parameters)
		);

		return call_user_func_array($callback, $args);
	}

	private function getHandlerId($handler)
	{
		if ($handler instanceof \Closure) {
			$this->addCallback($handler);
			$handler = array_keys($this->callbacks)[count($this->callbacks) - 1];
		}

		return $handler;
	}
}

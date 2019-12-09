<?php

namespace Gandung\Berat;

use Psr\Http\Message\RequestInterface;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
interface RouterInterface
{
	public function get(string $route, $handler);

	public function post(string $route, $handler);

	public function put(string $route, $handler);

	public function patch(string $route, $handler);

	public function delete(string $route, $handler);

	public function dispatch(RequestInterface $request);
}

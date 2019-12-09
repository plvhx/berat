<?php

declare(strict_types=1);

namespace Gandung\Berat;

use DI\ContainerBuilder;
use Psr\Http\Message\RequestInterface;

/**
 * @author Paulus Gandung Prakosa <rvn.plvhx@gmail.com>
 */
abstract class AbstractKernel
{
	/**
	 * @var ContainerBuilder
	 */
	protected $container;

	/**
	 * @var RequestInterface
	 */
	protected $request;

	public function __construct()
	{
		$this->buildContainer();
		$this->configureRoutes();
	}

	private function buildContainer()
	{
		$builder = new ContainerBuilder();
		$builder->enableCompilation(
			$this->getRootDirectory() . DIRECTORY_SEPARATOR . 'var/cache/container'
		);
		$builder->writeProxiesToFile(
			true,
			$this->getRootDirectory() . DIRECTORY_SEPARATOR . 'var/cache/container/proxies'
		);
		$builder->addDefinitions(
			$this->getRootDirectory() . DIRECTORY_SEPARATOR . 'config/container.php'
		);
		$this->container = $builder->build();
	}

	public function getContainer()
	{
		return $this->container;
	}

	public function handle(RequestInterface $request)
	{
		$this->request = $request;
	}

	public function send()
	{
		$router = $this->container->get('core.router');
		$emitter = $this->container->get('core.emitter');

		$res = $router->dispatch($this->getRequest());

		if ($res['status'] !== 1) {
			return;
		}

		$emitter->emit($res['response']);
	}

	public function getRequest()
	{
		return $this->request;
	}

	/**
	 *
	 */
	abstract protected function getRootDirectory();

	/**
	 *
	 */
	abstract protected function configureRoutes();
}

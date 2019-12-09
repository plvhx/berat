<?php

use Gandung\Berat\Storage\JsonStorage;
use Psr\Http\Message\RequestInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\Response\RedirectResponse;

return function($container) {
	$container->get('core.router')->get('/',
		function(RequestInterface $request) use ($container) {
			$contents = $container->get('core.persistence')
				->getContents();
			$response = (new Response())
				->withHeader('Content-Type', 'text/html');
			$response->getBody()->write(
				$container->get('core.twig')->render(
					'index.html.twig',
					['data_list' => empty($contents) ? [] : json_decode($contents, true)]
				)
			);

			return $response;
		});

	$container->get('core.router')->get('/create',
		function(RequestInterface $request) use ($container) {
			$response = (new Response())
				->withHeader('Content-Type', 'text/html');
			$response->getBody()->write(
				$container->get('core.twig')->render(
					'create.html.twig',
					['default_date' => date('Y-m-d')]
				)
			);

			return $response;
		});

	$container->get('core.router')->post('/create',
		function(RequestInterface $request) use ($container) {
			$body = $request->getParsedBody();
			$storage = new JsonStorage(
				$container->get('core.persistence')->getContents()
			);

			$storage->set('tanggal', $body['tanggal']);
			$storage->set('berat-min', intval($body['berat-min']));
			$storage->set('berat-max', intval($body['berat-max']));
			$storage->save();

			$container->get('core.persistence')
				->setStorage($storage)
				->persist();

			return new RedirectResponse('/');
		});

	$container->get('core.router')->get('/show/{id: \d+}',
		function(RequestInterface $request, $id) use ($container) {
			$parsed = json_decode(
				$container->get('core.persistence')->getContents(),
				true
			);

			$response = (new Response())
				->withHeader('Content-Type', 'text/html');

			$response->getBody()->write(
				$container->get('core.twig')->render(
					'show.html.twig',
					['data_list' => $parsed[intval($id)]]
				)
			);

			return $response;
		});

	$container->get('core.router')->get('/update/{id: \d+}',
		function(RequestInterface $request, $id) use ($container) {
			$parsed = json_decode(
				$container->get('core.persistence')->getContents(),
				true
			);

			$response = (new Response())
				->withHeader('Content-Type', 'text/html');

			$response->getBody()->write(
				$container->get('core.twig')->render(
					'update.html.twig',
					['data_list' => $parsed[intval($id)]]
				)
			);

			return $response;
		});

	$container->get('core.router')->post('/update/{id: \d+}',
		function(RequestInterface $request, $id) use ($container) {
			$body = $request->getParsedBody();
			$parsed = json_decode(
				$container->get('core.persistence')->getContents(),
				true
			);

			$parsed[intval($id)]['tanggal'] = $body['tanggal'];
			$parsed[intval($id)]['berat-min'] = intval($body['berat-min']);
			$parsed[intval($id)]['berat-max'] = intval($body['berat-max']);

			$storage = new JsonStorage();
			$storage->fromArray($parsed);

			$container->get('core.persistence')
				->setStorage($storage)
				->persist();

			return new RedirectResponse('/');
		});
};

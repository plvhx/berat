<?php

use Gandung\Berat\Router;
use Gandung\Berat\Persistence\FilePersister;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

return [
	'core.router' => new Router(),
	'core.emitter' => new SapiEmitter(),
	'core.twig' => function() {
		$loader = new FilesystemLoader(
			__DIR__ . DIRECTORY_SEPARATOR . '../resources/views'
		);

		return new Environment(
			$loader,
			[
				'cache' => __DIR__ . DIRECTORY_SEPARATOR . '../var/twig/compiled',
				'auto_reload' => true
			]
		);
	},
	'core.persistence' => function() {
		$persister = new FilePersister();
		$persister->setFile(
			__DIR__ . DIRECTORY_SEPARATOR . '../var/storage/data.json'
		);

		return $persister;
	}
];

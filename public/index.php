<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . '../vendor/autoload.php';

$app = new App\Kernel();
$app->handle(Zend\Diactoros\ServerRequestFactory::fromGlobals());
$app->send();

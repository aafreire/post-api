<?php

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use just\Application;
use just\Plugins\RoutePlugin;
use just\ServiceContainer;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use just\Models\Post;

require __DIR__ .'/../vendor/autoload.php';

$config = include __DIR__ . '/../config/db.php';
$paths = array(__DIR__.'/../src/Models');
$isDevMode = false;

// the connection configuration
$dbParams = [
    'driver'   => $config['development']['doctrine_driver'],
    'user'     => $config['development']['username'],
    'password' => $config['development']['password'],
    'dbname'   => $config['development']['database']
];

$doctrine_config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $doctrine_config);

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);

$app->plugin(new RoutePlugin());

require_once __DIR__ . '/../src/controllers/Post.php';

$app->start();
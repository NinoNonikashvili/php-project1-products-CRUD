<?php

require_once __DIR__.'/../vendor/autoload.php';
use app\Router;
use app\controllers\ProductController;
use app\DB;

$database = new Db();
$router = new Router($database);

$router->get('/', [ProductController::class, 'index'] ); //::class returns the name of class with namespace
$router->post('/', [ProductController::class, 'index'] );
$router->get('/index', [ProductController::class, 'index'] );
$router->get('/create', [ProductController::class, 'create'] );
$router->post('/create', [ProductController::class, 'create'] );
$router->get('/update', [ProductController::class, 'update'] );
$router->post('/update', [ProductController::class, 'update'] );
$router->post('/delete', [ProductController::class, 'delete'] );
// print_r($router->getRoutes);
// print_r($router->postRoutes);



$router->resolve();
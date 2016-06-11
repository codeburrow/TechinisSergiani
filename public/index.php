<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/setup.php';

use Kourtis\Controllers;
use Kourtis\Router;

$router = new Router\Router();

$router->get('/', 'HelloController', 'hello');
$router->get('/contact', 'HelloController', 'contact');
$router->get('/single_post', 'HelloController', 'single_post');
//$router->post('/contact', 'ContactController', 'postContactDetails');

////See inside $router
//echo "<pre>";
//print_r($router);

$router->submit();


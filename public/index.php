<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/setup.php';

use Kourtis\Controllers;
use Kourtis\Router;

$router = new Router\Router();

$router->get('/', 'MainController', 'index');
$router->get('/contact', 'MainController', 'contact');
$router->get('/cinema', 'CinemaController', 'showAllPosts');
$router->get('/cinema/[\w\d]+', 'CinemaController', 'single_post');
$router->get('/music', 'MusicController', 'showAllPosts');
$router->get('/music/[\w\d]+', 'MusicController', 'single_post');
$router->get('/photos', 'PhotosController', 'showAllPosts');
$router->get('/photos/[\w\d]+', 'PhotosController', 'single_post');
$router->get('/podcasts', 'PodcastsController', 'showAllPosts');
$router->get('/podcasts/[\w\d]+', 'PodcastsController', 'single_post');
$router->get('/single_post', 'PodcastsController', 'single_post');

$router->post('/contact', 'MainController', 'postContactDetails');

////See inside $router
//echo "<pre>";
//print_r($router);

$router->submit();


<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/setup.php';

use Kourtis\Controllers;
use Kourtis\Router;

$router = new Router\Router();

//Public
$router->get('/', 'MainController', 'index');
$router->get('/contact', 'MainController', 'contact');
$router->get('/theatre', 'TheatreController', 'showAllPosts');
$router->get('/theatre/[-\w\d\?\!\.]+', 'TheatreController', 'single_post');
$router->get('/cinema', 'CinemaController', 'showAllPosts');
$router->get('/cinema/[-\w\d\?\!\.]+', 'CinemaController', 'single_post');
$router->get('/music', 'MusicController', 'showAllPosts');
$router->get('/music/[-\w\d\!\.]+', 'MusicController', 'single_post');
$router->get('/photos', 'PhotosController', 'showAllPosts');
$router->get('/photos/[-\w\d\!\.]+', 'PhotosController', 'single_post');
$router->get('/podcasts', 'PodcastsController', 'showAllPosts');
$router->get('/podcasts/[-\w\d\!\.]+', 'PodcastsController', 'single_post');
//Admin
$router->get('/admin/dashboard', 'AdminController', 'index');
$router->get('/admin/dashboard/addTheatrePost', 'AdminController', 'addTheatrePost');
$router->get('/admin/dashboard/addCinemaPost', 'AdminController', 'addCinemaPost');
$router->get('/admin/dashboard/addMusicPost', 'AdminController', 'addMusicPost');
$router->get('/admin/dashboard/addPhotoPost', 'AdminController', 'addPhotoPost');
$router->get('/admin/dashboard/addPodcastPost', 'AdminController', 'addPodcastPost');
$router->get('/admin/dashboard/deleteItem', 'AdminController', 'deleteItem');
$router->get('/admin/dashboard/editItem', 'AdminController', 'editItem');
$router->get('/admin/dashboard/contactSupport', 'AdminController', 'contactSupport');
$router->get('/admin/login', 'AdminController', 'login');
$router->get('/admin/logout', 'AdminController', 'logout');

//$router->get('/test/[-\w\d\!\.]+', 'CinemaController', 'test');
//$router->get('/test', 'MainController', 'test');

//Public
$router->post('/contact', 'MainController', 'postContactDetails');
//Admin
$router->post('/admin/addItem', 'AdminController', 'postAddItem');
$router->post('/admin/deleteItem', 'AdminController', 'postDeleteItem');
$router->post('/admin/editItem', 'AdminController', 'postEditItem');
$router->post('/admin/login', 'AdminController', 'postLogin');
$router->post('/admin/contact', 'AdminController', 'postContact');


////See inside $router
//echo "<pre>";
//print_r($router);

$router->submit();


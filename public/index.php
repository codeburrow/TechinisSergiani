<?php
/**
 * Created by PhpStorm.
 * User: antony
 * Date: 5/29/16
 * Time: 5:49 PM
 */
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/setup.php';

use Kourtis\Controllers\HelloController;

$app = new \Slim\App;
$app->get('/hello', 'Kourtis\Controllers\HelloController:hello');
$app->run();


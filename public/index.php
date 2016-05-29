<?php
/**
 * Created by PhpStorm.
 * User: antony
 * Date: 5/29/16
 * Time: 5:49 PM
 */
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/setup.php';

use Pux\Mux;
use Pux\Executor;
use Kourtis\Controllers\HelloController;

$mux = new Mux;
$mux->get('/', ['Kourtis\Controllers\HelloController','index']);
//$mux->post('/post', ['HelloController','helloAction']);
//$mux->put('/put', ['HelloController','helloAction']);

$route = $mux->dispatch( $_SERVER['REQUEST_URI'] );
echo Executor::execute($route);
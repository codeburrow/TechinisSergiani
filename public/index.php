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
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});
$app->run();


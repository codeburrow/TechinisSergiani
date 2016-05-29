<?php
namespace Kourtis\Controllers;
use Interop\Container\ContainerInterface;

/**
 * Created by PhpStorm.
 * User: antony
 * Date: 5/29/16
 * Time: 6:08 PM
 */

class HelloController extends Controller
{

    public function __construct(ContainerInterface $ci) {
        parent::__construct($ci);
    }

    public function hello($request, $response, $args)
    {
        echo $this->twig->render('index.twig', array('name' => 'Antony'));
    }
}
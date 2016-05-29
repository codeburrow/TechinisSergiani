<?php
namespace Kourtis\Controllers;
use Twig_Environment;
use Twig_Loader_Filesystem;

/**
 * Created by PhpStorm.
 * User: antony
 * Date: 5/29/16
 * Time: 6:08 PM
 */

class Controller
{
    public $twig;

    public function __construct()
    {
        $loader = new Twig_Loader_Filesystem(__DIR__ . '/../Views');
        $this->twig = new Twig_Environment($loader, array(
//            'cache' => '/path/to/compilation_cache',
        ));

    }

}
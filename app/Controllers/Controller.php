<?php
namespace Kourtis\Controllers;
use Interop\Container\ContainerInterface;
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
    protected $ci;

    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;

        $loader = new Twig_Loader_Filesystem(__DIR__ . '/../Views');
        $this->twig = new Twig_Environment($loader, array(
//            'cache' => '/path/to/compilation_cache',
        ));

    }
}
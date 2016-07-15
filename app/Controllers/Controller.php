<?php
namespace Kourtis\Controllers;

use Twig_Environment;
use Twig_Loader_Filesystem;

class Controller
{
    protected $twig;
    protected $post;

    public function __construct($post=null)
    {
        $loader = new Twig_Loader_Filesystem(__DIR__ . '/../Views/');
        $this->twig = new Twig_Environment($loader);

        $this->post = $post;
    }
}
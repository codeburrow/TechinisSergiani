<?php
namespace Kourtis\Controllers;

class HelloController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function hello()
    {
        echo $this->twig->render('index.twig', array('name' => 'Antony'));
    }

    public function contact()
    {
        echo $this->twig->render('contact.twig');
    }
    
}
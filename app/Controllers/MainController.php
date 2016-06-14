<?php
namespace Kourtis\Controllers;

use Kourtis\Repositories\StaticBlogRepo;

class MainController extends Controller
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

    public function postContactDetails()
    {
        var_dump($_POST);
    }

    public function test()
    {
        $repo = new StaticBlogRepo();

        $result = $repo->getAllPosts();

        var_dump($result);
    }
    
}
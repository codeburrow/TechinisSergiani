<?php
namespace Kourtis\Controllers;

use Kourtis\Database\DB;

class MainController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $DB = new DB();
        $latestPosts = $DB->getNewestPosts(6);
        $carouselPosts = $DB->getCarouselPosts();

        echo $this->twig->render('index.twig', array('latestPosts' => $latestPosts, 'carouselPosts' => $carouselPosts));
    }

    public function contact()
    {
        echo $this->twig->render('contact.twig');
    }

    public function postContactDetails()
    {
        var_dump($_POST);
    }
    
}
<?php
namespace Kourtis\Controllers;

use Kourtis\Database\CarouselDB;
use Kourtis\Database\DB;
use Kourtis\Database\TheatreDB;

class MainController extends Controller
{

    public function __construct($data = null)
    {
        parent::__construct($data);
    }

    public function index()
    {
        $carouselDB = new CarouselDB();
        $theatreDB = new TheatreDB();

        //ToDo: Implement the carousel methods below
        $latestPosts = $theatreDB->getNewestPosts(6);
        $carouselPosts = $carouselDB->getCarouselImages();

        echo $this->twig->render('index.twig', array('latestPosts' => $latestPosts, 'carouselPosts' => $carouselPosts));
    }

    public function contact()
    {
        echo $this->twig->render('contact.twig');
    }

    public function error404()
    {
        echo 'error 404 given from Router';
    }

}
<?php
namespace Kourtis\Controllers;

use Kourtis\Database\DB;

class MainController extends Controller
{

    public function __construct($data = null)
    {
        parent::__construct($data);
    }

    public function index()
    {
        $DB = new DB();

        //ToDo: Implement the carousel methods below
//        $latestPosts = $DB->getNewestPosts(6);
//        $carouselPosts = $DB->getCarouselPosts();

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

    public function test()
    {
        # a php uri pattern match (for a php get request)
# look for anything other than these allowable characters
# A-Z, a-z, 0-9, _, ., -, +, ?, /, =
        $pattern = "/[^A-Za-z0-9_\.\-\+\?\!\/=]/";
        $string  = "kourtis.app/is-art?!";

        if (preg_match($pattern, $string))
        {
            echo "string had bad characters in it";
        }
        else
        {
            echo "no bad characters";
        }

    }

}
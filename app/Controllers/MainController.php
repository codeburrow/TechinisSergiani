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
        $myDB = new DB();

        $myDB->connect();
    }
    
}
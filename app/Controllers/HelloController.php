<?php
namespace Kourtis\Controllers;

/**
 * Created by PhpStorm.
 * User: antony
 * Date: 5/29/16
 * Time: 6:08 PM
 */

class HelloController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        echo $this->twig->render('index.htm', array('name' => 'Antony'));
    }
}
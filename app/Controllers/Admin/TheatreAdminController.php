<?php
namespace Kourtis\Controllers\Admin;

use Kourtis\Database\TheatreDB;

class TheatreAdminController extends AdminController
{
    public function __construct($data=null)
    {
        parent::__construct($data);
    }

    public function addPost(){
        if ($this->adminIsLoggedIn())
            echo $this->twig->render('theatre/addTheatrePost.twig');
        else
            echo $this->twig->render('login.twig');
    }

    public function postAddPost(){
       //ToDo
    }

    public function editPost(){
        if ($this->adminIsLoggedIn()){

            $theatreDB = new TheatreDB();
            $posts = $theatreDB->getAllPosts();

            echo $this->twig->render('theatre/editTheatrePost.twig', array('posts'=>$posts));
        }
        else {
            echo $this->twig->render('login.twig');
        }
    }

    public function postEditItem(){
        //ToDo
    }
    
    public function deletePost(){
        if ($this->adminIsLoggedIn()){

            $theatreDB = new TheatreDB();
            $posts = $theatreDB->getAllPosts();

            echo $this->twig->render('theatre/deleteTheatrePost.twig', array('posts'=>$posts));
        }
        else {
            echo $this->twig->render('login.twig');
        }
    }

    public function postDeleteItem(){
       //ToDo
    }

}
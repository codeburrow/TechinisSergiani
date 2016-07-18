<?php
namespace Kourtis\Controllers\Admin;

use Kourtis\Database\CinemaDB;

class CinemaAdminController extends AdminController
{
    public function __construct($data = null)
    {
        parent::__construct($data);
    }

    public function addPost()
    {
        if ($this->adminIsLoggedIn())
            echo $this->twig->render('cinema/addCinemaPost.twig');
        else
            echo $this->twig->render('login.twig');
    }

    public function postAddPost()
    {
        //ToDo
    }

    public function editPost()
    {
        if ($this->adminIsLoggedIn()) {

            $cinemaDB = new CinemaDB();
            $posts = $cinemaDB->getAllPosts();

            echo $this->twig->render('cinema/editCinemaPost.twig', array('posts' => $posts));

        } else {
            echo $this->twig->render('login.twig');
        }
    }

    public function postEditItem()
    {
        //ToDo
    }

    public function deletePost()
    {
        if ($this->adminIsLoggedIn()) {

            $cinemaDB = new CinemaDB();
            $posts = $cinemaDB->getAllPosts();

            echo $this->twig->render('cinema/deleteCinemaPost.twig', array('posts' => $posts));
        } else{
            echo $this->twig->render('login.twig');   
        }
    }

    public function postDeleteItem()
    {
        //ToDo
    }

}
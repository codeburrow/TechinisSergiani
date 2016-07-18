<?php
namespace Kourtis\Controllers\Admin;

use Kourtis\Database\MusicDB;

class MusicAdminController extends AdminController
{
    public function __construct($data=null)
    {
        parent::__construct($data);
    }

    public function addPost(){
        if ($this->adminIsLoggedIn())
            echo $this->twig->render('music/addMusicPost.twig');
        else
            echo $this->twig->render('login.twig');
    }

    public function postAddPost(){
        //ToDo
    }

    public function editPost(){
        if ($this->adminIsLoggedIn()) {

            $musicDB = new MusicDB();
            $posts = $musicDB->getAllPosts();

            echo $this->twig->render('music/editMusicPost.twig', array('posts' => $posts));
        }
        else{echo $this->twig->render('login.twig');}
    }

    public function postEditItem(){
        //ToDo
    }

    public function deletePost(){
        if ($this->adminIsLoggedIn()){

            $musicDB = new MusicDB();
            $posts = $musicDB->getAllPosts();

            echo $this->twig->render('music/deleteMusicPost.twig', array('posts'=>$posts));
        }
        else
            echo $this->twig->render('login.twig');
    }

    public function postDeleteItem(){
        //ToDo
    }

}
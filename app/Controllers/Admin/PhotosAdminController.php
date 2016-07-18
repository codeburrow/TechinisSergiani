<?php
namespace Kourtis\Controllers\Admin;

use Kourtis\Database\PhotosDB;

class PhotosAdminController extends AdminController
{
    public function __construct($data=null)
    {
        parent::__construct($data);
    }

    public function addPost(){
        if ($this->adminIsLoggedIn())
            echo $this->twig->render('photos/addPhotoPost.twig');
        else
            echo $this->twig->render('login.twig');
    }

    public function postAddPost(){
        //ToDo
    }

    public function editPost(){
        if ($this->adminIsLoggedIn()){

            $photosDB = new PhotosDB();
            $posts = $photosDB->getAllPosts();

            echo $this->twig->render('photos/editPhotoPost.twig', array('posts'=>$posts));
        }
        else
            echo $this->twig->render('login.twig');
    }

    public function postEditItem(){
        //ToDo
    }

    public function deletePost(){
        if ($this->adminIsLoggedIn()){
            $photosDB = new PhotosDB();
            $posts = $photosDB->getAllPosts();
            
            echo $this->twig->render('photos/deletePhotoPost.twig', array('posts'=>$posts));
        } else{
            echo $this->twig->render('login.twig');
        }
    }

    public function postDeleteItem(){
        //ToDo
    }

}
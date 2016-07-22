<?php
namespace Kourtis\Controllers\Admin;

use Kourtis\Database\MusicDB;
use Kourtis\Services\UploadImageService;

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

    public function postAddPost()
    {
        $DB = new MusicDB();
        $uploadImageService = new uploadImageService();
        $success = false;

        //Try to upload image
        $uploadError = $uploadImageService->uploadImage('img/music/');
        if (empty($uploadError)) {

            //Add row to db
            $nameOfImage = $_FILES['image']['name'];
            $result = $DB->addPost($_POST, $nameOfImage);

            if (empty($result)) { //successfully added row
                $flashMessage = "Post Succesfully Added";
                $success = true;
            } else { //failed to add row
                $flashMessage = $result;
                //Delete uploaded image from server
                unlink("img/music/$nameOfImage");
            }

        } else { //image failed to upload
            $flashMessage = $uploadError . "\nError: Could not upload image.";
        }

        echo $this->twig->render('music/addMusicPost.twig', array('flashMessage' => $flashMessage, 'success' => $success));
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
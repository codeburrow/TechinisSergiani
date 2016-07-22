<?php
namespace Kourtis\Controllers\Admin;

use Kourtis\Database\PhotosDB;
use Kourtis\Services\UploadImageService;

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

    public function postAddPost()
    {
        $DB = new PhotosDB();
        $uploadImageService = new uploadImageService();
        $success = false;

        //Try to upload image
        $uploadError = $uploadImageService->uploadImage('img/photos/');
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
                unlink("img/photos/$nameOfImage");
            }

        } else { //image failed to upload
            $flashMessage = $uploadError . "\nError: Could not upload image.";
        }

        echo $this->twig->render('photos/addPhotoPost.twig', array('flashMessage' => $flashMessage, 'success' => $success));
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
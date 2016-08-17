<?php
namespace Kourtis\Controllers\Admin;

use Kourtis\Database\TheatreDB;
use Kourtis\Services\UploadImageService;

class TheatreAdminController extends AdminController
{
    public function __construct($data=null)
    {
        parent::__construct($data);
    }

    public function addPost()
    {
        if ($this->adminIsLoggedIn()) {

            $db = new TheatreDB();

            $types = $db->getTheatreTypes();

            echo $this->twig->render('theatre/addTheatrePost.twig', array('types'=>$types));

        } else {
            echo $this->twig->render('login.twig');
        }
    }

    public function postAddPost(){
        $DB = new TheatreDB();
        $uploadImageService = new uploadImageService();
        $success = false;

        //Try to upload image
        $uploadError = $uploadImageService->uploadImage('img/theatre/');
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
                unlink("img/theatre/$nameOfImage");
            }

        } else { //image failed to upload
            $flashMessage = $uploadError . "\nError: Could not upload image.";
        }

        echo $this->twig->render('theatre/addTheatrePost.twig', array('flashMessage' => $flashMessage, 'success' => $success));
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
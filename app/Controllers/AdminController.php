<?php
/**
 * Created by PhpStorm.
 * User: antony
 * Date: 7/1/16
 * Time: 9:24 PM
 */
namespace Kourtis\Controllers;

use Kourtis\Database\DB;
use Kourtis\Models\User;
use Kourtis\Services\SwiftMailer;
use Twig_Environment;
use Twig_Extension_Debug;
use Twig_Loader_Filesystem;
use Kourtis\Services\UploadImage;

class AdminController extends Controller
{
    protected $user;

    public function __construct($data = null)
    {
        parent::__construct($data = null);

        $loader = new Twig_Loader_Filesystem(__DIR__ . '/../Views/admin');
        $this->twig = new Twig_Environment($loader, array(
            'debug' => true
        ));
        $this->twig->addExtension(new Twig_Extension_Debug());

        if (isset($_SESSION['user']) && isset($_SESSION['password'])) {
            $this->user = new User($_SESSION['user'], $_SESSION['password']);
        }
    }

    public function index()
    {
        if ($this->adminIsLoggedIn())
            echo $this->twig->render('dashboard.twig');
        else
            $this->login();
    }

    public function addCinemaPost()
    {
        if ($this->adminIsLoggedIn())
            echo $this->twig->render('addCinemaPost.twig');
        else
            echo $this->twig->render('login.twig');
    }

    public function addTheatrePost()
    {
        if ($this->adminIsLoggedIn())
            echo $this->twig->render('addCinemaPost.twig');
        else
            echo $this->twig->render('login.twig');
    }

    public function addMusicPost()
    {
        if ($this->adminIsLoggedIn())
            echo $this->twig->render('addCinemaPost.twig');
        else
            echo $this->twig->render('login.twig');
    }
    
    public function addPhotoPost()
    {
        if ($this->adminIsLoggedIn())
            echo $this->twig->render('addCinemaPost.twig');
        else
            echo $this->twig->render('login.twig');
    }

    public function addPodcastPost()
    {
        if ($this->adminIsLoggedIn())
            echo $this->twig->render('addCinemaPost.twig');
        else
            echo $this->twig->render('login.twig');
    }

    public function postAddItem()
    {
        $DB = new DB();
        $uploadImageService = new UploadImage();
        $success = false;

        //Try to upload image
        $uploadError = $uploadImageService->uploadImage();
        if (empty($uploadError)) {

            //Add row to db
            $nameOfImage = $_FILES['image']['name'];
            $result = $DB->addItem($_POST, $nameOfImage);

            if (empty($result)) { //successfully added row
                $flashMessage = "Item Succesfully Added";
                $success = true;
            } else { //failed to add row
                $flashMessage = "Error: Could not add item. Please check the values you have given.";
                //Delete uploaded image from server
                unlink("images/$nameOfImage");
            }

        } else { //image failed to upload
            $flashMessage = $uploadError . "\nError: Could not upload image.";
        }

        echo $this->twig->render('addItem.twig', array('flashMessage' => $flashMessage, 'success' => $success));
    }

    public function deleteItem()
    {
        if ($this->adminIsLoggedIn()) {
            $myDB = new DB();
            $items = $myDB->getAllPosts();

            echo $this->twig->render('deleteItem.twig', array('items' => $items));
        } else {
            echo $this->twig->render('login.twig');
        }

    }

    public function postDeleteItem()
    {
        $myDB = new DB();

        $result = $myDB->deleteItems($_POST);

        if ($result == 0) {
            $message = "Success! Items Deleted.";
        } elseif ($result == 1) {
            $message = "Failure. You did not select any items!";
        } elseif ($result == 2) {
            $message = "Failure. Something went wrong. Please try again.";
        } elseif ($result == 3) {
            $message = "Failure. Could not remove image. Make sure you selected a valid item.";
        }

        $items = $myDB->getAllPosts();

        echo $this->twig->render('deleteItem.twig', array('items' => $items, 'result' => $result, 'message' => $message));
    }

    public function deleteItems($data)
    {
        if (isset($data['items'])) {
            $items = $data['items'];

            foreach ($items as $item => $id) {

                //Get the image for the current item so that we delete it from server
                $getNameOfImage = $this->conn->prepare("SELECT image 
      FROM fab.items WHERE id = :id");
                $getNameOfImage->bindParam(':id', $id);
                $getNameOfImage->execute();

                // set the resulting array to associative
                $getNameOfImage->setFetchMode(PDO::FETCH_ASSOC);
                $arrayWithNameOfImage = $getNameOfImage->fetchAll();
//                var_dump($arrayWithNameOfImage);

                //Delete uploaded image from server
                $nameOfImage = $arrayWithNameOfImage[0]['image'];
//                var_dump("Image: " . $nameOfImage);
                $resultRemoveImage = unlink("images/$nameOfImage");
                if ($resultRemoveImage == false){
                    $result = 3; //Image was not removed from server
                    break;
                }

                //Delete row from db
                $stmt = $this->conn->prepare("DELETE FROM fab.items
WHERE id=:id ;");
                $stmt->bindParam(':id', $id);
                $stmt->execute();

                if ($stmt == true) {
                    $result = 0; //all good
                } else {
                    $result = 2; //sth went wrong
                    break;
                }
            }
        } else {
            $result = 1; //No items selected in form
        }

        return $result;
    }

    public function editItem()
    {
        if ($this->adminIsLoggedIn()) {
            $myDB = new DB();
            $items = $myDB->getAllPosts();

            echo $this->twig->render('editItem.twig', array('items' => $items));
        } else {
            echo $this->twig->render('login.twig');
        }
    }

    public function postEditItem()
    {
        $myDB = new DB();
        $result = $myDB->editItems($_POST);

        $items = $myDB->getAllPosts();

        echo $this->twig->render('editItem.twig', array('items' => $items, 'result' => $result));
    }

    public function contactSupport()
    {
        if ($this->adminIsLoggedIn())
            echo $this->twig->render('contactSupport.twig');
        else
            echo $this->twig->render('login.twig');
    }

    public function postContact()
    {
        $mailer = new SwiftMailer();

        $result = $mailer->sendEmailToSupport($_POST);

        echo $this->twig->render('contactSupport.twig', array('result'=>$result));
    }

    public function login($errorMessage = null)
    {
        if (isset($errorMessage))
            echo $this->twig->render('login.twig');
        else
            echo $this->twig->render('login.twig', array('errorMessage' => $errorMessage));
    }

    public function postLogin()
    {
        $myDB = new DB();

        $user = $myDB->getUser($_POST['username'], $_POST['password']);

        if (empty($user)) {
            $errorMessage = "Wrong Credentials.";
            $this->login($errorMessage);
        } else {
            $this->user = new User($_POST['username'], $_POST['password']); //find the user from db

            $errorMessage = $this->user->isAdmin(); //authenticate user

            if (empty($errorMessage)) { //if authentication successful

                $this->user->login(); //set Cookies and Session

                $this->index(); //show dashboard
            } else {
                $this->login($errorMessage); //redirect to login page
            }
        }
    }

    public function logout()
    {
        if ($this->adminIsLoggedIn()) {
            $this->user->logout();
            $this->login();
        }
    }

    public function adminIsLoggedIn()
    {
        if (isset($this->user) && $this->user->isLoggedIn() && empty($this->user->isAdmin()))
            return true;
        else
            return false;
    }

}
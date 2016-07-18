<?php
/**
 * Created by PhpStorm.
 * User: antony
 * Date: 7/1/16
 * Time: 9:24 PM
 */
namespace Kourtis\Controllers\Admin;

use Kourtis\Controllers\Controller;
use Kourtis\Database\UserDB;
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

        $loader = new Twig_Loader_Filesystem(__DIR__ . '/../../Views/admin');
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
        $userDB = new UserDB();

        $user = $userDB->getUser($_POST['username'], $_POST['password']);

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
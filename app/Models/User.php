<?php
/**
 * Created by PhpStorm.
 * User: antony
 * Date: 7/7/16
 * Time: 1:17 PM
 */
namespace Kourtis\Models;

use Kourtis\Database\UserDB;

class User
{
    protected $userDB;

    protected $username;
    protected $password;
    protected $isAdmin;

    /**
     * User constructor.
     * @param $username
     * @param $password
     */
    public function __construct($username, $password)
    {
        $this->userDB = new UserDB();

        $this->setClassVariables($username, $password);
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    public function setClassVariables($username, $password)
    {
        $user = $this->userDB->getUser($username, $password);

        $user = $user[0];

        $this->username = $user['username'];
        $this->password = $user['password'];
        $this->isAdmin = $user['isAdmin'];
    }

    public function isAdmin()
    {
        if ($this->getIsAdmin() === '1') {
            return "";
        } elseif (is_null($this->isAdmin)) {
            return "The credentials you entered are wrong";
        } elseif ($this->isAdmin === '0') {
            return "You are a user but not an admin..";
        } else {
            return "If you forgot your credentials contact support";
        }
    }

    public function isLoggedIn()
    {
        if (isset($_COOKIE['active'])) {
            return true;
        }

        if (isset($_SESSION['user']) && $_SESSION['user'] == $this->getUsername()) {
            return true;
        } else {
            return false;
        }
    }

    public function login()
    {
        //Start $_SESSION
        $status = session_status();
        if ($status == PHP_SESSION_NONE) {
            //There is no active session
            session_start();
        } elseif ($status == PHP_SESSION_DISABLED) {
            //Sessions are not available
        } elseif ($status == PHP_SESSION_ACTIVE) {
            //Destroy current and start new one
            session_destroy();
            session_start();
        }

        //Set $_SESSION variables
        $_SESSION['user'] = $this->getUsername();
        $_SESSION['password'] = $this->getPassword();
        $_SESSION['isAdmin'] = $this->getIsAdmin();

        //Set $_COOKIE
        if (isset($_POST['remember'])) {
            setcookie("active", $_SESSION['user'], time() + (3600 * 24 * 365));
        }
    }

    public function logout()
    {
        $status = session_status();
        if ($status == PHP_SESSION_NONE) {
            //There is no active session
            session_start();
        } elseif ($status == PHP_SESSION_DISABLED) {
            //Sessions are not available
        } elseif ($status == PHP_SESSION_ACTIVE) {
            //Destroy current and start new one
            session_destroy();
            session_start();
        }

        //Unset $_SESSION variables
        unset($_SESSION["user"]);
        unset($_SESSION["password"]);
        unset($_SESSION["isAdmin"]);

        //Unset $_COOKIE variables
        unset($_COOKIE['active']);
        setcookie('active', '', time() - 3600);
    }

}
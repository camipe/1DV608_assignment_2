<?php

namespace model;

class User {

    private $username;
    private $password;
    private $isLoggedIn = false;

    public function __construct() {

       $this->username = "Admin";
       $this->password = "Password";
    }

    public function validateCredentials($username, $password)
    {
        if ($username == $this->username) {

            if ($password == $this->password) {

                $this->isLoggedIn = true;
                $this->setLoginStatusInSession();

                return true;
            }
        }
        else {

            return false;
        }
    }

    public function logout()    {

        session_unset();
        session_destroy();
    }

    public function getLoginStatus() {
        return $this->isLoggedIn;
    }

    public function getLoginStatusFromSession() {

        return (isset($_SESSION['isLoggedIn'])) ? $_SESSION['isLoggedIn'] : false;
    }

    public function setLoginStatusInSession() {

        $_SESSION['isLoggedIn'] = $this->isLoggedIn;
    }
}

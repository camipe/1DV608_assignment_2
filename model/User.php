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
                return true;
            }
        }
        else {

            return false;
        }
    }

    public function getLoginStatus()
    {
        return $this->isLoggedIn;
    }

}

<?php

namespace model;

class User {

    private $username;
    private $password;

    public function __construct() {

       $this->username = "Admin";
       $this->password = "Password";
    }

    public function validateCredentials($username, $password)
    {
        if ($username == $this->username) {

            if ($password == $this->password) {

                return true;
            }
        }
        else {

            return false;
        }
    }

}

<?php

namespace model;

class User {

    private $username;
    private $password;

    public function __construct() {

       $this->username = "Admin";
       $this->password = "Password";
    }

}

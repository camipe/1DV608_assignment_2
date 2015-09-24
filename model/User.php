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

    /**
     * Checks if the credentials matches the user's
     * @param  string $username
     * @param  string $password
     * @return bool
     */
    private function authenticate($username, $password) {
        if ($username == $this->username && $password == $this->password) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Starts the login process and updates logged in state
     * @param  string $username
     * @param  string $password
     * @return void
     */
    public function login($username, $password) {
        if ($this->authenticate($username, $password)) {
            $this->isLoggedIn = true;
            $this->setLoginStatusInSession();
        }
    }

    /**
     * Removes and destroys the session to log out the user
     * @return void
     */
    public function logout() {
        session_unset();
        session_destroy();
    }

    /**
     * Retrieves current logged in state from session
     * @return [type] [description]
     */
    public function getLoginStatusFromSession() {
        return (isset($_SESSION['isLoggedIn'])) ? $_SESSION['isLoggedIn'] : false;
    }

    /**
     * Sets the logged in state to the same as the local object's
     * @return void
     */
    public function setLoginStatusInSession() {
        $_SESSION['isLoggedIn'] = $this->isLoggedIn;
    }
}

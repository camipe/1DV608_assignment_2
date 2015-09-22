<?php

namespace controller;

class LoginController {

    private $user;
    private $loginView;


    public function __construct(\model\User $user, \view\LoginView $loginView) {

        $this->user = $user;
        $this->loginView = $loginView;
    }

    public function doLogin()
    {
        if ($this->user->validateCredentials($this->loginView->getRequestUserName(),
                                            $this->loginView->getRequestPassword())) {
            echo "Logged in";
        }
        else {echo "Not logged in";}

    }
}

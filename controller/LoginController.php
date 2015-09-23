<?php

namespace controller;

class LoginController {

    private $user;
    private $loginView;


    public function __construct(\model\User $user, \view\LoginView $loginView) {

        $this->user = $user;
        $this->loginView = $loginView;
    }
    // TODO: Implement model state change, Is logged in etc.
    public function doLogin()
    {

        if ($this->loginView->userWantsToLogin()) {
            $this->user->validateCredentials($this->loginView->getRequestUserName(),
                                            $this->loginView->getRequestPassword());
        }

        if ($this->loginView->userWantsToLogout()) {
            $this->user->logout();
        }
    }
}

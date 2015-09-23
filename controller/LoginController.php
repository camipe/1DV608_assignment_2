<?php

namespace controller;

class LoginController {

    private $user;
    private $loginView;


    public function __construct(\model\User $user, \view\LoginView $loginView) {

        $this->user = $user;
        $this->loginView = $loginView;
    }

    public function doLogin()    {

        if ($this->loginView->userWantsToLogin()) {
            $this->user->validateCredentials($this->loginView->getRequestUserName(),
                                            $this->loginView->getRequestPassword());

            if ($this->user->getLoginStatusFromSession()) {
                $this->loginView->setMessageLoginSuccess();
            }
        }

        if ($this->loginView->userWantsToLogout()) {
            $this->user->logout();

            if (!$this->user->getLoginStatusFromSession()) {
                $this->loginView->setMessageLogoutSuccess();
            }
        }
    }
}

<?php

namespace controller;

class LoginController {

    private $user;
    private $loginView;


    public function __construct(\model\User $user, \view\LoginView $loginView) {

        $this->user = $user;
        $this->loginView = $loginView;
    }

    /**
     * Checks if user wants to login or log out, fullfills that request and presents
     * the relevant message in the view.
     * @return voic
     */
    public function doLogin()    {

        if ($this->loginView->userWantsToLogin() && !$this->user->getLoginStatusFromSession()) {
            $this->user->login($this->loginView->getRequestUserName(),
                               $this->loginView->getRequestPassword());

            // If login was successful show welcome message
            if ($this->user->getLoginStatusFromSession()) {
                $this->loginView->setMessageLoginSuccess();
            }
        }

        if ($this->loginView->userWantsToLogout() && $this->user->getLoginStatusFromSession()) {
            $this->user->logout();

            // If log out was successful show goodbye message
            if (!$this->user->getLoginStatusFromSession()) {
                $this->loginView->setMessageLogoutSuccess();
            }
        }
    }
}

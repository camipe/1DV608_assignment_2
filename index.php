<?php

session_start();

//INCLUDE THE FILES NEEDED...
require_once('controller/LoginController.php');

require_once('model/User.php');

require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// Dummy user for testing login
$user = new \model\user();

//CREATE OBJECTS OF THE VIEWS
$loginView = new \view\LoginView($user);
$dateTimeView = new \view\DateTimeView();
$layoutView = new \view\LayoutView();

$loginController = new \controller\LoginController($user, $loginView);

$loginController->doLogin();

$layoutView->render($user->getLoginStatusFromSession(), $loginView, $dateTimeView);

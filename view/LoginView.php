<?php

namespace view;

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';



	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {
		$message = '';

		if ($this->checkIfPostIsEmpty()) {

			if (!$this->getRequestUserName()) {

				$message = "Username is missing";
			}

			if (!$this->getRequestPassword() && $this->getRequestUserName()) {

				$message = "Password is missing";
			}
		}

		$response = $this->generateLoginFormHTML($message);
		//$response .= $this->generateLogoutButtonHTML($message);
		return $response;
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message) {
		return '
			<form method="post" >
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>

					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />

					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}

	//TODO: Create GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	//TODO: Sanitize input

	public function getRequestUserName() {

		if (isset($_POST[self::$name]) && !empty($_POST[self::$name])) {

			return $_POST[self::$name];
		}
		else {

			return null;
		}
	}

	public function getRequestPassword() {

		if (isset($_POST[self::$password]) && !empty($_POST[self::$password])) {

			return $_POST[self::$password];
		}
		else {

			return null;
		}
	}

	private function checkIfPostIsEmpty() {

		if (isset($_POST) && !empty($_POST)) {

			return true;
		}
		else {

			return null;
		}
	}

	public function userWantsToLogin() {

		if (isset($_POST[self::$login]) && !empty($_POST[self::$login])) {

			return true;
		}
		else {

			return false;
		}



	}

}

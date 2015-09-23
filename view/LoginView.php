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

	private $user;
	private $message;

	public function __construct(\model\User $user) {

		$this->user = $user;
	}


	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {

		// If the user isn't logged in, checking if form fields are empty
		if (!$this->user->getLoginStatusFromSession() && $this->userWantsToLogin()) {

			if (!$this->user->getLoginStatusFromSession()) {
				$this->setMessageLoginFailed();
			}

			if (!$this->getRequestUserName()) {
				$this->setMessageUsernameMissing();
			}

			if (!$this->getRequestPassword() && $this->getRequestUserName()) {
				$this->setMessagePasswordMissing();
			}
		}

		$message = $this->message;

		if ($this->user->getLoginStatusFromSession()) {
			$response = $this->generateLogoutButtonHTML($message);
		} else {
			$response = $this->generateLoginFormHTML($message);
		}

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
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . htmlentities($this->getRequestUserName()) . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />

					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}

    /**
     * [getRequestUserName description]
     * @return string
     */
	public function getRequestUserName() {
		return (isset($_POST[self::$name])) ? $_POST[self::$name] : "";
	}

	/**
	 * [getRequestPassword description]
	 * @return string
	 */
	public function getRequestPassword() {
		return (isset($_POST[self::$password])) ? $_POST[self::$password] : "";
	}

	/**
	 * [userWantsToLogin description]
	 * @return bool
	 */
	public function userWantsToLogin() {
		return (isset($_POST[self::$login])) ? true : false;
	}

	/**
	 * [userWantsToLogout description]
	 * @return bool
	 */
	public function userWantsToLogout() {
		return (isset($_POST[self::$logout])) ? true : false;
	}

	// Messages
	// TODO: Move to own class?

	/**
	 * @return void BUT sets message variable on the object
	 */
	public function setMessageUsernameMissing() {
		$this->message = "Username is missing";
	}

	/**
	 * @return void BUT sets message variable on the object
	 */
	public function setMessagePasswordMissing() {
		$this->message = "Password is missing";
	}

	/**
	 * @return void BUT sets message variable on the object
	 */
	public function setMessageLoginSuccess() {
		$this->message = "Welcome";
	}

	/**
	 * @return void BUT sets message variable on the object
	 */
	public function setMessageLoginFailed() {
		$this->message = "Wrong name or password";
	}

	/**
	 * @return void BUT sets message variable on the object
	 */
	public function setMessageLogoutSuccess() {
		$this->message = "Bye bye!";
	}

}

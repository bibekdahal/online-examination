<?php

class Session {
	private $m_sessionName;
	private $m_secure;
	private $m_httpOnly;
	public function __construct() {
		$this->m_sessionName = 'sec_session';
		$this->m_secure = true;
		$this->m_httpOnly = true;
	}
	
	public function Start() {
		if (ini_set('session.use_only_cookies', 1) === false) {
			throw "can't initiate a safe session";
		}
		$cookieParams = session_get_cookie_params();
		session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $this->m_secure, $this->m_httpOnly);
		session_name($this->m_sessionName);
		session_start();
		// Start the PHP session
		session_regenerate_id();
		// regenerated the session, delete the old one.
	}

	public function login_check($mysqli) {
		if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
			$user_id = $_SESSION['user_id'];
			$login_string = $_SESSION['login_string'];
			$username = $_SESSION['username'];
			$user_browser = $_SERVER['HTTP_USER_AGENT'];
			if ($stmt = $mysqli -> prepare("SELECT password FROM members WHERE id = ? LIMIT 1")) {
				$stmt -> bind_param('i', $user_id);
				$stmt -> execute();
				$stmt -> store_result();

				if ($stmt -> num_rows == 1) {
					$stmt -> bind_result($password);
					$stmt -> fetch();
					$login_check = hash('sha512', $password . $user_browser);
					if ($login_check == $login_string)
						return true;
					else
						return false;
				} else
					return false;
			} else
				return false;
		} else
			return false;
	}

}
?>
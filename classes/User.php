<?php

require_once 'Session.php';

define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DATABASE", "frobi-online-examination");

define("SECURE", true);

class User {
	private $m_session;
	private $m_sqli;
	public function __construct() {
		$this -> m_session = new Session;
		$this -> m_sqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
	}

	public function StartSession() {
		$this -> m_session -> Start();
	}

	public function login($username, $password) {
		$mysqli = $this -> m_sqli;
		if ($stmt = $mysqli -> prepare("SELECT id, password, salt FROM users WHERE username = ? LIMIT 1")) {
			$stmt -> bind_param('s', $username);
			$stmt -> execute();
			$stmt -> store_result();
			$stmt -> bind_result($user_id, $db_password, $salt);
			$stmt -> fetch();

			$password = hash('sha512', $password . $salt);
			if ($stmt -> num_rows == 1) {
				if ($this -> checkbrute($user_id, $mysqli) == true) {
					throw "Account Locked";
				} else {
					if ($db_password == $password) {
						$user_browser = $_SERVER['HTTP_USER_AGENT'];
						$user_id = preg_replace("/[^0-9]+/", "", $user_id);
						$_SESSION['user_id'] = $user_id;
						$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);
						$_SESSION['username'] = $username;
						$_SESSION['login_string'] = hash('sha512', $password . $user_browser);
						return true;
					} else {
						$now = time();
						$mysqli -> query("INSERT INTO login_attempts(user_id, time) VALUES ('$user_id', '$now')");
						return false;
					}
				}
			} else {
				return false;
			}
		}
	}

	function checkbrute($user_id, $mysqli) {
		$now = time();
		$valid_attempts = $now - (2 * 60 * 60);
		if ($stmt = $mysqli -> prepare("SELECT time FROM login_attempts WHERE user_id = ? AND time > '$valid_attempts'")) {
			$stmt -> bind_param('i', $user_id);
			$stmt -> execute();
			$stmt -> store_result();
			if ($stmt -> num_rows > 5) {
				return true;
			} else {
				return false;
			}
		}
	}

	function loggedin() {
		$mysqli = $this -> m_sqli;
		if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
			$user_id = $_SESSION['user_id'];
			$login_string = $_SESSION['login_string'];
			$username = $_SESSION['username'];
			$user_browser = $_SERVER['HTTP_USER_AGENT'];
			if ($stmt = $mysqli -> prepare("SELECT password FROM users WHERE id = ? LIMIT 1")) {
				$stmt -> bind_param('i', $user_id);
				$stmt -> execute();
				$stmt -> store_result();

				if ($stmt -> num_rows == 1) {
					$stmt -> bind_result($password);
					$stmt -> fetch();
					$login_check = hash('sha512', $password . $user_browser);

					if ($login_check == $login_string) {
						return true;
					} else {
						return false;
					}
				} else {
					return false;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

}
?>
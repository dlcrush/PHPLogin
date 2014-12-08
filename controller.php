<?php

	session_start();

	require_once 'UsersCollection.php';
	require_once 'User.php';
	require_once 'UsernameAlreadyExistsException.php';

	if (empty($_GET['m'])) {
		http_response_code(404);
		echo "<h1>404</h1>";
		echo "<p>Page Not found</p>";
		die();
	}

	$users = new UsersCollection;

	$users->read();

	var_dump($users->toArray());

	//die();

	switch($_GET['m']) {
		case 'login':
			$username = $_POST['username'];
			$password = $_POST['password'];
			login($username, $password);
			break;
		case 'signup':
			// handle process signup
			$username = $_POST['username'];
			$password = $_POST['password'];
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$birth_date = $_POST['birth_date'];

			signup($users, $username, $password, $first_name, $last_name, $birth_date);
			break;
		case 'update':
			// update user's information
			
			$username = $_POST['username'];
			$password = $_POST['password'];
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$birth_date = $_POST['birth_date'];

			update($users, $username, $password, $first_name, $last_name, $birth_date);
			break;
		case 'logout':

			logout();
			break;
		default:
			http_response_code(404);
			echo "<h1>404</h1>";
			echo "<p>Page Not found</p>";
			die();
	}


	function login($username, $password) {


		session_unset();
	}

	function logout() {
		session_unset();
	}

	function signup($users, $username, $password, $first_name, $last_name, $birth_date, $sign_up_date) {
		try {
			$users->add(new User($username, $password, $first_name, $last_name, $birth_date));
		} catch(UsernameAlreadyExistsException $e) {
			http_redirect();
		}
	}
?>
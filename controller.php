<?php

	session_start();

	require_once 'UsersCollection.php';
	require_once 'User.php';
	require_once 'UsernameAlreadyExistsException.php';
	require_once 'UserNotFoundException.php';

	if (empty($_GET['m'])) {
		http_response_code(404);
		echo "<h1>404</h1>";
		echo "<p>Page Not found</p>";
		die();
	}

	$users = new UsersCollection;

	$users->read();

	switch($_GET['m']) {
		case 'login':
			$username = $_POST['username'];
			$password = $_POST['password'];
			login($users, $username, $password);

			header('Location: index.php');
			break;
		case 'signup':

			$username = $_POST['username'];
			$password = $_POST['password'];
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$birth_date = $_POST['birth_date'];

			signup($users, $username, $password, $first_name, $last_name, $birth_date);

			$users->save();

			header('Location: index.php');
			break;
		case 'update':
			
			$username = $_SESSION['username'];
			$password = $_POST['password'];
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$birth_date = $_POST['birth_date'];

			$_SESSION['user'] = update($users, $username, $password, $first_name, $last_name, $birth_date);

			$users->save();

			header('Location: index.php?success=Changes have been successfully saved');
			break;
		case 'logout':

			logout();

			header('Location: login.php');
			break;
		default:
			http_response_code(404);
			echo "<h1>404</h1>";
			echo "<p>Page Not found</p>";
			die();
	}


	function login($users, $username, $password) {
		try {
			$user = $users->getUser($username);

		}
		catch (UserNotFoundException $e) {
			header('Location: login.php?error=Username does not exist');
		}

		if ($user->authenticate($password)) {
			session_unset();
			$_SESSION['username'] = $username;
			$_SESSION['user'] = $user;

			header('Location: index.php');
		}
		else {
			header('Location: login.php?error=Invalid username/password combination');
		}
	}

	function logout() {
		session_unset();
	}

	function signup($users, $username, $password, $first_name, $last_name, $birth_date) {
		try {
			$users->add(new User($username, $password, $first_name, $last_name, $birth_date));
			header('Location: index.php');
		} catch(UsernameAlreadyExistsException $e) {
			// I should send back all the old form data but I'm too lazy to do that
			header('Location: signup.php?error=Username already exists');
		}
	}

	function update($users, $username, $password, $first_name, $last_name, $birth_date) {
		try {
			$user = $users->getUser($username);

		}
		catch (UserNotFoundException $e) {
			header('Location: login.php');
		}

		$user->update($password, $first_name, $last_name, $birth_date);

		return $user;
	}
?>
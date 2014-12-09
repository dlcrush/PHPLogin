<?php

	session_start(); // start the session

	// load classes
	require_once 'UsersCollection.php';
	require_once 'User.php';
	require_once 'UsernameAlreadyExistsException.php';
	require_once 'UserNotFoundException.php';
	require_once 'functions.php';

	if (empty($_GET['m'])) {
		// no action defined
		http_response_code(404);
		echo "<h1>404</h1>";
		echo "<p>Page Not found</p>";
		die();
	}

	// initialize UsersCollection
	$users = new UsersCollection;
	$users->read(); // reads from data/users.json

	// controller for action
	switch($_GET['m']) {
		case 'login':

			// process login
			
			$username = $_POST['username'];
			$password = $_POST['password'];

			login($users, $username, $password);

			break;
		case 'signup':

			// process signup

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

			// process update
			
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

			// process logout

			logout();

			header('Location: login.php');
			break;
		default:

			// doesn't match our valid list of actions

			http_response_code(404);
			echo "<h1>404</h1>";
			echo "<p>Page Not found</p>";
			die();
	}
?>
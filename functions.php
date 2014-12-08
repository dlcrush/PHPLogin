<?php

	function login($users, $username, $password) {
		try {
			$user = $users->getUser($username);
		}
		catch (UserNotFoundException $e) {
			// Username doesn't exist, redirect back to login form
			header('Location: login.php?error=Username does not exist');
		}

		if ($user->authenticate($password)) {
			// user is authenticated
			session_unset(); // restart session
			$_SESSION['username'] = $username;
			$_SESSION['user'] = $user;

			header('Location: index.php');
		}else {
			// Username/password combination doesn't match
			header('Location: login.php?error=Invalid username/password combination');
		}
	}

	function logout() {
		session_unset(); // clear all session variables
	}

	function signup($users, $username, $password, $first_name, $last_name, $birth_date) {
		try {
			$users->add(new User($username, $password, $first_name, $last_name, $birth_date));
			header('Location: index.php');
		} catch(UsernameAlreadyExistsException $e) {
			// The username already exists
			// I should send back all the old form data but I'm too lazy to do that
			header('Location: signup.php?error=Username already exists');
		}
	}

	function update($users, $username, $password, $first_name, $last_name, $birth_date) {
		try {
			$user = $users->getUser($username);
		}
		catch (UserNotFoundException $e) {
			// Username doesn't exist
			header('Location: login.php');
		}

		$user->update($password, $first_name, $last_name, $birth_date);

		return $user;
	}

?>
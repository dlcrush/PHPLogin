<?php

	// PRE: users is an array of User objects, username and password are defined
	// POST: If username and password are a valid combination, the user is logged in and redirected to index.
	// If not, the user is redirected back to the login page with an error message.
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

	// PRE: 
	// POST: the user is logged out
	function logout() {
		session_unset(); // clear all session variables
	}

	// PRE: users is an array of User objects, all other variables are defined
	// POST: If username isn't already accounted for in the users array, a new user object is added to users and redirected to index.
	// If username already exists, user is redirected back to signup form with error message.
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

	// PRE: users is an array of User objects, all other variables are defined
	// POST: The user's information is updated if the username exists and the updated User object is returned. Otherwise, the user is redirected back to the login page.
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
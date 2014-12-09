<?php

	require_once 'User.php';
	require_once 'UsernameAlreadyExistsException.php';
	require_once 'UserNotFoundException.php';

	// A collection of User objects
	class UsersCollection {
		private $users; // holds list of all user objects

		// constructor
		public function __construct () {
			$this->users = array();
		}

		// Reads in a JSON file representation into a collection
		public function read($filename='data/users.json') {
			$data = json_decode(file_get_contents($filename), true);

			if ($data == null) {
				$data = array();
			}

			foreach($data as $key => $value) {
				$this->users[$key] = new User($value['username'], $value['password'], $value['first_name'], $value['last_name'], $value['birth_date'], $value['sign_up_date']);
			}
		}

		// Writes the collection of User objects to a JSON file
		public function save($filename='data/users.json') {
			$data = $this->toJson();

			file_put_contents($filename, json_encode($data));
		}

		// Adds a new User object to the collection
		public function add($user) {
			if (array_key_exists($user->getUsername(), $this->users)) {
				throw new UsernameAlreadyExistsException('Username already exists');
			}

			$this->users[$user->getUsername()] = $user;
		}


		// Gets the particular user, throws UserNotFoundException if username is not found
		public function getUser($username) {
			if (! array_key_exists($username, $this->users)) {
				throw new UserNotFoundException('User not found.');
			}

			return $this->users[$username];
		}

		// Returns the array represnetation of the collection
		public function toArray() {
			return $this->users;
		}

		// Returns the JSON representation of the collection
		public function toJson() {
			$data = array();
			foreach($this->users as $user) {
				$data[$user->getUsername()] = $user->toArray();
			}

			return $data;
		}
	}

?>
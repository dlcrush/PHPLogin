<?php

	require_once 'User.php';
	require_once 'UsernameAlreadyExistsException.php';

	class UsersCollection {
		private $users; // holds list of all user objects

		public function __construct () {
			$users = array();
		}

		public function toArray() {
			return $this->users;
		}

		public function read($filename='data/users.json') {
			$this->users = json_decode(file_get_contents($filename), true);
		}

		public function add($user) {
			if (array_key_exists($user->getUsername(), $this->users)) {
				throw new UsernameAlreadyExistsException('Username already exists');
			}

			$users[$username] = $user;

			//array_push($users, $user);
		}
	}

?>
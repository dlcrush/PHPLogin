<?php

	require_once 'User.php';
	require_once 'UsernameAlreadyExistsException.php';
	require_once 'UserNotFoundException.php';

	class UsersCollection {
		private $users; // holds list of all user objects

		public function __construct () {
			$this->users = array();
		}

		public function toArray() {
			return $this->users;
		}

		public function read($filename='data/users.json') {
			$data = json_decode(file_get_contents($filename), true);

			foreach($data as $key => $value) {
				$this->users[$key] = new User($value['username'], $value['password'], $value['first_name'], $value['last_name'], $value['birth_date'], $value['sign_up_date']);
			}

			//$this->users = json_decode(file_get_contents($filename), true);

			// if ($this->users == null) {
			// 	$this->users = array();
			// }
		}

		public function save($filename='data/users.json') {
			$data = array();
			foreach($this->users as $user) {
				//var_dump($user);
				$data[$user->getUsername()] = $user->toArray();
			}

			file_put_contents($filename, json_encode($data));
		}

		public function add($user) {
			if (array_key_exists($user->getUsername(), $this->users)) {
				throw new UsernameAlreadyExistsException('Username already exists');
			}

			$this->users[$username] = $user;

			//array_push($users, $user);
		}

		public function getUser($username) {
			if (! array_key_exists($username, $this->users)) {
				throw new UserNotFoundException('User not found.');
			}

			return $this->users[$username];
		}
	}

?>
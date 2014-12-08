<?php

	class User {

		// user properties
		private $username;
		private $password;
		private $first_name;
		private $last_name;
		private $birth_date;
		private $sign_up_date;

		// constructor, creates new user
		public function __construct($username, $password, $first_name, $last_name, $birth_date) {
			$this->create($username, $password, $first_name, $last_name, $birth_date);
		}

		// Creates a new user
		// private because we want users to use the constructor
		private function create($username, $password, $first_name, $last_name, $birth_date) {
			$this->username = $username;
			$this->password = md5($password); // shouldn't use md5 but I'm being lazy
			$this->first_name = $first_name;
			$this->last_name = $last_name;
			$this->birth_date = $birth_date;
			$this->sign_up_date = new date();
		}

		// Updates the user
		public function update($password, $first_name, $last_name, $birth_date) {
			$this->password = $password;
			$this->first_name = $first_name;
			$this->last_name = $last_name;
			$this->birth_date = $birth_date;
		}

		// Returns the json representation of the user
		public function toJson() {
			return json_encode($this);
		}

		// Gets the username of the user
		public function getUsername() {
			return $this->username;
		}

		// Use this to authenticate user for login
		// Returns true if password matches the one on file, false otherwise.
		public function authenticate($password) {
			return md5($password) == $this->password;
		}
	}
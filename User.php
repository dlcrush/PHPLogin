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
		public function __construct($username, $password, $first_name, $last_name, $birth_date, $sign_up_date='') {
			date_default_timezone_set('America/New_York');
			if ($sign_up_date == '') {
				$sign_up_date = date('r');
			}
			$this->create($username, $password, $first_name, $last_name, $birth_date, $sign_up_date);
		}

		// Creates a new user
		// private because we want users to use the constructor
		private function create($username, $password, $first_name, $last_name, $birth_date, $sign_up_date) {
			$this->username = $username;
			$this->password = $password;
			$this->first_name = $first_name;
			$this->last_name = $last_name;
			$this->birth_date = $birth_date;
			$this->sign_up_date = $sign_up_date;
		}

		// Updates the user
		public function update($password, $first_name, $last_name, $birth_date) {
			if (! empty($password)) {
				$this->password = $password;
			}
			$this->first_name = $first_name;
			$this->last_name = $last_name;
			$this->birth_date = $birth_date;
		}

		// Returns the json representation of the user
		public function toJson() {
			$data = array('username' => $this->username, 'password' => $this->password,
				'first_name' => $this->first_name, 'last_name' => $this->last_name,
				'birth_date' => $this->birth_date, 'sign_up_date' => $this->sign_up_date);
			return json_encode($data);
		}

		public function toArray() {
			$data = array('username' => $this->username, 'password' => $this->password,
				'first_name' => $this->first_name, 'last_name' => $this->last_name,
				'birth_date' => $this->birth_date, 'sign_up_date' => $this->sign_up_date);

			return $data;
		}
		

		// Gets the username of the user
		public function getUsername() {
			return $this->username;
		}

		public function getFirstName() {
			return $this->first_name;
		}

		public function getLastName() {
			return $this->last_name;
		}

		public function getBirthDate() {
			return $this->birth_date;
		}

		public function getSignUpDate() {
			return $this->sign_up_date;
		}

		// Use this to authenticate user for login
		// Returns true if password matches the one on file, false otherwise.
		public function authenticate($password) {
			return $password == $this->password;
		}
	}
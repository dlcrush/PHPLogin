<?php

	class UsernameAlreadyExistsException extends Exception {
		public function __toString() {
			return $this->message;
		}
	}
?>
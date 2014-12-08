<?php

	class UserNotFoundException extends Exception {
		public function __toString() {
			return $this->message;
		}
	}
?>
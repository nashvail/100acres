<?php

class User {

	private $username;
	private $firstname;
	private $lastname;
	private $password;
	
	public function __construct($username, $firstname, $lastname, $password) {
		$this->username = $username;
		$this->firstname = $firstname;
		$this->lastname = $lastname;
		$this->password = $password;
	}

	public function jsonRep() {
		return '{
			"username" : "' .$this->username.'",
			"firstname" : "' .$this->firstname.'",
			"lastname" : "' .$this->lastname.'",
			"password" : "' .$this->password.'"
		}';
	}

	public function data() {
		return array(
			'username' => $this->username,
			'firstname' => $this->firstname,
			'lastname' => $this->lastname,
			'password' => $this->password
		);
	}



}
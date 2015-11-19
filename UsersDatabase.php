<?php

require 'User.php';
require 'JSONStream.php';

class UsersDatabase {

	// File names and reading writing goes in here
	private $jsonDataFile;
	private $usersData;

	public function __construct($jsonDataFile) {
		$this->jsonDataFile = $jsonDataFile;
		$this->usersData = new JSONStream($jsonDataFile);
	}

	public function addNewUser($username, $firstname, $lastname, $password) {
		if ( !$this->userExists($username) ) {
			$newUser = new User($username, $firstname, $lastname, $password)	;
			$this->usersData->addNew($newUser->data(), 'username');
			return true;
		} else {
			return false;
		}
	}

	public function authenticationSucceeded($username, $password) {
		if( $this->userExists($username) ) {
			return ( $this->usersData->dataArray()[$username]['password'] == $password );
		} else {
			return false;
		}
	}

	public function userExists($username) {
		return (array_key_exists($username, $this->usersData->dataArray()));
	}

	public function userFullName($username) {
		return ( $this->usersData->dataArray()[$username]['firstname'] . " " . $this->usersData->dataArray()[$username]['lastname'] );
	}

}
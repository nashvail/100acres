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

	public function addNewUser($newUser) {
		
	}

	public function userExists($username) {
		return (array_key_exists($username, $this->usersData->dataArray()));
	}

}
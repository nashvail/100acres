<?php 

session_start();

require 'UsersDatabase.php';
require 'helpers/adminManager.php';

if ( isset($_SESSION['username']) && isAdmin($_SESSION['username']) ) {

	$usersDatabase = new UsersDatabase('data/users.json');
	$userData = array(
		'username' => $_POST['username'],
		'firstname' => $_POST['firstname'],
		'lastname' => $_POST['lastname'],
		'password' => $_POST['password']
	);

	if ( $usersDatabase->addNewUser($userData['username'], $userData['firstname'], $userData['lastname'], $userData['password']) ) {
		echo "New user successfully added"; 
	} else {
		echo "There was a problem adding new user";
	}


} else {
	echo "Unauthorized access";
}


<?php

require 'UsersDatabase.php';

session_start();

$users = new UsersDatabase('data/users.json');

// Array to store any possible arrays
$errors = array();

$username = $_POST['username'];
$password = $_POST['password'];

// Collect all the errors
if ( empty($username) || empty($password) ) {
	$errors[] = "Please fill in all the fields";
} else if ( !$users->userExists($username) ) {
	$errors[] = "No such user found in the database";
} else if ( !$users->authenticationSucceeded($username, $password) ) {
	$errors[] = "Wrong username and password combination";
}

if ( empty($errors) ) { // If no errors occured

	if( $users->authenticationSucceeded($username, $password) ) {
		$_SESSION['username'] = $username;
	} else {
		echo "An error occured during authentication";
	}
	
} 

$_SESSION['loginerrors'] = $errors;

header("Location: index.php");




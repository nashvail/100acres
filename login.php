<?php

require 'UsersDatabase.php';

session_start();

$users = new UsersDatabase('data/users.json');

// Array to store any possible arrays
$errors = array();

$fields = array(
	'username' => $_POST['username'],
	'password' => $_POST['password']
);

// Collect all the errors
if ( empty($fields['username']) || empty($fields['password']) ) {
	$errors[] = "Please fill in all the fields";
} else if ( !$users->userExists($fields['username']) ) {
	$errors[] = "No such user found in the database";
} else if ( !$users->authenticationSucceeded($fields['username'], $fields['password']) ) {
	$errors[] = "Wrong username and password combination";
}

if ( empty($errors) ) { // If no errors occured
		$_SESSION['username'] = $fields['username'];
} 

$_SESSION['loginerrors'] = $errors;
$_SESSION['fields'] = $fields;

header("Location: index.php");




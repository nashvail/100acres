<?php

require 'UsersDatabase.php';

session_start();
$users = new UsersDatabase('data/users.json');

$username = $_POST['username'];
$password = $_POST['password'];

if( $users->authenticationSucceeded($username, $password) ) {
	$_SESSION['username'] = $username;
	header("Location: index.php");
} else {
	echo "An error occured during authentication";
}




<?php 

// Array of usernames that are admins
$admins = array('nishantve1');

function isAdmin($username) {
	global $admins;
	return in_array($username, $admins);
}

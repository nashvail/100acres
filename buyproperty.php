<?php

session_start();

require 'UsersDatabase.php';
require 'PropertiesDatabase.php';

// Connection to the database
$propertiesDatabase = new PropertiesDatabase('data/properties.json');

if ( isset($_SESSION['username']) ) {
	$toBuyPropertyId = $_GET['propertyId'];
	$buyerUsername = $_GET['buyer'];

	if ( !$propertiesDatabase->isSold($toBuyPropertyId) ) {
		$propertiesDatabase->update($toBuyPropertyId, 'sold', true);
		$propertiesDatabase->update($toBuyPropertyId, 'buyer', $buyerUsername);
		$_SESSION['buyingConfirmation'] = "Property successfully purchased!";
	} 
}
header("Location: index.php");

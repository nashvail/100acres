<?php 

session_start();

require 'JSONStream.php';
require 'PropertiesDatabase.php';
require 'helpers/adminManager.php';

if ( isset($_SESSION['username']) ) {

	$propertiesDatabase = new PropertiesDatabase('data/properties.json');
	$propertyData = array(
		'name' => $_POST['name'],
		'location' => $_POST['location'],
		'price' => $_POST['price']
	);

	$propertiesDatabase->addNew($propertyData['price'], $propertyData['name'], $_SESSION['username'], $propertyData['location']);



} else {
	echo "Unauthorized access";
}


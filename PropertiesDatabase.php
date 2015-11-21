<?php

require 'Property.php';

class PropertiesDatabase{

	// File names and reading writing goes in here
	private $jsonDataFile;
	private $propertiesData;

	public function __construct($jsonDataFile) {
		$this->jsonDataFile = $jsonDataFile;
		$this->propertiesData = new JSONStream($jsonDataFile);
	}

	public function propertyData($propertyId) {
		if( $this->propertyExists($propertyId) )
			return $this->propertiesData->dataArray()[$propertyId];
		else
			return false;
	}

	public function propertyExists($propertyId) {
		return (array_key_exists($propertyId, $this->propertiesData->dataArray()));
	}

	public function update($propertyId, $fieldName, $newValue) {
		if( $this->propertyExists($propertyId) )
			$this->propertiesData->update($propertyId, $fieldName, $newValue);
	}

	// This will need to be updated later ya know if you add new fields to the property data model
	public function addNew($price, $name, $owner, $location, $buyer) {
		$this->propertiesData->addNew(array(
			'price' => $price,
			'name' => $name,
			'location' => $location,
			'sold' => false,
			'owner' => $owner,
			'buyer' => ""
		));
	}

	public function isSold($propertyId) {
		if ( $this->propertyExists($propertyId) ) {
			return $this->dataArray()[$propertyId]['sold'];
		} else {
			return false;
		}
	}

	public function unsoldProperties() {
		return array_filter($this->dataArray(), function($property) {
			return $property['sold'] == false;
		});
	}

	public function soldProperties() {
		return array_filter($this->dataArray(), function($property) {
			return $property['sold'] == true;
		});
	}

	public function buyableProperties($username) {
		return array_filter($this->unsoldProperties(), function($property) {
			global $username;
			return $property['owner'] != $username;
		});
	}

	public function ownsProperty($propertyId, $username) {
		$properties = $this->dataArray();
		return $properties[$propertyId]['owner'] == $username || $properties[$propertyId]['buyer'] == $username;
	}

	public function dataArray() {
		return $this->propertiesData->dataArray();
	}

}
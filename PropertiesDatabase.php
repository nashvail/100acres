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
		if( propertyExists($propertyId) )
			$this->propertiesData->update($propertyId, $fieldName, $newValue);
	}

	// This will need to be updated later ya know if you add new fields to the property data model
	public function addNew($price, $name, $owner, $location) {
		$this->propertiesData->addNew(array(
			'price' => $price,
			'name' => $name,
			'location' => $location,
			'bought' => false,
			'owner' => $owner
		));
	}
	
	public function dataArray() {
		return $this->propertiesData->dataArray();
	}

}
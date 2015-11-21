<?php

class Property {

	private $price;
	private $name;
	private $sold;
	private $location;
	// username of the user who has listed the property for sale
	private $owner;
	
	public function __construct($price, $name, $location, $owner) {
		$this->price = $price;
		$this->name = $name;
		$this->location = $location;
		$this->owner = $owner;
		$this->sold = false;
	}

	public function data() {
		return array(
			'price' => $this->price,
			'name' => $this->name,
			'hasBeenPurchased' => $this->hasBeenPurchased,
		);
	}
}
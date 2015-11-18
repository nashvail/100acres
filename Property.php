<?php

class Property {

	private $price;
	private $name;
	private $hasBeenPurchased;
	
	public function __construct($price, $name) {
		$this->price = $price;
		$this->name = $name;
		$this->hasBeenPurchased = false;
	}

	public function data() {
		return array(
			'price' => $this->price,
			'name' => $this->name,
			'hasBeenPurchased' => $this->hasBeenPurchased,
		);
	}
}
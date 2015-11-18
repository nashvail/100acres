<?php

class JSONStream {

	private $file;

	public function __construct($file) {
		// TODO : Check if the file is a .json file
		$this->file = $file;
		if(!is_writeable($file)) 
			echo 'The file is not writable, you will not be able to perform I/O operations';
	}

	public function writeData($newData) {

		$arr_data = $this->dataArray();
		$arr_data[$newData['username']] = $newData;
		// array_push($arr_data, $newData);

		$finalData = json_encode($arr_data, JSON_PRETTY_PRINT);

		// Write new data to file
		if(file_put_contents($this->file, $finalData)) {
			echo "Data saved successfully";
		} else {
			echo "There was an error saving new data, file doesn't seem to be writable";
		}

	}

	public function dataArray() {
		return json_decode(file_get_contents($this->file), true);
	}

	public function dataJSON() {
		return json_encode($this->dataArray(), JSON_PRETTY_PRINT);
	}

}
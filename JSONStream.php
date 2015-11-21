<?php

class JSONStream {

	private $file;

	public function __construct($file) {
		// TODO : Check if the file is a .json file
		$this->file = $file;
		if(!is_writeable($file)) 
			echo 'The file is not writable, you will not be able to perform I/O operations';
	}

	// Writes new data to already existing dat in the database
	public function addNew($newData, $key) {
		$arr_data = $this->dataArray();

		if ( isset($key) ) {
			$arr_data[$newData[$key]] = $newData;
		} else {
			array_push($arr_data, $newData);
		}

		$this->overwrite($arr_data);
	}

	public function update($dataId, $fieldName, $newValue) {
		$arr_data = $this->dataArray();
		$arr_data[$dataId][$fieldName] = $newValue;

		$this->overwrite($arr_data);

	}

	private function overwrite($data) {
		if(file_put_contents($this->file, json_encode($data, JSON_PRETTY_PRINT))) {
			return true;
		} else {
			return false;
		}
	}

	public function dataArray() {
		return json_decode(file_get_contents($this->file), true);
	}

	public function dataJSON() {
		return json_encode($this->dataArray(), JSON_PRETTY_PRINT);
	}

}
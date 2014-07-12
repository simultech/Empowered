<?php
class InformationController extends AppController {
	
	public function beforeFilter() {
		$this->Auth->allow('index','events','parks','hospitals','allowance','statistics','needs','types');
		parent::beforeFilter();
	}
	
	public function index() {
		
	}
	
	public function events() {
		
	}
	
	public function parks() {
		
	}
	
	public function hospitals() {
		
	}
	
	public function allowance() {
		
	}
	
	public function statistics() {
		
	}
	
	public function needs() {
		
	}
	
	public function types() {
		
	}
	
	private function csv_to_array($filename) {
		if(!file_exists($filename) || !is_readable($filename)) return FALSE;

		$header = NULL;
		$data = array();
		if (($handle = fopen($filename, 'r')) !== FALSE) {
			while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
				if(!$header) {
					$header = $row;
				} else {
					$data[] = array_combine($header, $row);
				}
			}
			fclose($handle);
		}
		return $data;
	}
}
?>
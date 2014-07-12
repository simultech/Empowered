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
}
?>
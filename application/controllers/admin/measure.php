<?php
class Item extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('measure_model');
	}
	
	public function index() {
	}
	
}
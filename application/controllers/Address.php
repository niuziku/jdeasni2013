<?php
class Address extends Front_Controller{
	
	public function index(){
		$this->load->helper('url');
		$this->load->view('account/address/address_head');
		$this->load->view('header');
		$this->load->view('account/address/address_content');
		$this->load->view('footer');
		$this->load->view('account/address/address_trail');
	}
}
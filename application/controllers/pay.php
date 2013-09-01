<?php
class Pay extends Front_Controller{
	
	public function index(){
		$this->load->helper('url');
		$this->load->view('cart/pay/pay_head');
		$this->load->view('cart/pay/pay_content');
		$this->load->view('cart/pay/pay_trail');
	}
	
	public function success(){
		$this->load->helper('url');
		$email = $this->session->userdata('customer_name');
		$this->load->view('cart/pay_create_acount/pay_create_acount_head');
		$this->load->view('header');
		$this->load->view('cart/pay_create_acount/pay_create_acount_content', array('email'=>$email));
		$this->load->view('footer');
		$this->load->view('cart/pay_create_acount/pay_create_acount_trail');
	}
}
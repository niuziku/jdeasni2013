<?php
class Pay extends Front_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('other/pay/pay_head.php');
		$this->load->view('header.php');
		$this->load->view('other/pay/pay_content.php');
		$this->load->view('footer.php');
		$this->load->view('other/pay/pay_trail.php');
	}
}
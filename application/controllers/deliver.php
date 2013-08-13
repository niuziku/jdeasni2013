<?php
class Deliver extends Front_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('other/deliver/deliver_head.php');
		$this->load->view('header.php');
		$this->load->view('other/deliver/deliver_content.php');
		$this->load->view('footer.php');
		$this->load->view('other/deliver/deliver_trail.php');
	}
}
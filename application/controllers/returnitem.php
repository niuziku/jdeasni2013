<?php
class Returnitem extends Front_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('other/returnitem/returnitem_head.php');
		$this->load->view('header.php');
		$this->load->view('other/returnitem/returnitem_content.php');
		$this->load->view('footer.php');
		$this->load->view('other/returnitem/returnitem_trail.php');
	}
}
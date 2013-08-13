<?php
class Follow extends Front_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('other/follow/follow_head.php');
		$this->load->view('header.php');
		$this->load->view('other/follow/follow_content.php');
		$this->load->view('footer.php');
		$this->load->view('other/follow/follow_trail.php');
	}
}
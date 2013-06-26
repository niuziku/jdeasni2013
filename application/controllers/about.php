<?php
class About extends Front_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('about/about_head.php');
		$this->load->view('header.php');
		$this->load->view('about/about_content.php');
		$this->load->view('footer.php');
		$this->load->view('about/about_trail.php');
	}
}
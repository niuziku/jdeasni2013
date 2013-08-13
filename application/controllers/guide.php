<?php
class Guide extends Front_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('other/guide/guide_head.php');
		$this->load->view('header.php');
		$this->load->view('other/guide/guide_content.php');
		$this->load->view('footer.php');
		$this->load->view('other/guide/guide_trail.php');
	}
}
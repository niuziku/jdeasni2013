<?php
class Quality extends Front_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('other/quality/quality_head.php');
		$this->load->view('header.php');
		$this->load->view('other/quality/quality_content.php');
		$this->load->view('footer.php');
		$this->load->view('other/quality/quality_trail.php');
	}
}
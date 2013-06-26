<?php
class Customer extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('customer_model');
	}
	
	public function index() {
		$this->load->helper('url');
		if(!$this->is_login()) {
			redirect('admin/login');
		}
		else {
			$data['admin_name'] = $this->session->userdata['admin_name'];
			$this->load->view('admin/header.php', $data);
			$this->load->view('admin/customer.php');
			$this->load->view('admin/footer.php');
		}
	}
	
	public function single() {
		$this->load->helper('url');
		if(!$this->is_login()) {
			redirect('admin/login');
		}
		else {
			$data['admin_name'] = $this->session->userdata['admin_name'];
			$this->load->view('admin/header.php', $data);
			$this->load->view('admin/single_customer.php');
			$this->load->view('admin/footer.php');
		}
	}
	
	public function customer_list($page_num = 1, $display_type = 1) {
		
		$customer_list = $this->customer_model->order_list($page_num, $display_type);
		return $this->_json_response($customer_list);
	}
}
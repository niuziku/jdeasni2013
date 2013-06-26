<?php
class Discount extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('discount_model');
	}
	
	public function index() {
		$this->load->helper('url');
		if(!$this->is_login()) {
			redirect('admin/login');
		}
		else {
			$data['admin_name'] = $this->session->userdata['admin_name'];
			$this->load->view('admin/header.php', $data);
			$this->load->view('admin/discount.php');
			$this->load->view('admin/footer.php');
		}
	}
	
	public function add() {
		$this->load->helper('url');
		if(!$this->is_login()) {
			redirect('admin/login');
		}
		else {
			$data['admin_name'] = $this->session->userdata['admin_name'];
			$this->load->view('admin/header.php', $data);
			$this->load->view('admin/add_discount.php');
			$this->load->view('admin/footer.php');
		}
	}
	
	public function invalid() {
		$this->load->helper('url');
		if(!$this->is_login()) {
			redirect('admin/login');
		}
		else {
			$data['admin_name'] = $this->session->userdata['admin_name'];
			$this->load->view('admin/header.php', $data);
			$this->load->view('admin/invalid_discount.php');
			$this->load->view('admin/footer.php');
		}
	}
	
	public function add_discount() {
		$discount_code = $this->input->post('discount_code');
		$discount_type = $this->input->post('discount_type');
		$minus_price = $this->input->post('minus_price');
		$valid = 1;
		
		if($this->_isempty($discount_code, $discount_type, $minus_price)) {
			return $this->_json_response(array(), 777, 'Params cannot be empty');
		}
		
		$check = $this->discount_model->check($discount_code);
		if($check > 0) {
			return $this->_json_response(array(), 666, 'HAVE EXIST');
		}
		
		$item_detail = $this->discount_model->add_discount($discount_code, $discount_type, $minus_price, $valid);
		
		return $this->_json_response(array());
	}
	
	public function delete_discount() {
		$discount_id = $this->input->post('discount_id');
		if($this->_isempty($discount_id)) {
			return $this->_json_response(array(), 777, 'Params cannot be empty');
		}
		
		$discount = $this->discount_model->delete_discount($discount_id);
		return $this->_json_response(array());
	}
	
	public function invalid_discount() {
		$discount_id = $this->input->post('discount_id');
		if($this->_isempty($discount_id)) {
			return $this->_json_response(array(), 777, 'Params cannot be empty');
		}
		
		$discount = $this->discount_model->invalid_discount($discount_id);
		return $this->_json_response(array());
	}
	
	public function discount_list() {
		$discount_list = $this->discount_model->discount_list();
		return $this->_json_response($discount_list);
	}
	
	public function invalid_discount_list() {
		$discount_list = $this->discount_model->invalid_discount_list();
		return $this->_json_response($discount_list);
	}
}
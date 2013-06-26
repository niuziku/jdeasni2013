<?php
class Order extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('order_model');
	}
	
	public function index() {
		$this->load->helper('url');
		if(!$this->is_login()) {
			redirect('admin/login');
		}
		else {
			$data['admin_name'] = $this->session->userdata['admin_name'];
			$this->load->view('admin/header.php', $data);
			$this->load->view('admin/order.php');
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
			$this->load->view('admin/single_order.php');
			$this->load->view('admin/footer.php');
		}
	}
	
	public function order_list($page_num = 1) {
		$order_list = $this->order_model->order_list($page_num);
		return $this->_json_response($order_list);
	}
	
	public function order_amount() {
		$order_amount = $this->order_model->order_amount();
		return $this->_json_response($order_amount);
	}
	
	public function single_order($order_id) {
		if($this->_isempty($order_id)) {
			return $this->_json_response(array(), 777, 'Params cannot be empty');
		}
		
		$order_data = $this->order_model->single_order($order_id);
		return $this->_json_response($order_data);
	}
	
	public function change_status() {
		$order_id = $this->input->post('order_id');
		$status_index = $this->input->post('status_index');
		
		if($this->_isempty($order_id, $status_index)) {
			return $this->_json_response(array(), 777, 'Params cannot be empty');
		}
		
		$order_data = $this->order_model->change_status($order_id, $status_index);
		return $this->_json_response($order_data);
	}
	
	public function upadte_express() {
		
		$order_id = $this->input->post('order_id');
		$express = $this->input->post('express');
		$express_num = $this->input->post('express_num');
		
		if($this->_isempty($order_id, $express, $express_num)) {
			return $this->_json_response(array(), 777, 'Params cannot be empty');
		}
		
		$order_data = $this->order_model->upadte_express($order_id, $express, $express_num);
		return $this->_json_response($order_data);
	}
}
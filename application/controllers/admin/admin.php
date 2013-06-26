<?php
class Admin extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
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
	
	public function edit_password() {
		$this->load->helper('url');
		if(!$this->is_login()) {
			redirect('admin/login');
		}
		else {
			$data['admin_name'] = $this->session->userdata['admin_name'];
			$this->load->view('admin/header.php', $data);
			$this->load->view('admin/edit_password.php');
			$this->load->view('admin/footer.php');
		}
	}
	
	public function password_operation() {
		$old_password = $this->input->post('old_password');
		$new_password = $this->input->post('new_password');
		
		if($this->_isempty($old_password, $new_password)) {
			return $this->_json_response(array(), 777, 'Params cannot be empty');
		}
		
		$admin_id = $this->session->userdata['admin_id'];
		$check = $this->admin_model->check_password($admin_id, $old_password);
		if(empty($check)) {
			return $this->_json_response(array(), 666, 'WRONG PASSWORD');
		}
		
		$edit = $this->admin_model->edit_password($admin_id, $new_password);
		return $this->_json_response(array());
	}
}
<?php
class Login extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
	}
	
	public function index() {
		$this->load->helper('url');
		$this->load->view('admin/login.php');
	}
	
	public function login_operation() {
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		
		if($this->_isempty($email, $password)) {
			return $this->_json_response(array(), 777, 'Params cannot be empty');
		}
		
		$admin = $this->admin_model->get_admin($email, $password);
		
		if(empty($admin)) {
			return $this->_json_response(array(), 777, 'NOT EXIT');
		}
		
		$admin_data = array(
					'admin_id' => $admin->admin_id,
					'admin_name' => $admin->admin_name,
					'admin_auth' => 'BACKSTAGE_OK'
					);
		$this->session->set_userdata($admin_data);
		
		return $this->_json_response(array());
	}
	
	public function logout_operation() {
		$admin_data = array(
					'admin_id' => '',
					'admin_name' => '',
					'admin_auth' => ''
					);
		$this->session->unset_userdata($admin_data);
		return $this->_json_response(array());
	}
}
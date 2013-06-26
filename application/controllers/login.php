<?php
/**
 * 
 * @author belief
 *
 */
class Login extends Front_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}
	
	public function index()
	{
		$this->load->view('account/login/login_head.php');
		$this->load->view('account/login/login_content.php');
		$this->load->view('account/login/login_trail.php');
	}
	
	public function dologin()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		if ($this->_isempty($email, $password))
			return $this->_json_response(array(), 777, 'params cannot be empty');
		
		$this->load->model('customer_model');
		$customer = $this->customer_model->get($email, $password);
		if(empty($customer))
			return $this->_json_response(array(), 777, 'not exist');
		
		$this->session->set_userdata(
				array(
						'customer_id' => $customer->customer_id,
						'customer_name' => ($customer->customer_name == NULL ? $customer->customer_email : $customer->customer_name),
						'auth' => 'FRONT_OK',
						'monetary' => 'CN'
				)
		);
		$this->load->library('cart');
		if (!$this->cart->load_cart($customer->customer_id))
			return $this->_json_response(array(), '777', 'detail error');
		return $this->_json_response(array());
	}
	
	public function logout()
	{
		$this->session->unset_userdata(
			array('customer_id' => '', 'customer_name' => '','auth' => '')
		);
		return $this->_json_response(array());
	}
	
	public function is_login()
	{
		return $this->_json_response(array('login' => parent::is_login()));
	}
	
}
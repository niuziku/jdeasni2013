<?php
class Register extends Front_Controller
{
	const RE_EMAIL = '/^[A-Za-z0-9+]+[A-Za-z0-9\.\_\-+]*@([A-Za-z0-9\-]+\.)+[A-Za-z0-9]+$/';
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->view('');
	}
	
	public function regist()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$password_conf = $this->input->post('password_conf');
		
		if ($this->_isempty($email, $password, $password_conf))
			return $this->_json_response(array(), 777, 'params cannot be empty');
		if (preg_match(self::RE_EMAIL, $email) != 1)
			return $this->_json_response(array(), 777, 'email invalid');
		if (strlen($password) > 16 || strlen($password) < 8)
			return $this->_json_response(array(), 777, 'password invalid');
		if ($password != $password_conf)
			return $this->_json_response(array(), 777, 'password differ from password_conf');
		
		$this->load->model('customer_model');
		if ($this->customer_model->get_by_email($email) != NULL)
			return $this->_json_response(array(), 777, 'customer exit');
		if ($this->customer_model->add($email, $password) == -1)
			return $this->_json_response(array(), 777, '');
		return $this->_json_response(array());
	}
}
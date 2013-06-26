<?php
/**
 * 
 * @author belief
 *
 */
class Customer extends Front_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	

	public function address()
	{
		$this->load->helper('url');
		if ($this->is_login())
		{
			$this->load->view('cart/cart_address_havelogin/cart_address_havelogin_head');
			$this->load->view('header');
			$this->load->view('cart/cart_address_havelogin/cart_address_havelogin_content');
			$this->load->view('footer');
			$this->load->view('cart/cart_address_havelogin/cart_address_havelogin_trail');
		}
		else
		{
			$this->load->view('cart/cart_address/cart_address_head');
			$this->load->view('header');
			$this->load->view('cart/cart_address/cart_address_content');
			$this->load->view('footer');
			$this->load->view('cart/cart_address/cart_address_trail');
		}
		
	}
	
	public function change_password()
	{
		$customer_id = $this->session->userdata('customer_id');
		if (!$customer_id)
			return $this->_json_response(array(), 777, 'has not logined');
		
		$password_original = $this->input->post('password_original');
		$password_new = $this->input->post('password_new');
		$password_conf = $this->input->post('password_conf');
		
		if ($this->_isempty($password_original, $password_new, $password_conf))
			return $this->_json_response(array(), 777, 'param empty');
		if ($password_new != $password_conf)
			return $this->_json_response(array(), 777, 'password confirm diff');
		if (strlen($password_new) < 8 || strlen($password_new) > 16)
			return $this->_json_response(array(), 777, 'new password invalid');
		$this->load->model('customer_model');
		$customer = $this->customer_model->get_by_id($customer_id);
		if ($customer == NULL || $customer->customer_password != sha1($password_original))
			return $this->_json_response(array(), 777, 'password wrong');
		if ($password_new == $password_original)
			return $this->_json_response(array(), 0, 'OK');
		
		$config = array(
				'customer_password' => $password_new	
				);
		if (!$this->customer_model->update_customer($customer_id, $config))
			return $this->_json_response(array(), 777, 'failed');
		return $this->_json_response(array(), 0, 'OK'); 
		
		
	}
	
}
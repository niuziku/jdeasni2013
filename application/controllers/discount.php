<?php
class Discount extends Front_Controller
{
	public function __construct(){
		parent::__construct();
	}
	
	public function get()
	{
		$discount_code = $this->input->get('discount_code');
		if(empty($discount_code) || strlen($discount_code) != 8)
		{
			return $this->_json_response(array(), '777', 'param error');
		}
		if($this->is_login())
			return $this->get_with_login($discount_code);
		else
			return $this->get_with_unlogin($discount_code);
		 
	}
	
	public function get_with_login($discount_code)
	{
		$customer_id = $this->session->userdata('customer_id');
		$this->load->model('discount_model');
		
		//是否全站优惠劵
		$discount = $this->discount_model->get_global_by_code($discount_code);
		if ($discount != null)
			return $this->_json_response(array('minus_price' => $discount->minus_price));
		
		//个人优惠劵
		$discounts = $this->discount_model->get_personal_by_customer_id($customer_id);
		if($discounts == null)
			return $this->_json_response(array(), '777', 'discount NOT EXIST');
		$minus_price = -1;
		foreach ($discounts as $discount)
		{
			if ($discount->discount_code == $discount_code)
			{
				$minus_price = $discount->minus_price;
				break;	
			}
		}
		if ($minus_price == -1)
			return $this->_json_response(array(), '777', 'discount NOT EXIST');
		return  $this->_json_response(array('minus_price' => $minus_price));
	}
	
	public function get_with_unlogin($discount_code)
	{
		$this->load->model('discount_model');
		$discount = $this->discount_model->get_global_by_code($discount_code);
		if($discount == null)
			return $this->_json_response(array(), '777', 'discount NOT EXIST');
		return $this->_json_response(array('minus_price' => $discount->minus_price));
	}
}
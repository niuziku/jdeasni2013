<?php
class Receiver extends Front_Controller
{
	var $customer_id;
	public function __construct()
	{
		parent::__construct();

		$this->customer_id = $this->session->userdata('customer_id');
		if(!$this->customer_id)
			return $this->_json_response(array(), 777, 'has not login');
	}
	
	public function add()
	{	
		$name = trim($this->input->get('name'));
		$area = trim($this->input->get('area'));
		$address = trim($this->input->get('address'));
		$phone = trim($this->input->get('phone'));
		$is_default = intval($this->input->get('is_default'));
		
		if ($this->_isempty($name, $area, $address, $phone, $is_default))
			return $this->_json_response(array(), 777, 'param empty');
		if ($is_default != 0 && $is_default != 1)
			return $this->_json_response(array(), 777, 'param error');
		
		$this->load->model('receiver_model');
		if ($is_default == 1)
			$this->receiver_model->reset_default($this->customer_id);
		
		//检查收货人是否已存在
		$receivers = $this->receiver_model->get_all($this->customer_id);
		
		$receiver_id = 0;
		$receiver_exist = FALSE;
		foreach ($receivers as $receiver)
		{
			if ($receiver->receiver_name == $name && $receiver->receiver_area == $area
					&& $receiver->receiver_address == $address && $receiver->receiver_phone == $phone
					&& $receiver->customer_id == $this->customer_id)
			{
				$receiver_exist = TRUE;
				$receiver_id = $receiver->receiver_id;
				break;
			}
		}
		//不存在的话，添加到数据库
		if($receiver_exist == FALSE)
		{
			$receiver_id = $this->receiver_model->add($this->customer_id, $name, $area, $address, $phone, $is_default);
			if ($receiver_id == -1)
				return $this->_json_response(array(), '777', 'db failed');
		}
		else 
		{
			$this->receiver_model->update($receiver_id, array('is_default' => $is_default));
		}
		return $this->_json_response(array('receiver_id' => $receiver_id));
	}
	
	public function get_all()
	{
		$this->load->model('receiver_model');
		$receivers = $this->receiver_model->get_all($this->customer_id);
		return $this->_json_response(array('receivers' => $receivers));
	}
	
	public function modify()
	{
		$receiver_id = intval($this->input->get('receiver_id'));
		$this->load->model('receiver_model');
		$receiver = $this->receiver_model->get($receiver_id);
		if ($receiver == NULL || $receiver->customer_id != $this->customer_id)
			return $this->_json_response(array(), 777, 'receiver error');
		
		$name = $this->input->get('name');
		$area = $this->input->get('area');
		$address = $this->input->get('address');
		$phone = $this->input->get('phone');
		$is_default = $this->input->get('is_default');
		
		if ($this->_isempty($name, $area, $address, $phone, $is_default))
			return $this->_json_response(array(), 777, 'param empty');
		if ($is_default != 0 && $is_default != 1)
			return $this->_json_response(array(), 777, 'param error');
		if ($name == $receiver->receiver_name && $area == $receiver->receiver_area &&
				$address == $receiver->receiver_address && $phone == $receiver->receiver_phone && 
				$is_default == $receiver->is_default)
			return $this->_json_response(array(), 0, 'OK, NOT CHANGE');
		
		if ($is_default == 1 && $receiver->is_default == 0)
			$this->receiver_model->reset_default($this->customer_id);
		
		$config = array(
					'receiver_name' => $name,
					'receiver_area' => $area,
					'receiver_address' => $address,
					'receiver_phone' => $phone,
					'is_default' => $is_default
				);
		if (!$this->receiver_model->update($receiver_id, $config))
			return $this->_json_response(array(), 777, 'db error');
		return $this->_json_response(array());
		
	}
	
	public function set_default()
	{
		$receiver_id = intval($this->input->get('receiver_id'));
		$this->load->model('receiver_model');
		$this->receiver_model->reset_default($this->customer_id);
		$this->receiver_model->set_default($this->customer_id, $receiver_id);
		return $this->_json_response(array());
	}
	
	public function del()
	{
		$receiver_id = intval($this->input->get('receiver_id'));
		$this->load->model('receiver_model');
		$this->receiver_model->del($receiver_id);
		return $this->_json_response(array());
	}
}
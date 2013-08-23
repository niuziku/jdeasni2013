<?php
class Size extends Front_Controller{
	
	var $customer_id;
	public function __construct()
	{
		parent::__construct();
	
		$this->customer_id = $this->session->userdata('customer_id');
		if(!$this->customer_id)
			return $this->_json_response(array(), 777, 'has not login');
	}
	
	public function index(){
		$this->load->helper('url');
		$this->load->view('account/size/size_head');
		$this->load->view('header');
		$this->load->view('account/size/size_content');
		$this->load->view('footer');
		$this->load->view('account/size/size_trail');
	}
	
	public function get(){
		$this->load->model("measure_model");
		$measures = $this->measure_model->get_by_customer_id($this->customer_id);
		return $this->_json_response(array("measures"=>$measures));
	}
	
	public function set_default(){
		$measure_id = intval($this->input->get('measure_id'));
		$this->load->model('measure_model');
		$this->measure_model->reset_default($this->customer_id);
		$this->measure_model->set_default($this->customer_id, $measure_id);
		return $this->_json_response(array());
	}
	
	public function del_measure(){
		$measure_id = intval($this->input->get('measure_id'));
		$this->load->model('measure_model');
		$this->measure_model->del($measure_id);
		return $this->_json_response(array());
	}
}
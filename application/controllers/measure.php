<?php
class Measure extends Front_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->is_login())
			return $this->_json_response(array(), 777, 'has not logined');
	}
	
	public function get()
	{
		$customer_id = $this->session->userdata('customer_id');
		$this->load->model('measure_model');
		$measures = $this->measure_model->get_by_customer_id($customer_id);
		return $this->_json_response($measures);
	}
	
	//未测试
	public function add()
	{
		$measure = $this->_get_measure();
		
		//判断
		if ( $measure->measure_yaowei <= 0 || $measure->measure_shengao <= 0 || $measure->measure_tizhong <= 0 || 
				$measure->measure_kuchang <= 0 || $measure->measure_datui <=0 || $measure->measure_jiaowei <= 0 ||
				$measure->measure_qiandang <= 0 || $measure->measure_tunwei <=0  || $measure->measure_xigai <=0  || 
				$measure->measure_houdang <=0 )
		{
			return $this->_json_response(array(), 777, 'param error');
		}	
		$customer_id = $this->session->userdata('customer_id');
		
		//添加measure，并要保证不重复
		$this->load->model('measure_model');
		$measures = $this->measure_model->get_by_customer_id($customer_id);
		
		$this->load->library('cart');
		if ($this->cart->in_array_measure($measure, $measures))
			return $this->_json_response(array(), 0, 'measure exist');
		
		$measure->customer_id = $customer_id;
		if ($this->measure_model->add($measure) == -1)
			return $this->_json_response(array(), 777, 'db error');
		return $this->_json_response(array());
		
	}
	
	private function _get_measure()
	{
		$measure = (object)array();
		$measure->measure_yaowei = intval($this->input->get('yaowei'));
		$measure->measure_shengao = intval($this->input->get('shengao'));
		$measure->measure_tizhong = intval($this->input->get('tizhong'));
		$measure->measure_kuchang = intval($this->input->get('kuchang'));
		$measure->measure_datui = intval($this->input->get('datui'));
		$measure->measure_jiaowei = intval($this->input->get('jiaowei'));
		$measure->measure_qiandang = intval($this->input->get('qiandang'));
		$measure->measure_tunwei = intval($this->input->get('tunwei'));
		$measure->measure_xigai = intval($this->input->get('xigai'));
		$measure->measure_houdang = intval($this->input->get('houdang'));
		return $measure;
	}
}
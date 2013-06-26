<?php
/**
 * 所有控制器共同操作
 */
abstract class IJ_Controller extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}
	
	public function __destruct()
	{
		$this->db->close();
	}
	
	/**
	 * 对多个变量进行isset判断
	 * @return boolean
	 */
	protected function _isempty()
	{
		$args = func_num_args();
		$argv = func_get_args();
		for($i = 0; $i < $args; ++$i)
		{
			/*
			if (empty($argv[$i]))
				return TRUE;
				*/
			if ($argv[$i] === FALSE)
				return TRUE;
		}	
		return FALSE;
	}
	
	/**
	 * 生成json串返回前端
	 * @param array $data 主要数据
	 * @param int $code 错误码
	 * @param string $message 错误信息
	 */
	protected function _json_response($data, $code = 0, $message = NULL)
	{
		$response = array('data' => $data, 'code' => $code);
		if ($message != NULL)
			$response['message'] = $message;
		echo json_encode($response);
	}
	
	abstract protected function is_login();
}

/**
 *所有顾客页面控制器（前端控制器）都应该继承改控制器
 *用于前端控制器共有操作
 */
abstract class Front_Controller extends IJ_Controller{
	
	var $monetary_exchange_rate = 1;
	var $language = 'CN';
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('language');
		
		if ($this->session->userdata('monetary') === 'US')
			$this->monetary_exchange_rate = $this->config->item('US_rate');
		$this->load_language();
			
	}
	
	protected  function is_login(){
		return $this->session->userdata('auth') == 'FRONT_OK';
	}
	
	/**
	 * 
	 * @param array[object] $item something that want to exchange rate
	 * @param array[string] $name the attribute that valid to be exchanged
	 */
	protected function monetary_exchange($items, $names)
	{
		foreach ($items as $item)
			foreach ($names as $name)
				$item->$name *= $this->monetary_exchange_rate;
	}
	
	protected function need_rate_exchange()
	{
		return $this->session->userdata('monetary') !== 'CN';
	}
	
	protected function load_language()
	{
		$this->language = $this->session->userdata('language') === FALSE ? 'US' : $this->session->userdata('language');
		$lang = $this->language == 'CN' ? 'chinese' : 'english';
		$this->config->set_item('language', $lang);
		$this->lang->load('login', $lang);
	}
}

/**
 * 所有后台管理控制器都应该继承该控制器
 * 用于后台管理控制器共有操作
 */
abstract class Admin_Controller extends IJ_Controller{
	
	public function __construct(){
		parent::__construct();
	}
	
	protected function is_login(){
		return $this->session->userdata('admin_auth') == 'BACKSTAGE_OK';
	}
}

/* End */
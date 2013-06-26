<?php
class Foreign extends Front_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function set_monetary()
	{
		$monetary = $this->input->get('monetary');
		if($monetary != 'CN' && $monetary != 'US')
			return $this->_json_response(array(), 777, 'monetary not exist');
		$this->session->set_userdata('monetary', $monetary);
		return $this->_json_response(array());
	}
	
	public function set_language()
	{
		$language = $this->input->get('language');
		if($language != 'CN' && $language != 'US')
			return $this->_json_response(array(), 777, 'language not exist');
		$this->session->set_userdata('language', $language);
		return $this->_json_response(array());
	}
}
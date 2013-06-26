<?php
class Item_detail extends Front_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_by_item_type()
	{
		$item_type = intval($this->input->get('item_type'));
		$this->load->model('item_detail_model');
		$details = $this->item_detail_model->get_by_item_type($item_type);
		return $this->_json_response(array('details' => $details)); 
	}
}
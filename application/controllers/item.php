<?php
class Item extends Front_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function washed_item_list()
	{
		$this->load->helper('url');
		$this->load->view('washed/washed_item_list/washed_item_list_head.php');
		$this->load->view('header.php');
		$this->load->view('washed/washed_item_list/washed_item_list_content.php');
		$this->load->view('footer.php');
		$this->load->view('washed/washed_item_list/washed_item_list_trail.php');
	}
	
	public function selvedge_item_list()
	{
		$this->load->helper('url');
		$this->load->view('selvedge/selvedge_item_list/selvedge_item_list_head.php');
		$this->load->view('header.php');
		$this->load->view('selvedge/selvedge_item_list/selvedge_item_list_content.php');
		$this->load->view('footer.php');
		$this->load->view('selvedge/selvedge_item_list/selvedge_item_list_trail.php');
	}
	
	public function casual_item_list()
	{
		$this->load->helper('url');
		$this->load->view('casual/casual_item_list/casual_item_list_head.php');
		$this->load->view('header.php');
		$this->load->view('casual/casual_item_list/casual_item_list_content.php');
		$this->load->view('footer.php');
		$this->load->view('casual/casual_item_list/casual_item_list_trail.php');
	}
	
	public function washed_item(){
		$this->load->helper('url');
		$this->load->view('washed/washed_item/washed_item_head.php');
		$this->load->view('header.php');
		$this->load->view('washed/washed_item/washed_item_content.php');
		$this->load->view('footer.php');
		$this->load->view('washed/washed_item/washed_item_trail.php');
	}
	
	public function selvedge_item(){
		$this->load->helper('url');
		$this->load->view('selvedge/selvedge_item/selvedge_item_head.php');
		$this->load->view('header.php');
		$this->load->view('selvedge/selvedge_item/selvedge_item_content.php');
		$this->load->view('footer.php');
		$this->load->view('selvedge/selvedge_item/selvedge_item_trail.php');
	}
	
	public function casual_item(){
		
	}

	//如果start = -1,返回全部
	public function get_items_by_type()
	{
		$item_type = intval($this->input->get('item_type'));
		$start = intval($this->input->get('start'));
		$num = intval($this->input->get('num'));
		
		if($start < 0)
		{
			$start = NULL;
			$num = NULL;
		}
		else
		{
			$start = $start >= 0 ? $start : 0;
			$num = $num > 0 ? $num : 10;
		}
		
		$this->load->model('item_model');
		$items = $this->item_model->get_by_type($item_type, $start, $num);
		//分割图片
		$this->_splite_photos($items);

		//货币转换
		if ($this->need_rate_exchange())
			$this->monetary_exchange($items, array('item_price'));
		return $this->_json_response($items);
	}

	public function get_items_num_by_type()
	{
		$item_type = intval($this->input->get('item_type'));
		$this->load->model('item_model');
		$num = $this->item_model->get_num_by_type($item_type);
		return $this->_json_response(array('items_num' => $num));
	}
	
	//如果start = -1,返回全部
	public function get_popular_items()
	{
		$start = intval($this->input->get('start'));
		$length = intval($this->input->get('length'));
		if($start < 0)
		{
			$start = NULL;
			$length = NULL;
		}
		else 
		{
			$start = $start >= 0 ? $start : 0;
			$length = $length > 0 ? $length : 10;
		}
		
		
		$this->load->model('item_model');
		$items = $this->item_model->get_popular_items($start, $length);
		
		$this->_splite_photos($items);
		
		//货币转换
		if ($this->need_rate_exchange())
			$this->monetary_exchange($items, array('item_price'));
			
		return $this->_json_response(array('items'=>$items));
	}
	
	public function get_item_by_id()
	{
		$item_id = intval($this->input->get('item_id'));
		$this->load->model('item_model');
		$item = $this->item_model->get_item_by_id($item_id);
		if($item == NULL)
			return $this->_json_response(array(), 777, 'NOT EXIST');
		
		$this->_splite_photos(array($item));
		return $this->_json_response(array('item'=>$item));
	}
	
	private function _splite_photos($items)
	{
		if (!is_array($items))
			return;
		foreach ($items as $item)
		{
			$item->item_photos = explode('|', $item->item_photo);
			$item->item_small_photos = explode('|', $item->item_small_photo);
			unset($item->item_photo);
			unset($item->item_small_photo);
		}
	}
}

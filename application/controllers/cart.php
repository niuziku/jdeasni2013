<?php
class Cart extends Front_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
	}
	
	public function test()
	{
		/*$a = NULL;
		$b = (object)array();
		$b->c = $a;
		print_r(null === null);
		$b =  'tt'.'|'.$a.'|'.'ss';
		$c = explode('|', $b);
		print_r($c);*/
		echo intval('ss');
	}
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('cart/cart/cart_head.php');
		$this->load->view('header.php');
		$this->load->view('cart/cart/cart_content.php');
		$this->load->view('footer.php');
		$this->load->view('cart/cart/cart_trail.php');
	}
	
	public function get()
	{
		$cart = array();
		$cart = $this->is_login() ? $this->_get_login() : $this->_get_unlogin();
		$detail_ids = array();
		foreach ($cart as $cart_item)
			foreach ($cart_item['detail'] as $detail_id)
				if (!empty($detail_id) && intval($detail_id) > 0){
					array_push($detail_ids, $detail_id);
		}
		$this->load->model('item_detail_model');
		$details_temp = $this->item_detail_model->get_details($detail_ids);
		
		$details = array();
		foreach ($details_temp as $detail)
			$details[$detail->detail_id] = $detail;
		
		foreach ($cart as &$cart_item)
		{
			$cart_item['markup'] = 0;
			foreach ($cart_item['detail'] as $key => &$detail)
			{
				if (!empty($detail) && intval($detail) > 0 && $key != 'item_id')
				{
					$detail = $details[$detail];
					$cart_item['markup'] += $detail->detail_attach_price;
				}
			}
		}
		
		
		return $this->_json_response(array('cart'=>$cart));
	}
	
	private function _get_unlogin()
	{
		$this->load->helper('cookie');
		$cart = get_cookie('cart');
		$cart = $this->cart->deserialize($cart);
		return $cart;
	}
	
	private function _get_login()
	{
		$customer_id = $this->session->userdata('customer_id');
		$this->load->model('cart_item_model');
		$cart_items = $this->cart_item_model->get_by_customer_id($customer_id);

		$this->load->model('measure_model');
		$measures = $this->measure_model->get_by_customer_id($customer_id);
		
		$cart_measures = array();
		foreach ($measures as $measure)
		{
			$cart_measures[$measure->measure_id] = $measure;
		}
		
		$cart = array();
		foreach ($cart_items as $cart_item)
		{
			$item = array();
			
			$item['count'] = $cart_item->single_item_count;
			
			$item['detail'] = (object)array();
			$item['detail']->item_id = $cart_item->item_id;
			$item['detail']->single_item_thickness = $cart_item->single_item_thickness;
			$item['detail']->single_item_color = $cart_item->single_item_color;
			$item['detail']->single_item_metal = $cart_item->single_item_metal;
			$item['detail']->single_item_linecolor = $cart_item->single_item_linecolor;
			$item['detail']->single_item_plate = $cart_item->single_item_plate;
			$item['detail']->single_item_fastener = $cart_item->single_item_fastener;
			$item['detail']->single_item_placket = $cart_item->single_item_placket;
			$item['detail']->single_item_trouserstype = $cart_item->single_item_trouserstype;
			$item['detail']->single_item_backbag = $cart_item->single_item_backbag;
			$item['detail']->single_item_alternative1 = $cart_item->single_item_alternative1;
			$item['detail']->single_item_alternative2 = $cart_item->single_item_alternative2;
			$item['detail']->single_item_alternative3 = $cart_item->single_item_alternative3;
			$item['detail']->single_item_alternative4 = $cart_item->single_item_alternative4;
			$item['detail']->single_item_alternative5 = $cart_item->single_item_alternative5;
			$item['detail']->single_item_alternative6 = $cart_item->single_item_alternative6;
			$item['detail']->single_item_alternative7 = $cart_item->single_item_alternative7;
			
			$item['measure'] = (object)array();
			$item['measure']->measure_yaowei = $cart_measures[$cart_item->measure_id]->measure_yaowei;
			$item['measure']->measure_shengao = $cart_measures[$cart_item->measure_id]->measure_shengao;
			$item['measure']->measure_tizhong = $cart_measures[$cart_item->measure_id]->measure_tizhong;
			$item['measure']->measure_kuchang = $cart_measures[$cart_item->measure_id]->measure_kuchang;
			$item['measure']->measure_datui = $cart_measures[$cart_item->measure_id]->measure_datui;
			$item['measure']->measure_jiaowei = $cart_measures[$cart_item->measure_id]->measure_jiaowei;
			$item['measure']->measure_qiandang = $cart_measures[$cart_item->measure_id]->measure_qiandang;
			$item['measure']->measure_tunwei = $cart_measures[$cart_item->measure_id]->measure_tunwei;
			$item['measure']->measure_xigai = $cart_measures[$cart_item->measure_id]->measure_xigai;
			$item['measure']->measure_houdang = $cart_measures[$cart_item->measure_id]->measure_houdang;
			
			array_push($cart, $item);
			
		}
		return $cart;
		
	}
	
	private function _add_item_login($new_item)
	{
		$customer_id = $this->session->userdata('customer_id');
		if(!$this->cart->add_into_db(array($new_item), $customer_id))
			return $this->_json_response(array(), '777', 'detail error');
		return $this->_json_response(array());
	}
	
	private function _add_item_unlogin($new_item)
	{
		//到cookie
		$this->load->helper('cookie');
		$cart = get_cookie('cart');
		$cart = $this->cart->deserialize($cart);
		//可能加到购物车的东西已经存在在购物车了，如果东西的其他参数跟购物车中的相同，增加其数量，否则添加到购物车
		$diff = TRUE;
		
		foreach ($cart as &$item)
		{
			if ($item['detail'] == $new_item['detail'] && $item['measure'] == $new_item['measure'])
			{
				$item['count'] += $new_item['count'];
				$diff = FALSE;
				break;
			}
		}
		if ($diff)
		{
			array_push($cart, $new_item);
		}
		$cart = $this->cart->serialize($cart);
		set_cookie('cart', $cart, 3*24*60*60);
		return $this->_json_response(array());
	}
	
	private function _del_item_login($new_item)
	{
		$customer_id = $this->session->userdata('customer_id');
		
		$this->load->model('cart_model');
		$cart = $this->cart_model->get_unpaid($customer_id);
		if ($cart == NULL)
			return $this->_json_response(array(), 777, 'cart is empty');
		$new_item['detail']->cart_id = $cart->cart_id;
		
		$this->load->model('measure_model');
		$measures = $this->measure_model->get_by_customer_id($customer_id);
		$mid = $this->cart->get_id_of_measure($new_item['measure'], $measures);
		$new_item['detail']->measure_id = $mid;
		
		$item_id = -1;
		$this->load->model('cart_item_model');
		$items = $this->cart_item_model->get_by_cart_id($cart->cart_id);
		$single_item = $this->cart->in_array_item($new_item['detail'], $items);
		if ($single_item == null)
			return $this->_json_response(array(), 777, 'item not exist');
		
		if($single_item->single_item_count <= $new_item['count'])
			$this->cart_item_model->del($single_item->single_item_id);
		else 
			$this->cart_item_model->update_count(-$new_item['count'], $single_item->single_item_id);
		return $this->_json_response(array());
	}
	
	private function _del_item_unlogin($new_item)
	{
		//到cookie
		$this->load->helper('cookie');
		$cart = get_cookie('cart');
		$cart = $this->cart->deserialize($cart);
		foreach ($cart as $key => &$item)
		{
			if ($item['detail'] == $new_item['detail'] && $item['measure'] == $new_item['measure'])
			{
				if ($new_item['count'] >= 0 && $new_item['count'] < $item['count'])
					$item['count'] -= $new_item['count'];
				else
					array_splice($cart, $key, 1);
				break;	
			}
		}
		$cart = $this->cart->serialize($cart);
		set_cookie('cart', $cart, 3*24*60*60);
		return $this->_json_response(array());
	}
	
	//未測試
	public function add_item()
	{
		$detail = $this->_get_detail();
		$measure = $this->_get_measure();
		$count = intval($this->input->get('count'));
		
		//判断
		if ($detail->item_id <= 0 || $count  <= 0 || $measure->measure_yaowei < 0 
				|| $measure->measure_shengao < 0 || $measure->measure_tizhong < 0 || $measure->measure_kuchang < 0 || $measure->measure_datui <0
				|| $measure->measure_jiaowei < 0 || $measure->measure_qiandang < 0 || $measure->measure_houdang < 0 || $measure->measure_tunwei < 0
				|| $measure->measure_xigai < 0)
		{
			return $this->_json_response(array(), 777, 'param error');
		}
		//item_id是否存在
		$this->load->model('item_model');
		$item_object_ids = $this->item_model->get_item_ids();
		$item_ids = array();
		foreach($item_object_ids as $item_object_id){
			array_push($item_ids, $item_object_id->item_id);
		}
		if (!in_array($detail->item_id, $item_ids))
		{
			return $this->_json_response(array(), 777, 'item invalid');
		}
		
		$new_item = array(
					'detail' => $detail,
					'measure' => $measure,
					'count' => $count
				);
		
		//是否登录
		if ($this->session->userdata('auth') == 'FRONT_OK')
			return $this->_add_item_login($new_item);
		else
			return $this->_add_item_unlogin($new_item);
	}
	
	//如果count<0,删除该item
	public function del_item()
	{
		$detail = $this->_get_detail();
		$measure = $this->_get_measure();
		$count = intval($this->input->get('count'));
		
		//判断
		if ($detail->item_id <= 0 || $measure->measure_yaowei < 0
				|| $measure->measure_shengao < 0 || $measure->measure_tizhong < 0 || $measure->measure_kuchang < 0 || $measure->measure_datui < 0
				|| $measure->measure_jiaowei < 0 || $measure->measure_qiandang < 0 || $measure->measure_houdang < 0 || $measure->measure_tunwei < 0
				|| $measure->measure_xigai < 0)
		{
			return $this->_json_response(array(), 777, 'param error');
		}
		//item_id是否存在
		$this->load->model('item_model');
		
		$item_object_ids = $this->item_model->get_item_ids();
		$item_ids = array();
		foreach($item_object_ids as $item_object_id){
			array_push($item_ids, $item_object_id->item_id);
		}
		if (!in_array($detail->item_id, $item_ids))
		{
			return $this->_json_response(array(), 777, 'item invalid');
		}
		
		$new_item = array(
				'detail' => $detail,
				'measure' => $measure,
				'count' => $count
		);
		
		//是否登录
		if ($this->session->userdata('auth') == 'FRONT_OK')
			return $this->_del_item_login($new_item);
		else
			return $this->_del_item_unlogin($new_item);
	}
	
	public function destroy_cart()
	{
		$this->load->helper('cookie');
		delete_cookie('cart');
		return $this->_json_response(array());
	}
	
	private function _get_detail()
	{
		$detail = (object)array();
		$detail->item_id = intval($this->input->get('item_id'));
		$thickness = $this->input->get('thickness');
		$color = $this->input->get('color');
		$metal = $this->input->get('metal');
		$linecolor = $this->input->get('linecolor'); 
		$plate = $this->input->get('plate');
		$fastener = $this->input->get('fastener'); 
		$placket = $this->input->get('placket');
		$trouserstype = $this->input->get('trouserstype'); 
		$backbag = $this->input->get('backbag');
		$alternative1 = $this->input->get('alternative1'); 
		$alternative2 = $this->input->get('alternative2');
		$alternative3 = $this->input->get('alternative3');
		$alternative4 = $this->input->get('alternative4');
		$alternative5 = $this->input->get('alternative5');
		$alternative6 = $this->input->get('alternative6');
		$alternative7 = $this->input->get('alternative7');
		
		$detail->single_item_thickness = (empty($thickness) || intval($thickness) <= 0 ? NULL : intval($thickness));
		$detail->single_item_color = (empty($color) || intval($color) <= 0 ? NULL : intval($color));
		$detail->single_item_metal = (empty($metal) || intval($metal) <= 0 ? NULL : intval($metal));
		$detail->single_item_linecolor = (empty($linecolor) || intval($linecolor) <= 0 ? NULL : intval($linecolor));
		$detail->single_item_plate = (empty($plate) || intval($plate) <= 0 ? NULL : intval($plate));
		$detail->single_item_fastener = (empty($fastener) || intval($fastener) <= 0 ? NULL : intval($fastener));
		$detail->single_item_placket = (empty($placket) || intval($placket) <= 0 ? NULL : intval($placket));
		$detail->single_item_trouserstype = (empty($trouserstype) || intval($trouserstype) <= 0 ? NULL : intval($trouserstype));
		$detail->single_item_backbag = (empty($backbag) || intval($backbag) <= 0 ? NULL : intval($backbag));
		
		$detail->single_item_alternative1 = (empty($alternative1) || intval($alternative1) <= 0 ? NULL : intval($alternative1));
		$detail->single_item_alternative2 = (empty($alternative2) || intval($alternative2) <= 0 ? NULL : intval($alternative2));
		$detail->single_item_alternative3 = (empty($alternative3) || intval($alternative3) <= 0 ? NULL : intval($alternative3));
		$detail->single_item_alternative4 = (empty($alternative4) || intval($alternative4) <= 0 ? NULL : intval($alternative4));
		$detail->single_item_alternative5 = (empty($alternative5) || intval($alternative5) <= 0 ? NULL : intval($alternative5));
		$detail->single_item_alternative6 = (empty($alternative6) || intval($alternative6) <= 0 ? NULL : intval($alternative6));
		$detail->single_item_alternative7 = (empty($alternative7) || intval($alternative7) <= 0 ? NULL : intval($alternative7));
		
		return $detail;
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

//end
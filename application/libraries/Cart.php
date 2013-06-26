<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * 
 * @author belief
 * 购物车类
 */
class CI_Cart
{
	var $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();
	}
	
	/**
	 * 
	 * @param array $cart
	 * @return string
	 */
	public function serialize($cart)
	{
		$s_cart = '';
		if (!is_array($cart))
			return $s_cart;
		$is_first = TRUE;
		foreach ($cart as $item)
		{
			if ($is_first)
				$is_first = FALSE;
			else
				$s_cart .= ',';
				
			$s_cart .= $item['detail']->item_id.'|'.$item['detail']->single_item_thickness.'|'.$item['detail']->single_item_color.'|'.
					$item['detail']->single_item_metal.'|'.$item['detail']->single_item_linecolor.'|'.$item['detail']->single_item_plate.'|'.
					$item['detail']->single_item_fastener.'|'.$item['detail']->single_item_placket.'|'.$item['detail']->single_item_trouserstype.'|'.
					$item['detail']->single_item_backbag.'|'.$item['detail']->single_item_alternative1.'|'.$item['detail']->single_item_alternative2.'|'.
					$item['detail']->single_item_alternative3.'|'.$item['detail']->single_item_alternative4.'|'.$item['detail']->single_item_alternative5.'|'.
					$item['detail']->single_item_alternative6.'|'.$item['detail']->single_item_alternative7.'|';
					
							
							
			$s_cart .= $item['measure']->measure_yaowei.'|'.$item['measure']->measure_shengao.'|'.$item['measure']->measure_tizhong.'|'.$item['measure']->measure_kuchang.'|'.
					$item['measure']->measure_datui.'|'.$item['measure']->measure_jiaowei.'|'.$item['measure']->measure_qiandang.'|'.$item['measure']->measure_tunwei.'|'.$item['measure']->measure_xigai.'|'.
					$item['measure']->measure_houdang.'|';
			$s_cart .= $item['count'];
		}
		return $s_cart;
	}
	
	/**
	 * 
	 * @param string $s_cart
	 * @return array:
	 */
	public function deserialize($s_cart)
	{
		if (!is_string($s_cart))
			return array();
		$cart = array();
	
		$s_cart = explode(',', $s_cart);
		foreach ($s_cart as $s_item)
		{
			$item = array();
			$item['detail'] = (object)array();
			$item['measure'] = (object)array();
			
			$s_item = explode('|', $s_item);
			$item['detail']->item_id = $s_item[0];
			$item['detail']->single_item_thickness = empty($s_item[1]) ? NULL : $s_item[1];
			$item['detail']->single_item_color = empty($s_item[2]) ? NULL : $s_item[2];
			$item['detail']->single_item_metal = empty($s_item[3]) ? NULL : $s_item[3];
			$item['detail']->single_item_linecolor = empty($s_item[4]) ? NULL : $s_item[4];
			$item['detail']->single_item_plate = empty($s_item[5]) ? NULL : $s_item[5];
			$item['detail']->single_item_fastener = empty($s_item[6]) ? NULL : $s_item[6];
			$item['detail']->single_item_placket = empty($s_item[7]) ? NULL : $s_item[7];
			$item['detail']->single_item_trouserstype = empty($s_item[8]) ? NULL : $s_item[8];
			$item['detail']->single_item_backbag = empty($s_item[9]) ? NULL : $s_item[9];
			
			$item['detail']->single_item_alternative1 = empty($s_item[10]) ? NULL : $s_item[10];
			$item['detail']->single_item_alternative2 = empty($s_item[11]) ? NULL : $s_item[11];
			$item['detail']->single_item_alternative3 = empty($s_item[12]) ? NULL : $s_item[12];
			$item['detail']->single_item_alternative4 = empty($s_item[13]) ? NULL : $s_item[13];
			$item['detail']->single_item_alternative5 = empty($s_item[14]) ? NULL : $s_item[14];
			$item['detail']->single_item_alternative6 = empty($s_item[15]) ? NULL : $s_item[15];
			$item['detail']->single_item_alternative7 = empty($s_item[16]) ? NULL : $s_item[16];
				
			$item['measure']->measure_yaowei = $s_item[17];
			$item['measure']->measure_shengao = $s_item[18];
			$item['measure']->measure_tizhong = $s_item[19];
			$item['measure']->measure_kuchang = $s_item[20];
			$item['measure']->measure_datui = $s_item[21];
			$item['measure']->measure_jiaowei = $s_item[22];
			$item['measure']->measure_qiandang = $s_item[23];
			$item['measure']->measure_tunwei = $s_item[24];
			$item['measure']->measure_xigai = $s_item[25];
			$item['measure']->measure_houdang = $s_item[26];
			$item['count'] = $s_item[27];
			
			array_push($cart, $item);
		}
		return $cart;
	}
	
	//未测试
	//将cookie中的购物车项目移动到数据库
	//1. 数据库已经有的尺寸，会不会重复加入
	public function load_cart($customer_id)
	{
		//获得未登录前保存在cookie中的购物车内的所有商品
		$this->CI->load->helper('cookie');
		$cart = get_cookie('cart');
		if (!$cart)
			return TRUE;
		$cart = $this->deserialize($cart);
	
		if(!$this->add_into_db($cart, $customer_id))
			return FALSE;
	
		//删除cookie中的购物车
		delete_cookie('cart');
		return TRUE;
	}
	
	/**
	 * 将cart数组中加入到数据库
	 * @param array $cart
	 * @param int $customer_id
	 */
	public function add_into_db($new_cart, $customer_id)
	{
		//将cookie购物车内的所有商品加入到数据库
		$this->CI->load->model('cart_model');
		$cart = $this->CI->cart_model->get_unpaid($customer_id);
		$cart_id = -1;
		if ($cart == null)
			$cart_id = $this->CI->cart_model->add($customer_id);
		else
			$cart_id = $cart->cart_id;
		
		//添加measure，并要保证不重复
		$this->CI->load->model('measure_model');
		$measures = $this->CI->measure_model->get_by_customer_id($customer_id);
		foreach ($new_cart as $item)
		{
			$measure = $item['measure'];
			if (!$this->in_array_measure($measure, $measures))
			{
				$measure->customer_id = $customer_id;
				$mid = $this->CI->measure_model->add($measure);
				$measure->measure_id = $mid;
				array_push($measures, $measure);
			}
		}
		//这时候的measures包括用户所有的完整尺码
		
		//增加单项item
		//先获得该条件下的所有items，然后判断下是不是有，有的话就更新数量，没有的话就直接添加到数据库
		$this->CI->load->model('cart_item_model');
		$items = $this->CI->cart_item_model->get_by_customer_id($customer_id);
		foreach ($new_cart as $item)
		{
			$mid = $this->get_id_of_measure($item['measure'], $measures);
			$item['detail']->measure_id = $mid;
			$item['detail']->cart_id = $cart_id;
		}
		foreach ($new_cart as $item)
		{
			//检查detail是否正确，错误则不可以插入到数据库
			if (!$this->_detail_right($item['detail']))
				return FALSE;
		}
		foreach ($new_cart as $item)
		{
			$single_item_id = -1;
			$single_item = $this->in_array_item($item['detail'], $items);
			if ($single_item == null){
				$item['detail']->single_item_count = $item['count'];
				$this->CI->cart_item_model->add($item['detail']);
			}
			else{
				$this->CI->cart_item_model->update_count($item['count'], $single_item->single_item_id);
			}
		}
		return TRUE;
	}
	
	public function in_array_measure($measure, $measures)
	{
		if (!is_array($measures))
			return FALSE;
		foreach ($measures as $meas)
		{
			if ($meas->measure_yaowei == $measure->measure_yaowei && $meas->measure_shengao == $measure->measure_shengao &&
					$meas->measure_tizhong == $measure->measure_tizhong && $meas->measure_kuchang == $measure->measure_kuchang &&
					$meas->measure_datui == $measure->measure_datui && $meas->measure_jiaowei == $measure->measure_jiaowei &&
					$meas->measure_qiandang == $measure->measure_qiandang && $meas->measure_tunwei == $measure->measure_tunwei
					&& $meas->measure_xigai == $measure->measure_xigai && $meas->measure_houdang == $measure->measure_houdang)
				return TRUE;
		}
		return FALSE;
	}
	
	public function in_array_item($item, $items)
	{
		if (!is_array($items))
			return null;
		foreach ($items as $itm)
		{
			if($item->cart_id == $itm->cart_id && $item->item_id == $itm->item_id &&
					$item->single_item_thickness == $itm->single_item_thickness && $item->single_item_color == $itm->single_item_color &&
					$item->single_item_metal == $itm->single_item_metal && $item->single_item_linecolor == $itm->single_item_linecolor &&
					$item->single_item_plate == $itm->single_item_plate && $item->single_item_fastener == $itm->single_item_fastener &&
					$item->single_item_placket == $itm->single_item_placket && $item->single_item_trouserstype == $itm->single_item_trouserstype && 
					$item->single_item_backbag == $itm->single_item_backbag && $item->single_item_alternative1 == $itm->single_item_alternative1 && 
					$item->single_item_alternative2 == $itm->single_item_alternative2 && $item->single_item_alternative3 == $itm->single_item_alternative3 && 
					$item->single_item_alternative4 == $itm->single_item_alternative4 && $item->single_item_alternative6 == $itm->single_item_alternative6 && 
					$item->single_item_alternative5 == $itm->single_item_alternative5 && $item->single_item_alternative7 == $itm->single_item_alternative7&& 
					$item->measure_id == $itm->measure_id)
				return $itm;
		}
		return null;
	}
	
	public  function get_id_of_measure($measure, $measures)
	{
		if (!is_array($measures))
			return -1;
		foreach ($measures as $meas)
		{
			if ($meas->measure_yaowei == $measure->measure_yaowei && $meas->measure_shengao == $measure->measure_shengao &&
					$meas->measure_tizhong == $measure->measure_tizhong && $meas->measure_kuchang == $measure->measure_kuchang &&
					$meas->measure_datui == $measure->measure_datui && $meas->measure_jiaowei == $measure->measure_jiaowei &&
					$meas->measure_qiandang == $measure->measure_qiandang && $meas->measure_tunwei == $measure->measure_tunwei
					&& $meas->measure_xigai == $measure->measure_xigai && $meas->measure_houdang == $measure->measure_houdang)
				return $meas->measure_id;
		}
		return -1;
	}
	

	//判断detail中的detail_id是否与某类型对应
	private function _detail_right($detail)
	{
		$detail_ids = array();
		
		$detail->single_item_thickness == null ? '' : array_push($detail_ids, $detail->single_item_thickness);
		$detail->single_item_color == null ? '' : array_push($detail_ids, $detail->single_item_color);
		$detail->single_item_metal == null ? '' : array_push($detail_ids, $detail->single_item_metal);
		$detail->single_item_linecolor == null ? '' : array_push($detail_ids, $detail->single_item_linecolor);
		$detail->single_item_plate == null ? '' : array_push($detail_ids, $detail->single_item_plate);
		$detail->single_item_fastener == null ? '' : array_push($detail_ids, $detail->single_item_fastener);
		$detail->single_item_placket == null ? '' : array_push($detail_ids, $detail->single_item_placket);
		$detail->single_item_trouserstype == null ? '' : array_push($detail_ids, $detail->single_item_trouserstype);
		$detail->single_item_backbag == null ? '' : array_push($detail_ids, $detail->single_item_backbag);
		$detail->single_item_alternative1 == null ? '' : array_push($detail_ids, $detail->single_item_alternative1);
		$detail->single_item_alternative2 == null ? '' : array_push($detail_ids, $detail->single_item_alternative2);
		$detail->single_item_alternative3 == null ? '' : array_push($detail_ids, $detail->single_item_alternative3);
		$detail->single_item_alternative4 == null ? '' : array_push($detail_ids, $detail->single_item_alternative4);
		$detail->single_item_alternative5 == null ? '' : array_push($detail_ids, $detail->single_item_alternative5);
		$detail->single_item_alternative6 == null ? '' : array_push($detail_ids, $detail->single_item_alternative6);
		$detail->single_item_alternative7 == null ? '' : array_push($detail_ids, $detail->single_item_alternative7);
		
		$this->CI->load->model('item_detail_model');
		$detail_msgs = $this->CI->item_detail_model->get_details($detail_ids);
		$details = array();
		
		foreach($detail_msgs as $detail_msg)
		{
			$details[$detail_msg->detail_id] = $detail_msg; 
		}
		
		if( ($detail->single_item_thickness != NULL && (empty($details[$detail->single_item_thickness]) || $details[$detail->single_item_thickness]->detail_type != 1)) || 
				 ($detail->single_item_color != NULL && (empty($details[$detail->single_item_color]) || $details[$detail->single_item_color]->detail_type != 2)) || 
				 ($detail->single_item_plate != NULL && (empty($details[$detail->single_item_plate]) || $details[$detail->single_item_plate]->detail_type != 3)) || 
				 ($detail->single_item_placket != NULL && (empty($details[$detail->single_item_placket]) || $details[$detail->single_item_placket]->detail_type != 4)) || 
				 ($detail->single_item_fastener != NULL && (empty($details[$detail->single_item_fastener]) || $details[$detail->single_item_fastener]->detail_type != 5)) || 
				 ($detail->single_item_metal != NULL && (empty($details[$detail->single_item_metal]) || $details[$detail->single_item_metal]->detail_type != 6)) || 
				 ($detail->single_item_linecolor != NULL && (empty($details[$detail->single_item_linecolor]) || $details[$detail->single_item_linecolor]->detail_type != 7)) || 
				 ($detail->single_item_trouserstype != NULL && (empty($details[$detail->single_item_trouserstype]) || $details[$detail->single_item_trouserstype]->detail_type != 8)) || 
				 ($detail->single_item_backbag != NULL && (empty($details[$detail->single_item_backbag]) || $details[$detail->single_item_backbag]->detail_type != 9)) || 
				 ($detail->single_item_alternative1 != NULL && (empty($details[$detail->single_item_alternative1]) || $details[$detail->single_item_alternative1]->detail_type != 10)) || 
				 ($detail->single_item_alternative2 != NULL && (empty($details[$detail->single_item_alternative2]) || $details[$detail->single_item_alternative2]->detail_type != 11)) || 
				 ($detail->single_item_alternative3 != NULL && (empty($details[$detail->single_item_alternative3]) || $details[$detail->single_item_alternative3]->detail_type != 12)) || 
				 ($detail->single_item_alternative4 != NULL && (empty($details[$detail->single_item_alternative4]) || $details[$detail->single_item_alternative4]->detail_type != 13)) || 
				 ($detail->single_item_alternative5 != NULL && (empty($details[$detail->single_item_alternative5]) || $details[$detail->single_item_alternative5]->detail_type != 14)) || 
				 ($detail->single_item_alternative6 != NULL && (empty($details[$detail->single_item_alternative6]) || $details[$detail->single_item_alternative6]->detail_type != 15)) ||
				 ($detail->single_item_alternative7 != NULL && (empty($details[$detail->single_item_alternative7]) || $details[$detail->single_item_alternative7]->detail_type != 16)) )
		{
			return FALSE;
		}
		return TRUE;
	}
}
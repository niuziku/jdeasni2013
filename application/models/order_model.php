<?php
class Order_model extends CI_Model
{
	var $max_display;
	
	public function __construct()
	{
		parent::__construct();
		$this->max_display = 10;
	}
	
	public function get($customer_id, $start = NULL, $length = NULL)
	{
		$sql = 'SELECT
					`order_list`.`order_id`,
					`order_list`.`cart_id`,
					`order_list`.`receiver_id`,
					`order_time`,
					`order_sum`,
					`discount`.`minus_price`,
					`order_status`,
					`order_comment`,
					`order_express`,
					`order_express_num`,
					`cart`.`customer_id`,
					`receiver_name`,
					`receiver_area`,
					`receiver_address`,
					`receiver_phone`,
					`is_default`
				FROM 
					`order_list` LEFT JOIN `cart`
				ON 
					`order_list`.`cart_id` = `cart`.`cart_id`
				LEFT JOIN 
					`receiver`
				ON 
					`order_list`.`receiver_id` = `receiver`.`receiver_id`
				LEFT JOIN
					`order_discount`
				ON 
					`order_list`.`order_id` = `order_discount`.`order_id`
				LEFT JOIN
					`discount`
				ON
					`order_discount`.`discount_id` = `discount`.`discount_id`
				WHERE 
					`cart`.`customer_id` = ? AND `cart`.`has_paid` = 1
				ORDER BY 
					`order_time` DESC';
		if ($start !== NULL && $length !== NULL)
			$sql .= ' LIMIT ?, ?';
		$query = $this->db->query($sql, array($customer_id, $start, $length));
		$orders = $query->result();
		if (count($orders) == 0)
			return array();
		
		$cart_ids = array();
		foreach ($orders as $order)
		{
			array_push($cart_ids, $order->cart_id);
		}
		
		$sql = 'SELECT 
					* 
				FROM 
					`cart_single_item` LEFT JOIN `item`
				ON
					`cart_single_item`.`item_id` = `item`.`item_id`
				LEFT JOIN
					`measure`
				ON
					`cart_single_item`.`measure_id` = `measure`.`measure_id`
				WHERE
					`cart_single_item`.`cart_id` IN(';
		$first = TRUE;
		foreach ($cart_ids as $cart_id)
		{
			if ($first == TRUE)
			{
				$first = FALSE;
				$sql .= $cart_id;
			}
			else
			{
				$sql .= ', '.$cart_id;
			}
		}
		$sql .= ')';
		
		$query = $this->db->query($sql);
		$single_items = $query->result();
		$s_single_items = array();
		foreach ($single_items as $single_item)
		{
			$s_single_items[$single_item->cart_id] = array();
		}
		foreach ($single_items as $single_item)
		{
			array_push($s_single_items[$single_item->cart_id], $single_item);
		}
		foreach ($orders as $order)
		{
			$order->single_items = $s_single_items[$order->cart_id];
		}
		return $orders;
	}
	
	public function add($cart_id, $receiver_id, $order_sum, $order_status, 
			$order_feedback, $order_comment, $order_express, $order_express_num)
	{
		$sql = 'INSERT INTO `order_list`(
					`cart_id`,
					`receiver_id`,
					`order_sum`,
					`order_status`,
					`order_feedback`,
					`order_comment`,
					`order_express`,
					`order_express_num`
				)VALUES(?, ?, ?, ?, ?, ?, ?, ?)';
		$param = array($cart_id, $receiver_id, $order_sum, $order_status, 
				$order_feedback, $order_comment, $order_express, $order_express_num);
		$query = $this->db->query($sql, $param);
		if ($this->db->affected_rows() !=  1)
			return -1;
		return $this->db->insert_id();
	}
	
	
	//Modify by Jun
	public function order_list($page_num) {
		$result_offset = ( $page_num - 1 ) * $this->max_display;
		$sql = 'SELECT `order_list`.`order_id`,
						`order_list`.`cart_id`,
						`order_list`.`receiver_id`,
						`order_list`.`order_status`,
						`order_list`.`order_time`,
						`order_list`.`order_sum`,
						`order_list`.`order_express`,
						`order_list`.`order_express_num`,
						`receiver`.`receiver_name`,
						`receiver`.`receiver_phone`
					FROM `order_list`
						INNER JOIN `receiver` ON `order_list`.`receiver_id` = `receiver`.`receiver_id`
					ORDER BY `order_list`.`order_id` DESC
					LIMIT ?, ?';
		$query = $this->db->query($sql, array($result_offset, $this->max_display));
		$result = $query->result();
	
		$cart_id = 0;
		foreach($result as $row) {
			$cart_id = $row->cart_id;
			$sub_sql = 'SELECT `cart_single_item`.`item_id`,
								`item`.`item_name`
						FROM `cart_single_item`
							LEFT JOIN `item` ON `cart_single_item`.`item_id` = `item`.`item_id`
						WHERE `cart_single_item`.`cart_id` = ?';
			$sub_query = $this->db->query($sub_sql, $cart_id);
			$sub_result = $sub_query->result_array();
			$row->item_array = $sub_result;
		}
	
		return $result;
	}
	public function get_single($order_id)
	{
		$sql = 'SELECT * FROM `order_list` WHERE `order_id` = ?';
		$query = $this->db->query($sql, array($order_id));
		if($query->num_rows() != 1)
			return NULL;
		return $query->row();
	}
	//Modify by Jun
	public function single_order($order_id) {
		$sql = 'SELECT `order_list`.`order_id`,
						`order_list`.`cart_id`,
						`order_list`.`receiver_id`,
						`order_time`,
						`order_sum`,
						`order_status`,
						`order_comment`,
						`order_express`,
						`order_express_num`,
						`receiver_name`,
						`receiver_area`,
						`receiver_address`,
						`receiver_phone`,
						`discount`.`minus_price`
					FROM `order_list`
						LEFT JOIN `receiver` ON `order_list`.`receiver_id` = `receiver`.`receiver_id` 
						LEFT JOIN `order_discount` ON `order_list`.`order_id` = `order_discount`.`order_id` 
						LEFT JOIN `discount` ON `order_discount`.`discount_id` = `discount`.`discount_id` 
					WHERE `order_list`.`order_id` = ?';
		$query = $this->db->query($sql, array($order_id));
		$row = $query->row();

		$cart_id = $row->cart_id;
		$sub_sql = 'SELECT *
					FROM `cart_single_item`
						LEFT JOIN `item` ON `cart_single_item`.`item_id` = `item`.`item_id`
						LEFT JOIN `measure` ON `cart_single_item`.`measure_id` = `measure`.`measure_id`
					WHERE `cart_single_item`.`cart_id` = ?';
		$sub_query = $this->db->query($sub_sql, $cart_id);
		$sub_result = $sub_query->result_array();
	
		$detail_name = NULL;
		$detail_attach_price = 0;
		$detail_index = 0;
		$detail_array = array();
		$detail_id_array = array();
		$detail_sub_array = array();
		
		foreach($sub_result as $sub_row) {
			$detail_index = 0;
			$detail_id_array = array();
			$detail_sub_array = array();
			$detail_id_array = array($sub_row['single_item_thickness'], $sub_row['single_item_color'], $sub_row['single_item_metal'], $sub_row['single_item_linecolor'], $sub_row['single_item_plate'], $sub_row['single_item_fastener'], $sub_row['single_item_placket'], $sub_row['single_item_trouserstype'], $sub_row['single_item_backbag']);
			
			foreach($detail_id_array as $single_detail_id) {
				if($single_detail_id == NULL) {
					$detail_name = "无";
					$detail_attach_price = 0;
				}
				else {
					$detail_sql = 'SELECT `detail_name`, `detail_attach_price` FROM `item_detail`
						WHERE `detail_id` = ?';
					$detail_query = $this->db->query($detail_sql, $single_detail_id);
					$detail_row = $detail_query->row();
					$detail_name = $detail_row->detail_name;
					$detail_attach_price = $detail_row->detail_attach_price;
				}
	
				switch($detail_index) {
					case 0: $detail_sub_array['thickness_name'] = $detail_name;
					$detail_sub_array['thickness_price'] = $detail_attach_price;
					break;
					case 1: $detail_sub_array['color_name'] = $detail_name;
					$detail_sub_array['color_price'] = $detail_attach_price;
					break;
					case 2: $detail_sub_array['metal_name'] = $detail_name;
					$detail_sub_array['metal_price'] = $detail_attach_price;
					break;
					case 3: $detail_sub_array['linecolor_name'] = $detail_name;
					$detail_sub_array['linecolor_price'] = $detail_attach_price;
					break;
					case 4: $detail_sub_array['plate_name'] = $detail_name;
					$detail_sub_array['plate_price'] = $detail_attach_price;
					break;
					case 5: $detail_sub_array['fastener_name'] = $detail_name;
					$detail_sub_array['fastener_price'] = $detail_attach_price;
					break;
					case 6: $detail_sub_array['placket_name'] = $detail_name;
					$detail_sub_array['placket_price'] = $detail_attach_price;
					break;
					case 7: $detail_sub_array['trouserstype_name'] = $detail_name;
					$detail_sub_array['trouserstype_price'] = $detail_attach_price;
					break;
					case 8: $detail_sub_array['backbag_name'] = $detail_name;
					$detail_sub_array['backbag_price'] = $detail_attach_price;
					break;
					default : break;
				}
	
				$detail_index++;
			}

			array_push($detail_array, $detail_sub_array);

		}
		$row->item_array = $sub_result;
		$row->detail_array = $detail_array;
		return $row;
	}
	
	//Modify by Jun
	public function change_status($order_id, $status_index) {
		$sql = 'UPDATE `order_list` SET `order_status` = ?
				WHERE `order_id` = ?';
		$this->db->query($sql, array($status_index, $order_id));
		return $this->db->affected_rows() == 1;
	}
	
	//Modify by Jun
	public function upadte_express($order_id, $express, $express_num) {
		$sql = 'UPDATE `order_list` SET `order_express` = ? ,
										`order_express_num` = ?
				WHERE `order_id` = ?';
		$this->db->query($sql, array($express, $express_num, $order_id));
		return $this->db->affected_rows() == 1;
	}
	
	// Modify by Jun
	public function order_amount() {
		$sql = 'SELECT count(*) AS `order_amount` FROM `order_list`';
		$qurey = $this->db->query($sql);
	
		return $qurey->row();
	}
} 
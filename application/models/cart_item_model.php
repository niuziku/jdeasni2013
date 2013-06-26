<?php
class Cart_item_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function add($item_detail)
	{
		$sql = 'INSERT INTO `cart_single_item`(
					`cart_id`, 
					`item_id`, 
					`single_item_thickness`, 
					`single_item_color`, 
					`single_item_metal`, 
					`single_item_linecolor`, 
					`single_item_plate`, 
					`single_item_fastener`,
					`single_item_placket`,
					`single_item_trouserstype`,
					`single_item_backbag`,
					`single_item_alternative1`,
					`single_item_alternative2`,
					`single_item_alternative3`,
					`single_item_alternative4`,
					`single_item_alternative5`,
					`single_item_alternative6`,
					`single_item_alternative7`,
					`single_item_count`, 
					`measure_id`
				)
				VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
		$param = array(
					$item_detail->cart_id,
					$item_detail->item_id,
					$item_detail->single_item_thickness,
					$item_detail->single_item_color,
					$item_detail->single_item_metal,
					$item_detail->single_item_linecolor,
					$item_detail->single_item_plate,
					$item_detail->single_item_fastener,
					$item_detail->single_item_placket,
					$item_detail->single_item_trouserstype,
					$item_detail->single_item_backbag,
					$item_detail->single_item_alternative1,
					$item_detail->single_item_alternative2,
					$item_detail->single_item_alternative3,
					$item_detail->single_item_alternative4,
					$item_detail->single_item_alternative5,
					$item_detail->single_item_alternative6,
					$item_detail->single_item_alternative7,
					$item_detail->single_item_count,
					$item_detail->measure_id
				);
		$query = $this->db->query($sql, $param);
		if ($this->db->affected_rows() != 1)
			return -1;
		return $this->db->insert_id();
	}
	
	public function get_by_customer_id($customer_id)
	{
		$sql = 'SELECT 
					`single_item_id`,
					`cart_single_item`.`cart_id`,
					`item_id`,
					`single_item_thickness`,
					`single_item_color`,
					`single_item_metal`,
					`single_item_linecolor`,
					`single_item_plate`,
					`single_item_fastener`,
					`single_item_placket`,
					`single_item_trouserstype`,
					`single_item_backbag`,
					`single_item_alternative1`,
					`single_item_alternative2`,
					`single_item_alternative3`,
					`single_item_alternative4`,
					`single_item_alternative5`,
					`single_item_alternative6`,
					`single_item_alternative7`,
					`single_item_count`,
					`measure_id`
				FROM 
					`cart_single_item` JOIN `cart` ON `cart_single_item`.`cart_id` =  `cart`.`cart_id`
				WHERE 
					`has_paid` = 0 AND `customer_id` = ?';
		$query = $this->db->query($sql, array($customer_id));
		return $query->result();
	}
	
	public function get_by_cart_id($cart_id)
	{
		$sql = 'SELECT
					`single_item_id`,
					`cart_id`,
					`item_id`,
					`single_item_thickness`,
					`single_item_color`,
					`single_item_metal`,
					`single_item_linecolor`,
					`single_item_plate`,
					`single_item_fastener`,
					`single_item_placket`,
					`single_item_trouserstype`,
					`single_item_backbag`,
					`single_item_alternative1`,
					`single_item_alternative2`,
					`single_item_alternative3`,
					`single_item_alternative4`,
					`single_item_alternative5`,
					`single_item_alternative6`,
					`single_item_alternative7`,
					`single_item_count`,
					`measure_id`
				FROM
					`cart_single_item`
				WHERE
					`cart_id` = ?';
		$query = $this->db->query($sql, array($cart_id));
		return $query->result();
	}
	
	public function update_count($count, $single_item_id)
	{
		$sql = 'UPDATE 
					`cart_single_item`
				SET 
					`single_item_count` = `single_item_count` + ?
				WHERE
					`single_item_id` = ?';
		$query = $this->db->query($sql, array($count, $single_item_id));
		if ($count != 0 && $this->db->affected_rows() == 0)
			return FALSE;
		return TRUE;
	}
	
	public function del($single_item_id)
	{
		$sql = 'DELETE FROM 
					`cart_single_item`
				WHERE `single_item_id` = ?';
		
		$query = $this->db->query($sql, array($single_item_id));
		if ($this->db->affected_rows() != 1)
			return FALSE;
		return TRUE;
	}
}

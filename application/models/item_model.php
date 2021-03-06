<?php
class Item_model extends CI_Model
{
	var $max_display;
	
	public function __construct()
	{
		parent::__construct();
		$this->max_display = 10;
	}
	
	/**
	 * @author belief
	 * @param unknown_type $type
	 */
	public function get_by_type($type, $start = NULL, $num = NULL)
	{
		$sql = 'SELECT * FROM `item` 
					WHERE `item_type` = ? AND `item_on_sale` = 1
				ORDER BY `item_id` DESC';
		if (isset($start) && isset($num))
			$sql .= ' LIMIT ?, ?';
		$query = $this->db->query($sql, array($type, $start, $num));
		return $query->result();
	}
	
	public function get_num_by_type($item_type)
	{
		$sql = 'SELECT count(1) as `num` FROM `item` WHERE `item_type` = ? AND `item_on_sale` = 1';
		$query = $this->db->query($sql, array($item_type));
		return $query->row()->num;
	}
	
	public function get_popular_items($start = NULL, $length = NULL, $item_type)
	{
		$sql = 'SELECT 
					* 
				FROM (
					SELECT 
						`item_id`,
						`item_id` as `item_join_id`,
						`item_name`,
						`item_price`,
						`item_provenance`,
						`item_weight`,
						`item_material_image`,
						`item_intro`,
						`item_photo`,
						`item_small_photo`,
						`item_type`,
						`item_on_sale`
					FROM 
						`item`
					) as item_all
					LEFT JOIN (
						SELECT 
							`item_id` as `item_join_id`, count(1) as `order_num`
						FROM
							`cart` JOIN `cart_single_item` ON `cart`.`cart_id` = `cart_single_item`.`cart_id`
						WHERE 
							`cart`.`has_paid` = 1
						GROUP BY 
							`item_id`
					) as item_num
				ON 
					`item_all`.`item_join_id` = `item_num`.`item_join_id`
				WHERE 
					`item_all`.`item_on_sale` = 1 AND `item_all`.`item_type` = ?
				ORDER BY `order_num` DESC';
		if (isset($start) && isset($length))
		{
			$sql .= ' LIMIT ?, ?';
		}
		$query = $this->db->query($sql, array($item_type, $start, $length));
		return $query->result();
	}
	
	public function get_item_ids()
	{
		$sql = 'SELECT `item_id` FROM `item` WHERE `item_on_sale` = 1';
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	public function get_item_by_id($item_id)
	{
		$sql = 'SELECT * FROM `item` WHERE `item_id` = ? AND `item_on_sale` = 1';
		$query = $this->db->query($sql, array($item_id));
		if ($query->num_rows() == 0)
			return NULL;
		return $query->row();
	}
	
	public function get_items_by_ids($item_ids)
	{
		if (!is_array($item_ids))
			$item_ids = array($item_ids);
		$sql = 'SELECT * FROM `item` WHERE `item_id` IN(';
		$firse = TRUE;
		foreach ($item_ids as $item_id)
		{
			if ($firse == TRUE)
			{
				$sql .= $item_id;
				$firse = FALSE;
			}
			else
				$sql .= ','.$item_id;
		}
		$sql .= ') AND `item_on_sale` = 1';
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	
	//Modify by Jun
	public function add_item($item_name, $item_price, $item_intro, $item_photo, $item_small_photo, $item_type, $item_material_image, $item_provenance, $item_weight) {
		$sql = 'INSERT INTO `item`(
					`item_name`,
					`item_price`,
					`item_intro`,
					`item_photo`,
					`item_small_photo`,
					`item_type`,
					`item_material_image`,
					`item_provenance`,
					`item_weight`
				) VALUES(?,?,?,?,?,?,?,?,?)';
		$qurey = $this->db->query($sql,array($item_name, $item_price, $item_intro, $item_photo, $item_small_photo, $item_type, $item_material_image, $item_provenance, $item_weight));
	
		if($this->db->affected_rows() != 1) {
			return -1;
		}
		return $this->db->insert_id();
	}
	
	//Modify by Jun
	public function delete_item($item_id) {
		$sql = 'DELETE FROM `item` WHERE `item_id` = ?';
		$this->db->query($sql, $item_id);
		return $this->db->affected_rows() == 1;
	}
	
	//Modify by Jun
	public function onsale_item($item_id) {
		$sql = 'UPDATE `item` SET `item_on_sale` = 1 WHERE `item_id` = ?';
		$this->db->query($sql, $item_id);
		return $this->db->affected_rows() == 1;
	}
	
	//Modify by Jun
	public function offsale_item($item_id) {
		$sql = 'UPDATE `item` SET `item_on_sale` = 0 WHERE `item_id` = ?';
		$this->db->query($sql, $item_id);
		return $this->db->affected_rows() == 1;
	}
	
	//Modify by Jun
	public function search_item($item_type, $page_num) {
		$result_offset = ( $page_num - 1 ) * $this->max_display;
		$sql = 'SELECT * FROM `item` WHERE `item_type` = ? AND `item_on_sale` = 1 ORDER BY `item_id` DESC LIMIT ?, ?';
		$query = $this->db->query($sql, array($item_type, $result_offset, $this->max_display));
		return $query->result();
	}
	
	//Modify by Jun
	public function search_offsale_item($item_type, $page_num) {
		$result_offset = ( $page_num - 1 ) * $this->max_display;
		$sql = 'SELECT * FROM `item` WHERE `item_type` = ? AND `item_on_sale` = 0 ORDER BY `item_id` DESC LIMIT ?, ?';
		$query = $this->db->query($sql,  array($item_type, $result_offset, $this->max_display));
		return $query->result();
	}
	
	//Modify by Jun
	public function modify_price($item_id, $item_price) {
		$sql = 'UPDATE `item` SET `item_price` = ? WHERE `item_id` = ?';
		$query = $this->db->query($sql,array($item_price, $item_id));
		return $this->db->affected_rows() == 1;
	}
	
	// Modify by Jun
	public function item_amount($item_type = 1) {
		$sql = 'SELECT count(*) AS `item_amount` FROM `item` where `item_type` = ? and `item_on_sale` = 1 ORDER BY `item_id`';
		$qurey = $this->db->query($sql, $item_type);
	
		return $qurey->row();
	}
	
	// Modify by Jun
	public function item_offsale_amount($item_type = 1) {
		$sql = 'SELECT count(*) AS `item_amount` FROM `item` where `item_type` = ? and `item_on_sale` = 0 ORDER BY `item_id`';
		$qurey = $this->db->query($sql, $item_type);
	
		return $qurey->row();
	}
}
<?php
class Item_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
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
	
	public function get_popular_items($start = NULL, $length = NULL)
	{
		$sql = 'SELECT 
					* 
				FROM 
					`item` as item_all, (
						SELECT 
							`item_id`, count(1) as `order_num`
						FROM
							`cart` JOIN `cart_single_item` ON `cart`.`cart_id` = `cart_single_item`.`cart_id`
						WHERE 
							`cart`.`has_paid` = 1
						GROUP BY 
							`item_id`
					) as item_num
				WHERE 
					`item_all`.`item_id` = `item_num`.`item_id`  AND `item_all`.`item_on_sale` = 1
				ORDER BY `order_num` DESC';
		if (isset($start) && isset($length))
		{
			$sql .= ' LIMIT ?, ?';
		}
		$query = $this->db->query($sql, array($start, $length));
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
	public function search_item($item_type) {
		$sql = 'SELECT * FROM `item` WHERE `item_type` = ? AND `item_on_sale` = 1 ORDER BY `item_id` DESC';
		$query = $this->db->query($sql, $item_type);
		return $query->result();
	}
	
	//Modify by Jun
	public function search_offsale_item($item_type) {
		$sql = 'SELECT * FROM `item` WHERE `item_type` = ? AND `item_on_sale` = 0 ORDER BY `item_id` DESC';
		$query = $this->db->query($sql, $item_type);
		return $query->result();
	}
}
<?php
class Item_detail_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_by_item_type($item_type)
	{
		$sql = 'SELECT * FROM `item_detail` WHERE `item_type` = ? AND `detail_valid` = 1';
		$query = $this->db->query($sql, array($item_type));
		return $query->result();
	} 
	
	public function get_details($detail_ids)
	{
		if(!is_array($detail_ids))
			$detail_ids = array($detail_ids);
		if (count($detail_ids) == 0)
			return array();
		$sql = 'SELECT * FROM `item_detail` WHERE `detail_id` IN(';
		$first = TRUE;
		foreach ($detail_ids as $detail_id)
		{
			if($first == TRUE)
			{
				$sql .= $detail_id;
				$first = FALSE;
			}
			else
				$sql .= ', '.$detail_id;
		}
				
		$sql .=	') AND `detail_valid` = 1';
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	//Modify by Jun
	public function add_item_detail($item_type, $detail_type, $detail_name, $detail_attach_price, $detail_description, $detail_image, $detail_incart_image) {
		$detail_valid = 1;
		$sql = 'INSERT INTO `item_detail`(
					`item_type`,
					`detail_type`,
					`detail_name`,
					`detail_attach_price`,
					`detail_description`,
					`detail_image`,
					`detail_incart_image`,
					`detail_valid`
				) VALUES(?,?,?,?,?,?,?,?)';
		$qurey = $this->db->query($sql,array($item_type, $detail_type, $detail_name, $detail_attach_price, $detail_description, $detail_image, $detail_incart_image, $detail_valid));
	
		if($this->db->affected_rows() != 1) {
			return -1;
		}
		return $this->db->insert_id();
	}
	
	//Modify by Jun
	public function delete_item_detail($detail_id) {
		$sql = 'DELETE FROM `item_detail` WHERE `detail_id` = ?';
		$this->db->query($sql, $detail_id);
		return $this->db->affected_rows() == 1;
	}
	
	//Modify by Jun
	public function invalid_item_detail($detail_id) {
		$sql = 'UPDATE `item_detail` SET `detail_valid` = 0 WHERE `detail_id` = ?';
		$this->db->query($sql, $detail_id);
		return $this->db->affected_rows() == 1;
	}
	
	//Modify by Jun
	public function valid_item_detail($detail_id) {
		$sql = 'UPDATE `item_detail` SET `detail_valid` = 1 WHERE `detail_id` = ?';
		$this->db->query($sql, $detail_id);
		return $this->db->affected_rows() == 1;
	}
	
	//Modify by Jun
	public function search_detail($item_type, $detail_type) {
		$sql = 'SELECT * FROM `item_detail` WHERE `item_type` = ? AND `detail_type` = ? AND `detail_valid` = 1 ORDER BY `detail_id` ASC';
		$query = $this->db->query($sql,array($item_type, $detail_type));
		return $query->result();
	}
	
	//Modify by Jun
	public function search_invalid_detail($item_type, $detail_type) {
		$sql = 'SELECT * FROM `item_detail` WHERE `item_type` = ? AND `detail_type` = ? AND `detail_valid` = 0 ORDER BY `detail_id` ASC';
		$query = $this->db->query($sql,array($item_type, $detail_type));
		return $query->result();
	}
}
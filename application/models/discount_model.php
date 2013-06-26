<?php
class Discount_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_global_by_code($discount_code)
	{
		$sql = 'SELECT * FROM `discount` WHERE `discount_code` = ? AND `valid` = 1 AND `discount_type` = 2';
		$query = $this->db->query($sql, array($discount_code));
		if($query->num_rows() != 1)
			return null;
		return $query->row();		
	}
	
	public function get_personal_by_customer_id($customer_id)
	{
		$sql = 'SELECT 
					*
				FROM 
					`customer_discount` JOIN `discount` ON `customer_discount`.`discount_id` = `discount`.`discount_id`
				JOIN
					`customer` ON `customer_discount`.`customer_id` = `customer`.`customer_id`
				WHERE 
					`customer_discount`.`customer_id` = ? AND `discount`.`valid` = 1 AND `discount`.`discount_type` = 1';
		$query = $this->db->query($sql, array($customer_id));
		if($query->num_rows() == 0)
			return null;
		return $query->result();
	}
	
	public function to_invalid($discount_id)
	{
		$sql = 'UPDATE `discount` SET `valid` = 0 WHERE `discount_id` = ?';
		$query = $this->db->query($sql, array($discount_id));
		if($this->db->affected_rows() != 1)
			return FALSE;
		else
			return TRUE;
	}
	
	/*Jun*/
	public function add_discount($discount_code, $discount_type, $minus_price, $valid) {
		$sql = 'INSERT INTO `discount`(
					`discount_code`,
					`discount_type`,
					`minus_price`,
					`valid`
				) VALUES(?,?,?,?)';
		$qurey = $this->db->query($sql,array($discount_code, $discount_type, $minus_price, $valid));
	
		if($this->db->affected_rows() != 1) {
			return -1;
		}
		return $this->db->insert_id();
	}
	
	public function check($discount_code) {
		$sql = 'SELECT * FROM `discount` WHERE `discount_code` = ?';
		$qurey = $this->db->query($sql,array($discount_code));
	
		return $this->db->affected_rows();
	}
	
	public function delete_discount($discount_id) {
		$sql = 'DELETE FROM `discount` WHERE `discount_id` = ?';
		$this->db->query($sql, $discount_id);
		return $this->db->affected_rows() == 1;
	}
	
	public function invalid_discount($discount_id) {
		$sql = 'UPDATE `discount` SET `valid` = 0 WHERE `discount_id` = ?';
		$this->db->query($sql, $discount_id);
		return $this->db->affected_rows() == 1;
	}
	
	public function discount_list() {
		$sql = 'SELECT * FROM `discount` WHERE `valid` = 1 ORDER BY `discount_id` DESC';
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	public function invalid_discount_list() {
		$sql = 'SELECT * FROM `discount` WHERE `valid` = 0 ORDER BY `discount_id` DESC';
		$query = $this->db->query($sql);
		return $query->result();
	}
}
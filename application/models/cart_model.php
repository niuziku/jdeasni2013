<?php
class Cart_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function add($customer_id)
	{
		$sql = 'INSERT INTO `cart`(`customer_id`) VALUES(?)';
		$query = $this->db->query($sql, array($customer_id));
		if ($this->db->affected_rows() != 1)
			return -1;
		return $this->db->insert_id();
	}
	
	public function get_unpaid($customer_id)
	{
		$sql = 'SELECT * FROM `cart` WHERE `has_paid` = 0 AND customer_id = ?';
		$query = $this->db->query($sql, array($customer_id));
		if ($query->num_rows() == 0)
			return NULL;
		return $query->row();
	}
	
	public function cart_pay($cart_id)
	{
		$sql = 'UPDATE `cart` SET `has_paid` = 1 WHERE `cart_id` = ?';
		$query = $this->db->query($sql, array($cart_id));
		if ($this->db->affected_rows() != 1)
			return FALSE;
		else
			return TRUE;
	}
	
}
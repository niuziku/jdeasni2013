<?php
class order_discount_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function add($order_id, $discount_id)
	{
		$sql = 'INSERT INTO `order_discount`(
					`order_id`,
					`discount_id`
				) VALUES(?, ?)';
		$query = $this->db->query($sql, array($order_id, $discount_id));
		if($this->db->affected_rows() != 1)
			return FALSE;
		return $this->db->insert_id();
	}
}
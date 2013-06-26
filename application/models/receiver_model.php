<?php
class Receiver_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function add($customer_id, $name, $area, $address, $phone, $is_default)
	{
		$sql = 'INSERT INTO `receiver`(
					`customer_id`,
					`receiver_name`,
					`receiver_area`,
					`receiver_address`,
					`receiver_phone`,
					`is_default`
				) VALUES(?, ?, ?, ?, ?, ?)';
		$query = $this->db->query($sql, array($customer_id, $name, $area, $address, $phone, $is_default));
		if ($this->db->affected_rows() != 1)
			return -1;
		return $this->db->insert_id();
	}
	
	public function get($receiver_id)
	{
		$sql = 'SELECT * FROM `receiver` WHERE `receiver_id` = ? AND `receiver_valid` = 1';
		$query = $this->db->query($sql, array($receiver_id));
		if ($query->num_rows() == 1)
			return $query->row();
		return NULL;
	}
	
	public function get_all($customer_id)
	{
		$sql = 'SELECT * FROM `receiver` WHERE `customer_id` = ? AND `receiver_valid` = 1';
		$query = $this->db->query($sql, array($customer_id));
		return $query->result();
	}
	
	public function del($receiver_id)
	{
		$sql = 'UPDATE `receiver` SET `receiver_valid` = 0 WHERE `receiver_id` = ?';
		$query = $this->db->query($sql, array($receiver_id));
		if ($this->db->affected_rows() != 1)
			return FALSE;
		return TRUE;
	}
	
	public function update($receiver_id, $config)
	{
		$sql = 'UPDATE `receiver` SET ';
		$is_first = TRUE;
		$params = array();
		foreach ($config as $key => $value)
		{
			array_push($params, $value);
			if ($is_first == TRUE)
			{
				$sql .= $key.' = ?';
				$is_first = FALSE;
			}
			else
			{
				$sql .= ', '.$key.' = ?';
			}
		}
		$sql .= ' WHERE `receiver_id` = ? AND `receiver_valid` = 1';
		array_push($params, $receiver_id);
		$query = $this->db->query($sql, $params);
		if ($this->db->affected_rows() != 1)
			return FALSE;
		return TRUE;
	}
	
	public function reset_default($customer_id)
	{
		$sql = 'UPDATE `receiver` SET `is_default` = 0 WHERE `customer_id` = ? AND `receiver_valid` = 1';
		$query = $this->db->query($sql, array($customer_id));
	}
	
	public function set_default($customer_id, $receiver_id)
	{
		$sql = 'UPDATE `receiver` SET `is_default` = 1 WHERE `customer_id` = ? AND `receiver_id` = ? AND `receiver_valid` = 1';
		$query = $this->db->query($sql, array($customer_id, $receiver_id));
	}
}

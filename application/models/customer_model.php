<?php
class Customer_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function add($email, $password)
	{
		$sql = 'INSERT INTO
				`customer`(
					`customer_email`,
					`customer_password`
				)VALUES(?, ?)';
		$this->db->query($sql, array($email, sha1($password)));
		if($this->db->affected_rows() != 1)
			return -1;
		return $this->db->insert_id();
	}
	
	public function get($email, $password)
	{
		$sql = 'SELECT
					`customer_id`,
					`customer_email`,
					`customer_password`,
					`customer_name`,
					`customer_sex` 
				FROM `customer` WHERE `customer_email` = ? AND `customer_password` = ?';
		$query = $this->db->query($sql, array($email, sha1($password)));
		if ($query->num_rows() == 1)
			return $query->row();
		return NULL;
	}
	
	public function get_by_email($email)
	{
		$sql = 'SELECT
					`customer_id`,
					`customer_email`,
					`customer_password`,
					`customer_name`,
					`customer_sex`
				FROM `customer` WHERE `customer_email` = ?';
		$query = $this->db->query($sql, array($email));
		if ($query->num_rows() == 1)
			return $query->row();
		return NULL;
	}
	
	public function get_by_id($customer_id)
	{
		$sql = 'SELECT
					`customer_id`,
					`customer_email`,
					`customer_password`,
					`customer_name`,
					`customer_sex`
				FROM `customer` WHERE `customer_id` = ?';
		$query = $this->db->query($sql, array($customer_id));
		if ($query->num_rows() == 1)
			return $query->row();
		return NULL;
	}
	
	/**
	 * config数组中为字段名-更新后的字段值 键值对
	 * @param int $customer_id
	 * @param array $config
	 * @return boolean
	 */
	public function update_customer($customer_id, $config)
	{
		$sql = 'UPDATE `customer` SET ';
		$is_first = TRUE;
		$params = array();
		foreach ($config as $key => $value)
		{
			if ($key == 'customer_password')
				$value = sha1($value);
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
		$sql .= ' WHERE `customer_id` = ?';
		array_push($params, $customer_id);
		$query = $this->db->query($sql, $params);
		if ($this->db->affected_rows() != 1)
			return FALSE;
		return TRUE;
	}
}
<?php
class Measure_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function add($measure)
	{
		$sql = 'INSERT INTO `measure`(
					`customer_id`,
					`measure_yaowei`, 
					`measure_shengao`,
					`measure_tizhong`,
					`measure_kuchang`,
					`measure_datui`,
					`measure_jiaowei`,
					`measure_qiandang`,
					`measure_tunwei`,
					`measure_xigai`,
					`measure_houdang`
				)VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
		$param = array(
					$measure->customer_id,
					$measure->measure_yaowei,
					$measure->measure_shengao,
					$measure->measure_tizhong,
					$measure->measure_kuchang,
					$measure->measure_datui,
					$measure->measure_jiaowei,
					$measure->measure_qiandang,
					$measure->measure_tunwei,
					$measure->measure_xigai,
					$measure->measure_houdang
				);
		$query = $this->db->query($sql, $param);
		if ($this->db->affected_rows() != 1)
			return -1;
		return $this->db->insert_id();
	}
	
	public function get_by_customer_id($customer_id)
	{
		$sql = 'SELECT
					*
				FROM 
					`measure`
				WHERE `customer_id` = ? AND `measure_valid` = 1';
		$query = $this->db->query($sql, array($customer_id));
		return $query->result();
	}
	
	public function reset_default($customer_id){
		$sql = 'UPDATE `measure` SET `measure_default` = 0 WHERE `customer_id` = ? AND `measure_valid` = 1';
		$query = $this->db->query($sql, array($customer_id));
		
	}
	
	public function set_default($customer_id, $measure_id){
		$sql = 'UPDATE `measure` SET `measure_default` = 1 WHERE `measure_id` = ? AND `measure_valid` = 1';
		$query = $this->db->query($sql, array($measure_id));
	}
	
	public function del($measure_id){
		$sql = 'UPDATE `measure` SET `measure_valid`= 0 WHERE `measure_id` = ?';
		$query = $this->db->query($sql, array($measure_id));
		if ($this->db->affected_rows() != 1)
			return FALSE;
		return TRUE;
	}
}
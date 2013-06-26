<?php
class Admin_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_admin($email, $password) {
		$sql = 'SELECT * FROM `admin` WHERE 
				`admin_email` = ? AND `admin_password` = ?';
		$query = $this->db->query($sql, array($email, sha1($password)));
		
		if($query->num_rows() == 1) {
			return $query->row();
		}
		return NULL;
	}
	
	public function check_password($admin_id, $password) {
		$sql = 'SELECT * FROM `admin` WHERE 
				`admin_id` = ? AND `admin_password` = ?';
		$query = $this->db->query($sql, array($admin_id, sha1($password)));
		
		if($query->num_rows() == 1) {
			return $query->row();
		}
		return NULL;
	}
	
	public function edit_password($admin_id, $new_password) {
		$sql = 'UPDATE `admin` SET `admin_password` = ? WHERE `admin_id` = ?';
		$query = $this->db->query($sql, array(sha1($new_password), $admin_id));
		return NULL;
	}
} 
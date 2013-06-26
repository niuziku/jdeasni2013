<?php
class Comment_model extends CI_Model
{
	var $max_display;
	
	public function __construct()
	{
		parent::__construct();
		$this->max_display = 10;
	}
	
	public function add($email, $phone, $name, $content, $photo, $public, $parent_id)
	{
		$sql = 'INSERT INTO
				`comment`(
					`comment_email`,
					`comment_phone`,
					`comment_name`,
					`comment_content`,
					`comment_photo`,
					`comment_public`,
					`parent_id`
				) VALUES(? ,?, ?, ?, ?, ?, ?)';
		$query = $this->db->query($sql, array($email, $phone, $name, $content, $photo, $public, $parent_id));
		if ($this->db->affected_rows() != 1)
			return -1;
		return $this->db->insert_id();
	}
	
	public function get_customer_comments($start = NULL, $num = NULL)
	{
		$sql = 'SELECT 
					*
				FROM 
					`comment`
				WHERE 
					`parent_id` = 0 AND `comment_public` = 1
				ORDER BY `comment_id` DESC';
		if ($start !== NULL && $num !== NULL)
			$sql .= ' LIMIT ?, ?';
		$query = $this->db->query($sql, array($start, $num));
		return $query->result();
	}
	
	public function get_admin_comments($comment_ids)
	{
		if (!is_array($comment_ids))
			return array();
		
		$sql = 'SELECT * FROM `comment` WHERE `parent_id` IN ';
		$is_first = true;
		foreach ($comment_ids as $comment_id){
			if($is_first){
				$sql .= '('.$comment_id;
			}else{
				$sql .= ','.$comment_id;
			}
			$is_first = false;
		}
		$sql .= ');';
		$query = $this->db->query($sql);
		
		return $query->result();
	}
	
	public function get_amount_of_customer()
	{
		$sql = 'SELECT count(*) AS `comment_amount` FROM `comment` WHERE `parent_id` = 0 AND `comment_public` = 1';
		$query = $this->db->query($sql);
		return $query->row()->comment_amount;
	}
	
	// Modify by Jun
	public function add_reply($comment_name, $comment_content, $comment_public, $parent_id) {
		$sql = 'INSERT INTO `comment` (
					`comment_name`,
					`comment_content`,
					`comment_public`,
					`parent_id`
				) VALUES(?, ?, ?, ?)';
	
		$qurey = $this->db->query($sql, array($comment_name, $comment_content, $comment_public, $parent_id));
	
		if($this->db->affected_rows() != 1) {
			return -1;
		}
		return $this->db->insert_id();
	}
	
	// Modify by Jun
	public function delete_comment($comment_id) {
		$sql = 'DELETE FROM `comment` WHERE `comment_id` = ? OR `parent_id` = ?';
	
		$qurey = $this->db->query($sql, array($comment_id, $comment_id));
	
		return $this->db->affected_rows() == 1;
	}
	
	// Modify by Jun
	public function comment_list($page_num) {
		$result_offset = ( $page_num - 1 ) * $this->max_display;
		$sql = 'SELECT * FROM `comment` WHERE `parent_id` = 0 ORDER BY `comment_id` DESC LIMIT ?, ?';
		$qurey = $this->db->query($sql, array($result_offset, $this->max_display));
	
		return $qurey->result();
	}
	
	// Modify by Jun
	public function reply_list($start_id, $end_id) {
		$sql = 'SELECT * FROM `comment` WHERE `parent_id` BETWEEN ? AND ?';
		$qurey = $this->db->query($sql, array($start_id, $end_id));
	
		return $qurey->result();
	}
	
	// Modify by Jun
	public function comment_amount() {
		$sql = 'SELECT count(*) AS `comment_amount` FROM `comment` WHERE `parent_id` = 0';
		$qurey = $this->db->query($sql);
	
		return $qurey->row();
	}
}

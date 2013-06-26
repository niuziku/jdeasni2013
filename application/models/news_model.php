<?php
class News_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_news($start = NULL, $length = NULL)
	{
		$sql = 'SELECT * FROM `news` ORDER BY `news_time` DESC';
		if ($start !== NULL && $length !== NULL)
		{
			$sql .= ' LIMIT ?, ?';
		}
		
		$query = $this->db->query($sql, array($start, $length));
		return $query->result();
	}
	
	public function get_news_by_type($type, $start = NULL, $length = NULL)
	{
		$sql = 'SELECT * FROM `news` WHERE `news_type` = ? ORDER BY `news_time` DESC';
		if ($start !== NULL && $length !== NULL)
		{
			$sql .= ' LIMIT ?, ?';
		}
		$query = $this->db->query($sql, array($type, $start, $length));
		return $query->result();
	}
	
	public function get_news_num($type)
	{
		$sql = 'SELECT count(*) as news_num FROM `news`';
		if($type > 0)
			$sql .= ' WHERE `news_type` = ?';
		$query = $this->db->query($sql, array($type));
		return $query->row()->news_num;
	}
	
	public function get_single_news($news_id)
	{
		$sql = 'SELECT * FROM `news` WHERE `news_id` = ?';
		$query = $this->db->query($sql, array($news_id));
		if($query->num_rows() != 1)
			return NULL;
		return $query->row();
	}
	
	//Modify by Jun
	public function add_news($news_title, $news_content, $news_type) {
		$sql = 'INSERT INTO `news`(
					`news_title`,
					`news_content`,
					`news_type`
				) VALUES(?,?,?)';
		$qurey = $this->db->query($sql,array($news_title, $news_content, $news_type));
	
		if($this->db->affected_rows() != 1) {
			return -1;
		}
		return $this->db->insert_id();
	}
	
	//Modify by Jun
	public function delete_news($news_id) {
		$sql = 'DELETE FROM `news` WHERE `news_id` = ?';
		$this->db->query($sql, $news_id);
		return $this->db->affected_rows() == 1;
	}
	
	//Modify by Jun
	public function news_list() {
		$sql = 'SELECT `news_id`,`news_title`,`news_time`,`news_type` FROM `news` ORDER BY `news_id` DESC';
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	//Modify by Jun
	public function single_news($news_id) {
		$sql = 'SELECT * FROM `news` WHERE `news_id` = ?';
		$query = $this->db->query($sql, $news_id);
		return $query->row();
	}
}

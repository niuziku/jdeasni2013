<?php
class comment extends Front_Controller
{
	const RE_EMAIL = '/^[A-Za-z0-9+]+[A-Za-z0-9\.\_\-+]*@([A-Za-z0-9\-]+\.)+[A-Za-z0-9]+$/';
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('message/message/message_head.php');
		$this->load->view('header.php');
		$this->load->view('message/message/message_content.php');
		$this->load->view('footer.php');
		$this->load->view('message/message/message_trail.php');
	}
	
	public function create()
	{
		$email = $this->input->get('email');
		$phone = $this->input->get('phone');
		$content = $this->input->get('content');
		$name = $this->input->get('name');
		$photo = $this->input->get('photo');
		$public = $this->input->get('isPublic');
		$parent_id = 0;
		
		if ($this->_isempty($content, $name, $public))
			return $this->_json_response(array(), 777, 'params cannot be empty');
		if (empty($phone) && empty($email))
			return $this->_json_response(array(), 777, 'either phone or email must be fill');
		if (!empty($email) && preg_match(self::RE_EMAIL, $email) != 1)
			return $this->_json_response(array(), 777, 'email invalid');
		if ($public != 0 && $public != 1)
			return $this->_json_response(array(), 777, 'param error');
		if (strlen($content) <=0 || strlen($content) > 300)
			return $this->_json_response(array(), 777, 'content length invalid');
		if (strlen($name) <= 0 || strlen($name) > 30)
			return $this->_json_response(array(), 777, 'name length invalid');
		
		if ($email === FALSE)
			$email = NULL;
		else 
			$email = htmlspecialchars($email);
		if ($phone === FALSE)
			$phone = NULL;
		else 
			$phone = htmlspecialchars($phone);
		if ($photo === FALSE)
			$photo = NULL;
		
		$this->load->model('comment_model');
		if($this->comment_model->add($email, $phone, htmlspecialchars($name), htmlspecialchars($content), $photo, $public, $parent_id) == -1)
			return $this->_json_response(array(), 777, '');
		return $this->_json_response(array());
		
	}
	
	public function get()
	{
		$start = intval($this->input->get('start'));
		$num = intval($this->input->get('num'));
		$start = ($start > 0 ? $start : 0);
		$num = ($num > 0 ? $num : 15);
		$this->load->model('comment_model');
		$cus_comments = $this->comment_model->get_customer_comments($start, $num);
		
		$comment_ids = array();
		$comments = array();
		
		foreach ($cus_comments as $cus_comment)
		{
			array_push($comment_ids, $cus_comment->comment_id);
			$comments[$cus_comment->comment_id] = $cus_comment;
		}
		$admin_comments = $this->comment_model->get_admin_comments($comment_ids);
		foreach ($admin_comments as $admin_comment)
			$comments[$admin_comment->parent_id]->admin_comment = $admin_comment;
		
		$ordered_comments = array();
		foreach ($comments as $comment)
			array_push($ordered_comments, $comment);
		return $this->_json_response(array('comments' => $ordered_comments));
	}
	
	public function get_amount_of_customer()
	{
		$this->load->model('comment_model');
		$amount = $this->comment_model->get_amount_of_customer();
		return $this->_json_response(array('amount' => $amount));		
	}
	
	public function upload_image()
	{
		$file_name = md5('d'.time().rand(1, 10000));
		$config['upload_path'] = './images/comment/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['file_name'] = $file_name;
		$config['max_size'] = 500;
		$this->load->library('upload', $config);
		
		
		if(!$this->upload->do_upload('c_image')) {
			return $this->_json_response(array(), 777, $this->upload->display_errors('', ''));
		}
		else {
			$data['upload_data'] = $this->upload->data();
			$file_name = $data['upload_data']['file_name'];
		}
		
		return $this->_json_response(array('image_name' => $file_name));
	}
	
	
	public function del_image()
	{
		$image_url = $this->input->get('image');
		if($this->_isempty($image_url))
			return $this->_json_response(array(), 777, 'param error');
		$image_name = end(explode('/', urldecode($image_url)));
		$result = @unlink ('images/comment/'.$image_name);
		if (!$result)
			return $this->_json_response(array(), 7, 'del fail');
		return $this->_json_response(array());
	}
}
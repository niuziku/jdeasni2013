<?php
class Comment extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('comment_model');
	}
	
	public function index() {
		$this->load->helper('url');
		if(!$this->is_login()) {
			redirect('admin/login');
		}
		else {
			$data['admin_name'] = $this->session->userdata['admin_name'];
			$this->load->view('admin/header.php', $data);
			$this->load->view('admin/comment.php');
			$this->load->view('admin/footer.php');
		}
	}
	
	public function add_reply() {
		$comment_content = $this->input->post('comment_content');
		$comment_public = $this->input->post('comment_public');
		$parent_id = $this->input->post('parent_id');
		
		if($this->_isempty($comment_content, $comment_public, $parent_id)) {
			return $this->_json_response(array(), 777, 'Params cannot be empty');
		}
		
		$comment_name = "idjeans";
		
		$comment = $this->comment_model->add_reply($comment_name, $comment_content, $comment_public, $parent_id);
	
		return $this->_json_response(array());
	}
	
	public function delete_comment() {
		$comment_id = $this->input->post('comment_id');
		
		if($this->_isempty($comment_id)) {
			return $this->_json_response(array(), 777, 'Params cannot be empty');
		}
		
		$comment = $this->comment_model->delete_comment($comment_id);
		
		return $this->_json_response(array());
	}
	
	public function comment_list($page_num = 1) {
		$comment_list = $this->comment_model->comment_list($page_num);
		return $this->_json_response($comment_list);
	}
	
	public function reply_list($start_id, $end_id) {
		$reply_list = $this->comment_model->reply_list($start_id, $end_id);
		return $this->_json_response($reply_list);
	}
	
	public function comment_amount() {
		$comment_amount = $this->comment_model->comment_amount();
		return $this->_json_response($comment_amount);
	}
}
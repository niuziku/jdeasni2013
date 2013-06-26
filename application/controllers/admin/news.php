<?php
class News extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('news_model');
	}
	
	public function index() {
		$this->load->helper('url');
		if(!$this->is_login()) {
			redirect('admin/login');
		}
		else {
			$data['admin_name'] = $this->session->userdata['admin_name'];
			$this->load->view('admin/header.php', $data);
			$this->load->view('admin/news.php');
			$this->load->view('admin/footer.php');
		}
	}
	
	public function add() {
		$this->load->helper('url');
		if(!$this->is_login()) {
			redirect('admin/login');
		}
		else {
			$data['admin_name'] = $this->session->userdata['admin_name'];
			$this->load->view('admin/header.php', $data);
			$this->load->view('admin/add_news.php');
			$this->load->view('admin/footer.php');
		}
	}
	
	public function single() {
		$this->load->helper('url');
		if(!$this->is_login()) {
			redirect('admin/login');
		}
		else {
			$data['admin_name'] = $this->session->userdata['admin_name'];
			$this->load->view('admin/header.php', $data);
			$this->load->view('admin/single_news.php');
			$this->load->view('admin/footer.php');
		}
	}
	
	public function add_news()  {
		$news_title = $this->input->post('news_title');
		$news_content = $this->input->post('news_content');
		$news_type = $this->input->post('news_type');
		
		if($this->_isempty($news_title, $news_content, $news_type)) {
			return $this->_json_response(array(), 777, 'Params cannot be empty');
		}
		
		$news = $this->news_model->add_news($news_title, $news_content, $news_type);
		
		return $this->_json_response(array());
	}
	
	public function delete_news() {
		$news_id = $this->input->post('news_id');
		if($this->_isempty($news_id)) {
			return $this->_json_response(array(), 777, 'Params cannot be empty');
		}
		
		$news = $this->news_model->delete_news($news_id);
		
		return $this->_json_response(array());
	}
	
	public function news_list() {
		$news_list = $this->news_model->news_list();
		return $this->_json_response($news_list);
	}
	
	public function single_news($news_id) {
		if($this->_isempty($news_id)) {
			return $this->_json_response(array(), 777, 'Params cannot be empty');
		}
		
		$news_data = $this->news_model->single_news($news_id);
		return $this->_json_response($news_data);
	}
}
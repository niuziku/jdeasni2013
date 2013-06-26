<?php
class News extends Front_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('news/news/news_head.php');
		$this->load->view('header');
		$this->load->view('news/news/news_content.php');
		$this->load->view('footer');
		$this->load->view('news/news/news_trail.php');
	}
	
	public function detail()
	{
		$this->load->helper('url');
		$this->load->view('news/news_detail/news_detail_head.php');
		$this->load->view('header');
		$this->load->view('news/news_detail/news_detail_content.php');
		$this->load->view('footer');
		$this->load->view('news/news_detail/news_detail_trail.php');
	}
	
	public function get()
	{
		$news_id = intval($this->input->get('news_id'));
		$this->load->model('news_model');
		$news = $this->news_model->get_single_news($news_id);
		if($news == NULL)
			return $this->_json_response(array(), '777', 'NEWS NOT EXIST');
		return $this->_json_response(array('news'=>$news));	
	}
	
	public function get_news()
	{
		$start = intval($this->input->get('start'));
		$length = intval($this->input->get('length'));
		$start = $start >= 0 ? $start : 0;
		$length = $length > 0 ? $length : 15;
		
		$this->load->model('news_model');
		$news = $this->news_model->get_news($start, $length);
		return $this->_json_response(array('news' => $news));
	}
	
	public function get_news_by_type()
	{
		$start = intval($this->input->get('start'));
		$length = intval($this->input->get('length'));
		$type = intval($this->input->get('type'));
		$start = $start >= 0 ? $start : 0;
		$length = $length > 0 ? $length : 15; 
		
		$this->load->model('news_model');
		$news = $this->news_model->get_news_by_type($type, $start, $length);
		return $this->_json_response(array('news' => $news));
	}
	
	/*如果type <= 0, 则搜索出所有news的数量*/
	public function get_news_num()
	{
		$type = intval($this->input->get('type'));
		$this->load->model('news_model');
		$news_num = $this->news_model->get_news_num($type);
		return $this->_json_response(array('news_num' => $news_num));
	}
}
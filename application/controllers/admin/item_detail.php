<?php
class Item_detail extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('item_detail_model');
	}
	
	public function index() {
		$this->load->helper('url');
		if(!$this->is_login()) {
			redirect('admin/login');
		}
		else {
			$data['admin_name'] = $this->session->userdata['admin_name'];
			$this->load->view('admin/header.php', $data);
			$this->load->view('admin/item_detail.php');
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
			$this->load->view('admin/add_item_detail.php');
			$this->load->view('admin/footer.php');
		}
	}
	
	public function invalid() {
		$this->load->helper('url');
		if(!$this->is_login()) {
			redirect('admin/login');
		}
		else {
			$data['admin_name'] = $this->session->userdata['admin_name'];
			$this->load->view('admin/header.php', $data);
			$this->load->view('admin/item_detail_invalid.php');
			$this->load->view('admin/footer.php');
		}
	}
	
	public function add_item_detail() {
		
		$item_type = $this->input->post('item_type');
		$detail_type = $this->input->post('detail_type');
		$detail_name = $this->input->post('detail_name');
		$detail_attach_price = $this->input->post('detail_attach_price');
		$detail_description = $this->input->post('detail_description');
		$detail_incart_image = $this->input->post('detail_incart_image');
		
		if($this->_isempty($item_type, $detail_type, $detail_description)) {
			return $this->_json_response(array(), 777, 'Params cannot be empty');
		}
		
		$detail_image = 'd'.time();
		$config['upload_path'] = './images/detail/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['file_name'] = $detail_image;
		$this->load->library('upload', $config);
		
		
		if(!$this->upload->do_upload('detail_image')) {
			return $this->_json_response(array(), 666, $this->upload->display_errors());
		}
		else {
			$data['upload_data'] = $this->upload->data();
			$detail_image = $data['upload_data']['file_name'];
		}
		
		if($detail_incart_image == NULL) {
			$detail_incart_image = $detail_image;
		}
		
		$item_detail = $this->item_detail_model->add_item_detail($item_type, $detail_type, $detail_name, $detail_attach_price, $detail_description, $detail_image, $detail_incart_image);
		
		return $this->_json_response(array());
	}
	
	public function upload_incart_image() {
		
		$current_time = time();
		$incart_image = 'd'.$current_time;
		$config['upload_path'] = './images/detail/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['file_name'] = $incart_image;
		$this->load->library('upload', $config);
		
		if(!$this->upload->do_upload('incart_image')) {
			return $this->_json_response(array(), 666, $this->upload->display_errors());
		}
		else {
			$data['upload_data'] = $this->upload->data();
			$incart_image = $data['upload_data']['file_name'];
		}
		
		return $this->_json_response($incart_image);
	}
	
	public function delete_item_detail() {
		$item_detail_id = $this->input->post('detail_id');
		if($this->_isempty($item_detail_id)) {
			return $this->_json_response(array(), 777, 'Params cannot be empty');
		}
		
		$item_detail = $this->item_detail_model->delete_item_detail($item_detail_id);
		
		return $this->_json_response(array());
	}
	
	public function invalid_item_detail() {
		$item_detail_id = $this->input->post('detail_id');
		if($this->_isempty($item_detail_id)) {
			return $this->_json_response(array(), 777, 'Params cannot be empty');
		}
		
		$item_detail = $this->item_detail_model->invalid_item_detail($item_detail_id);
		
		return $this->_json_response(array());
	}
	
	public function valid_item_detail() {
		$item_detail_id = $this->input->post('detail_id');
		if($this->_isempty($item_detail_id)) {
			return $this->_json_response(array(), 777, 'Params cannot be empty');
		}
		
		$item_detail = $this->item_detail_model->valid_item_detail($item_detail_id);
		
		return $this->_json_response(array());
	}
	
	public function search_detail() {
		$item_type = $this->input->post('item_type');
		$detail_type = $this->input->post('detail_type');
		
		if($this->_isempty($item_type, $detail_type)) {
			return $this->_json_response(array(), 777, 'Params cannot be empty');
		}
		
		$detail_data = $this->item_detail_model->search_detail($item_type, $detail_type);
		return $this->_json_response($detail_data);
	}
	
	public function search_invalid_detail() {
		$item_type = $this->input->post('item_type');
		$detail_type = $this->input->post('detail_type');
		
		if($this->_isempty($item_type, $detail_type)) {
			return $this->_json_response(array(), 777, 'Params cannot be empty');
		}
		
		$detail_data = $this->item_detail_model->search_invalid_detail($item_type, $detail_type);
		return $this->_json_response($detail_data);
	}
}
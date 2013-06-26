<?php
class Item extends Admin_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('item_model');
	}
	
	public function index() {
		$this->load->helper('url');
		if(!$this->is_login()) {
			redirect('admin/login');
		}
		else {
			$data['admin_name'] = $this->session->userdata['admin_name'];
			$this->load->view('admin/header.php', $data);
			$this->load->view('admin/item.php');
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
			$this->load->view('admin/add_item.php');
			$this->load->view('admin/footer.php');
		}
	}
	
	public function recycle() {
		$this->load->helper('url');
		if(!$this->is_login()) {
			redirect('admin/login');
		}
		else {
			$data['admin_name'] = $this->session->userdata['admin_name'];
			$this->load->view('admin/header.php', $data);
			$this->load->view('admin/item_recycle.php');
			$this->load->view('admin/footer.php');
		}
	}
	
	public function add_item() {
		$item_name = $this->input->post('item_name');
		$item_price = $this->input->post('item_price');
		$item_intro = $this->input->post('item_intro');
		$item_photo = $this->input->post('item_photo');
		$item_small_photo = $this->input->post('item_small_photo');
		$item_type = $this->input->post('item_type');
		
		$item_material_image = $this->input->post('item_material_image');
		$item_provenance = $this->input->post('item_provenance');
		$item_weight = $this->input->post('item_weight');
		
		$item_material_image = ($item_material_image == FALSE || $item_material_image == '') ? NULL : $item_material_image;
		$item_provenance = ($item_provenance == FALSE || $item_provenance == '') ? NULL : $item_provenance;
		$item_weight = ($item_weight == FALSE || $item_weight == '') ? NULL : $item_weight;
		
		if($this->_isempty($item_name, $item_price, $item_type)) {
			return $this->_json_response(array(), 777, 'Params cannot be empty');
		}
		
		$item = $this->item_model->add_item($item_name, $item_price, $item_intro, $item_photo, $item_small_photo, $item_type, $item_material_image, $item_provenance, $item_weight);
		
		return $this->_json_response(array());
	}
	
	
	public function upload_image() {
		$this->load->library('upload');
		
		$current_time = time();
		$file_name = 'i'.$current_time;
		$file_path = './images/item/';
		$config['upload_path'] = $file_path;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['file_name'] = $file_name;
		$config['create_thumb'] = TRUE;
		$this->upload->initialize($config);
		
		if(!$this->upload->do_upload("item_image")) {
			return $this->_json_response(array(), 666, $this->upload->display_errors());
		}
		
		else {
			$data['upload_data'] = $this->upload->data();
			$file_name = $data['upload_data']['file_name'];
			
			//Create thumb
			$configThumb['image_library'] = 'gd2';
			$configThumb['create_thumb'] = TRUE;		
			$configThumb['maintain_ratio'] = TRUE;
			$configThumb['new_image'] = $file_path;
			$configThumb['width'] = 100;
			$configThumb['height'] = 100;
			$configThumb['source_image'] = $data['upload_data']['full_path'];
			
			$this->load->library('image_lib');
			$this->image_lib->initialize($configThumb);
			$this->image_lib->resize();
		}
		
		return $this->_json_response($file_name);
	}
	
	public function upload_material_image() {
		$current_time = time();
		$file_name = 's'.$current_time;
		$file_path = './images/selvedge/';
		$config['upload_path'] = $file_path;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['file_name'] = $file_name;
		$this->load->library('upload', $config);
		
		
		if(!$this->upload->do_upload('material_image')) {
			return $this->_json_response(array(), 666, $this->upload->display_errors());
		}
		
		else {
			$data['upload_data'] = $this->upload->data();
			$file_name = $data['upload_data']['file_name'];
		}
		
		return $this->_json_response($file_name);
	}
	
	public function delete_item() {
		$item_id = $this->input->post('item_id');
		if($this->_isempty($item_id)) {
			return $this->_json_response(array(), 777, 'Params cannot be empty');
		}
		
		$item = $this->item_model->delete_item($item_id);
		
		return $this->_json_response(array());
	}
	
	public function onsale_item() {
		$item_id = $this->input->post('item_id');
		if($this->_isempty($item_id)) {
			return $this->_json_response(array(), 777, 'Params cannot be empty');
		}
		
		$item = $this->item_model->onsale_item($item_id);
		
		return $this->_json_response(array());
	}
	
	public function offsale_item() {
		$item_id = $this->input->post('item_id');
		if($this->_isempty($item_id)) {
			return $this->_json_response(array(), 777, 'Params cannot be empty');
		}
		
		$item = $this->item_model->offsale_item($item_id);
		
		return $this->_json_response(array());
	}
	
	public function search_item() {
		$item_type = $this->input->post('item_type');
		
		if($this->_isempty($item_type)) {
			return $this->_json_response(array(), 777, 'Params cannot be empty');
		}
		
		$item_data = $this->item_model->search_item($item_type);
		
		return $this->_json_response($item_data);
		
	}
	
	public function search_offsale_item() {
		$item_type = $this->input->post('item_type');
		
		if($this->_isempty($item_type)) {
			return $this->_json_response(array(), 777, 'Params cannot be empty');
		}
		
		$item_data = $this->item_model->search_offsale_item($item_type);
		
		return $this->_json_response($item_data);
		
	}
}
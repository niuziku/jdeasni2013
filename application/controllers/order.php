
<?php
class Order extends Front_Controller
{
	const RE_EMAIL = '/^[A-Za-z0-9+]+[A-Za-z0-9\.\_\-+]*@([A-Za-z0-9\-]+\.)+[A-Za-z0-9]+$/';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->helper('url');
		if($this->is_login())
		{
			$this->load->view('account/order/order_head');
			$this->load->view('header');
			$this->load->view('account/order/order_content');
			$this->load->view('footer');
			$this->load->view('account/order/order_trail');
		}
		else
		{
			$this->load->view('account/login/login_head');
			$this->load->view('account/login/login_content');
			$this->load->view('account/login/login_trail');
		}
	}
	
	
	public function get()
	{
		$start = intval($this->input->get('start'));
		$length = intval($this->input->get('length'));
		$start = $start >= 0 ? $start : 0;
		$length = $length > 0 ? $length : 1;
		
		if (!$this->is_login())
			return $this->_json_response(array(), 777, 'has not login');
		
		$customer_id = $this->session->userdata('customer_id');
		$this->load->model('order_model');
		$orders = $this->order_model->get($customer_id, $start, $length);
		/*细节**/
		$detail_ids = array();
		foreach ($orders as $order)
		{
			foreach ($order->single_items as $single_item)
			{
				!empty($single_item->single_item_backbag) && intval($single_item->single_item_backbag) > 0 ?  array_push($detail_ids, $single_item->single_item_backbag) : '';
				!empty($single_item->single_item_color) && intval($single_item->single_item_color) > 0 ?  array_push($detail_ids, $single_item->single_item_color) : '';
				!empty($single_item->single_item_fastener) && intval($single_item->single_item_fastener) > 0 ?  array_push($detail_ids, $single_item->single_item_fastener) : '';
				!empty($single_item->single_item_linecolor) && intval($single_item->single_item_linecolor) > 0 ?  array_push($detail_ids, $single_item->single_item_linecolor) : '';
				!empty($single_item->single_item_metal) && intval($single_item->single_item_metal) > 0 ?  array_push($detail_ids, $single_item->single_item_metal) : '';
				!empty($single_item->single_item_placket) && intval($single_item->single_item_placket) > 0 ?  array_push($detail_ids, $single_item->single_item_placket) : '';
				!empty($single_item->single_item_plate) && intval($single_item->single_item_plate) > 0 ?  array_push($detail_ids, $single_item->single_item_plate) : '';
				!empty($single_item->single_item_thickness) && intval($single_item->single_item_thickness) > 0 ?  array_push($detail_ids, $single_item->single_item_thickness) : '';
				!empty($single_item->single_item_trouserstype) && intval($single_item->single_item_trouserstype) > 0 ?  array_push($detail_ids, $single_item->single_item_trouserstype) : '';
				!empty($single_item->single_item_alternative1) && intval($single_item->single_item_alternative1) > 0 ?  array_push($detail_ids, $single_item->single_item_alternative1) : '';
				!empty($single_item->single_item_alternative2) && intval($single_item->single_item_alternative2) > 0 ?  array_push($detail_ids, $single_item->single_item_alternative2) : '';
				!empty($single_item->single_item_alternative3) && intval($single_item->single_item_alternative3) > 0 ?  array_push($detail_ids, $single_item->single_item_alternative3) : '';
				!empty($single_item->single_item_alternative4) && intval($single_item->single_item_alternative4) > 0 ?  array_push($detail_ids, $single_item->single_item_alternative4) : '';
				!empty($single_item->single_item_alternative5) && intval($single_item->single_item_alternative5) > 0 ?  array_push($detail_ids, $single_item->single_item_alternative5) : '';
				!empty($single_item->single_item_alternative6) && intval($single_item->single_item_alternative6) > 0 ?  array_push($detail_ids, $single_item->single_item_alternative6) : '';
				!empty($single_item->single_item_alternative7) && intval($single_item->single_item_alternative7) > 0 ?  array_push($detail_ids, $single_item->single_item_alternative7) : '';
			}
			
		}
		$this->load->model('item_detail_model');
		$details_temp = $this->item_detail_model->get_details($detail_ids);
		
		$details = array();
		foreach ($details_temp as $detail)
			$details[$detail->detail_id] = $detail;
		
		foreach ($orders as &$order)
		{
			foreach ($order->single_items as &$single_item)
			{
				$single_item->markup = 0;
				!empty($single_item->single_item_backbag) && intval($single_item->single_item_backbag) > 0 ?  
				($single_item->single_item_backbag = $details[$single_item->single_item_backbag]) && ($single_item->markup +=  $single_item->single_item_backbag->detail_attach_price) : '';
				!empty($single_item->single_item_color) && intval($single_item->single_item_color) > 0 ?  
				($single_item->single_item_color = $details[$single_item->single_item_color]) && ($single_item->markup +=  $single_item->single_item_color->detail_attach_price) : '';
				!empty($single_item->single_item_fastener) && intval($single_item->single_item_fastener) > 0 ? 
				 ($single_item->single_item_fastener = $details[$single_item->single_item_fastener]) && ($single_item->markup +=  $single_item->single_item_fastener->detail_attach_price) : '';
				!empty($single_item->single_item_linecolor) && intval($single_item->single_item_linecolor) > 0 ? 
				 ($single_item->single_item_linecolor = $details[$single_item->single_item_linecolor]) && ($single_item->markup +=  $single_item->single_item_linecolor->detail_attach_price) : '';
				!empty($single_item->single_item_metal) && intval($single_item->single_item_metal) > 0 ? 
				 ($single_item->single_item_metal = $details[$single_item->single_item_metal]) && ($single_item->markup +=  $single_item->single_item_metal->detail_attach_price) : '';
				!empty($single_item->single_item_placket) && intval($single_item->single_item_placket) > 0 ? 
				 ($single_item->single_item_placket = $details[$single_item->single_item_placket]) && ($single_item->markup +=  $single_item->single_item_placket->detail_attach_price) : '';
				!empty($single_item->single_item_plate) && intval($single_item->single_item_plate) > 0 ? 
				 ($single_item->single_item_plate = $details[$single_item->single_item_plate]) && ($single_item->markup += $single_item->single_item_plate->detail_attach_price) : '';
				!empty($single_item->single_item_thickness) && intval($single_item->single_item_thickness) > 0 ? 
				 ($single_item->single_item_thickness = $details[$single_item->single_item_thickness]) && ($single_item->markup +=  $single_item->single_item_thickness->detail_attach_price) : '';
				!empty($single_item->single_item_trouserstype) && intval($single_item->single_item_trouserstype) > 0 ? 
				 ($single_item->single_item_trouserstype = $details[$single_item->single_item_trouserstype]) && ($single_item->markup +=  $single_item->single_item_trouserstype->detail_attach_price) : '';
				
				!empty($single_item->single_item_alternative1) && intval($single_item->single_item_alternative1) > 0 ? 
				 ($single_item->single_item_alternative1 = $details[$single_item->single_item_alternative1]) && ($single_item->markup +=  $single_item->single_item_alternative1->detail_attach_price) : '';
				!empty($single_item->single_item_alternative2) && intval($single_item->single_item_alternative2) > 0 ? 
				 ($single_item->single_item_alternative2 = $details[$single_item->single_item_alternative2]) && ($single_item->markup +=  $single_item->single_item_alternative2->detail_attach_price) : '';
				!empty($single_item->single_item_alternative3) && intval($single_item->single_item_alternative3) > 0 ? 
				 ($single_item->single_item_alternative3 = $details[$single_item->single_item_alternative3]) && ($single_item->markup +=  $single_item->single_item_alternative3->detail_attach_price) : '';
				!empty($single_item->single_item_alternative4) && intval($single_item->single_item_alternative4) > 0 ? 
				 ($single_item->single_item_alternative4 = $details[$single_item->single_item_alternative4]) && ($single_item->markup +=  $single_item->single_item_alternative4->detail_attach_price) : '';
				!empty($single_item->single_item_alternative5) && intval($single_item->single_item_alternative5) > 0 ? 
				 ($single_item->single_item_alternative5 = $details[$single_item->single_item_alternative5]) && ($single_item->markup +=  $single_item->single_item_alternative5->detail_attach_price) : '';
				!empty($single_item->single_item_alternative6) && intval($single_item->single_item_alternative6) > 0 ? 
				 ($single_item->single_item_alternative6 = $details[$single_item->single_item_alternative6]) && ($single_item->markup +=  $single_item->single_item_alternative6->detail_attach_price) : '';
				!empty($single_item->single_item_alternative7) && intval($single_item->single_item_alternative7) > 0 ? 
				 ($single_item->single_item_alternative7 = $details[$single_item->single_item_alternative7]) && ($single_item->markup +=  $single_item->single_item_alternative7->detail_attach_price) : '';
			}
				
		}
		unset($order);
		
		if ($this->need_rate_exchange())
		{
			$this->monetary_exchange($orders, array('order_sum'));
			foreach ($orders as $order)
			{
				$this->monetary_exchange($order->single_items, array('item_price'));
			}
		}

		foreach ($orders as $order)
		{
			$this->_splite_photos($order->single_items);
		}

		return $this->_json_response(array('orders'=>$orders));
	}
	
	
	//下单，未完成付款接口
	public function doOrder()
	{
		$email = trim($this->input->post('email'));
		$receiver_name = trim($this->input->post('receiver_name'));
		$phone = trim($this->input->post('phone'));

		$province = trim($this->input->post('province'));
		$city = trim($this->input->post('city'));
		$address = trim($this->input->post('address'));
		
		$pay_tool = intval(trim($this->input->post('pay_tool')));
		$message = trim($this->input->post('message'));
		$discount_code = trim($this->input->post('discount_code'));

		//信息基本检查
		if(!$this->is_login() && $this->_isempty($email))
			return $this->_json_response(array(), '777', 'param empty');
		if ($this->_isempty($receiver_name, $phone, $province, $city, $address, $pay_tool))
			return $this->_json_response(array(), '777', 'param empty');
		if (!$this->is_login() && preg_match(self::RE_EMAIL, $email) != 1)
			return $this->_json_response(array(), 777, 'email invalid');
		if (strlen($receiver_name) == 0 || strlen($phone) == 0 || strlen($province) == 0 || strlen($city) == 0 ||
				 strlen($address) == 0 || strlen($pay_tool) == 0)
			return $this->_json_response(array(), '777', 'param error');
		if($pay_tool !== 1 && $pay_tool !== 0)
			return $this->_json_response(array(), '777', 'pay tool error');
		if (!empty($discount_code) && strlen($discount_code) != 8)
			return $this->_json_response(array(), '777', 'param error');
		
		$receiver_area = $province.','.$city;
		$create_user = FALSE;
		
		//根据用户登录情况选择操作
		if (!$this->is_login())
		{
			$create_user = TRUE;
			//创建一个新账户
			//检查邮箱是否已经被使用
			$this->load->model('customer_model');
			$customer = $this->customer_model->get_by_email($email);
			if ($customer != null)
				return $this->_json_response(array(), '777', 'email exist');
			$password = $phone;
			$customer_id = -1;
			if (($customer_id = $this->customer_model->add($email, $password)) == -1)
				return $this->_json_response(array(), '777', 'create user fail');

			//mail('chenchuigeng@163.com', 'idjeans账号', '你的账号名为：'.$email.'密码为：'.$password);
			
			//登录操作session设置
			$this->session->set_userdata(
					array(
							'customer_id' => $customer_id,
							'customer_name' => $email,
							'auth' => 'FRONT_OK',
							'monetary' => 'CN'
					)
			);
				
			//将cookie中的东西加到数据库，同登录操作中附加的操作一样
			$this->load->library('cart');
			if(!$this->cart->load_cart($customer_id))
				return $this->_json_response(array(), '777', 'detail error');
		}
		return $this->doOrder_with_login($receiver_name, $receiver_area, $address, $phone, $discount_code, $pay_tool, $message, $create_user, $email);
	}
	
	public function doOrder_with_login($receiver_name, $receiver_area, $address, $phone, $discount_code, $pay_tool, $message, $create_user, $email)
	{
		$customer_id = $this->session->userdata('customer_id');
		//检查收货人是否已存在
		$this->load->model('receiver_model');
		$receivers = $this->receiver_model->get_all($customer_id);
		
		$receiver_id = 0;
		$receiver_exist = FALSE;
		foreach ($receivers as $receiver)
		{
			if ($receiver->receiver_name == $receiver_name && $receiver->receiver_area == $receiver_area 
					&& $receiver->receiver_address == $address && $receiver->receiver_phone == $phone
					&& $receiver->customer_id == $customer_id)
			{
				$receiver_exist = TRUE;
				$receiver_id = $receiver->receiver_id;
				break;	
			}
		}	
		//不存在的话，添加到数据库
		if($receiver_exist == FALSE)
		{
			$receiver_id = $this->receiver_model->add($customer_id, $receiver_name, $receiver_area, $address, $phone, 0);
		}
		
		//获得购物车，计算出总额
		$this->load->model('cart_item_model');
		$cart_items = $this->cart_item_model->get_by_customer_id($customer_id);
		if (count($cart_items) == 0)
			return $this->_json_response(array(), 777, 'cart empty');
		$cart_id = $cart_items[0]->cart_id;
		$item_ids = array();
		$detail_ids = array();
		foreach ($cart_items as $cart_item)
		{
			array_push($item_ids, $cart_item->item_id);
			
			!empty( $cart_item->single_item_thickness) && intval( $cart_item->single_item_thickness) > 0 ? array_push($detail_ids, $cart_item->single_item_thickness) : '';
			!empty( $cart_item->single_item_color) && intval( $cart_item->single_item_color) > 0 ? array_push($detail_ids, $cart_item->single_item_color) : '';
			!empty( $cart_item->single_item_metal) && intval( $cart_item->single_item_metal) > 0 ? array_push($detail_ids, $cart_item->single_item_metal) : '';
			!empty( $cart_item->single_item_linecolor) && intval( $cart_item->single_item_linecolor) > 0 ? array_push($detail_ids, $cart_item->single_item_linecolor) : '';
			!empty( $cart_item->single_item_plate) && intval( $cart_item->single_item_plate) > 0 ? array_push($detail_ids, $cart_item->single_item_plate) : '';
			!empty( $cart_item->single_item_fastener) && intval( $cart_item->single_item_fastener) > 0 ? array_push($detail_ids, $cart_item->single_item_fastener) : '';
			!empty( $cart_item->single_item_placket) && intval( $cart_item->single_item_placket) > 0 ? array_push($detail_ids, $cart_item->single_item_placket) : '';
			!empty( $cart_item->single_item_trouserstype) && intval( $cart_item->single_item_trouserstype) > 0 ? array_push($detail_ids, $cart_item->single_item_trouserstype) : '';
			!empty( $cart_item->single_item_backbag) && intval( $cart_item->single_item_backbag) > 0 ? array_push($detail_ids, $cart_item->single_item_backbag) : '';
			!empty( $cart_item->single_item_alternative1) && intval( $cart_item->single_item_alternative1) > 0 ? array_push($detail_ids, $cart_item->single_item_alternative1) : '';
			!empty( $cart_item->single_item_alternative2) && intval( $cart_item->single_item_alternative2) > 0 ? array_push($detail_ids, $cart_item->single_item_alternative2) : '';
			!empty( $cart_item->single_item_alternative3) && intval( $cart_item->single_item_alternative3) > 0 ? array_push($detail_ids, $cart_item->single_item_alternative3) : '';
			!empty( $cart_item->single_item_alternative4) && intval( $cart_item->single_item_alternative4) > 0 ? array_push($detail_ids, $cart_item->single_item_alternative4) : '';
			!empty( $cart_item->single_item_alternative5) && intval( $cart_item->single_item_alternative5) > 0 ? array_push($detail_ids, $cart_item->single_item_alternative5) : '';
			!empty( $cart_item->single_item_alternative6) && intval( $cart_item->single_item_alternative6) > 0 ? array_push($detail_ids, $cart_item->single_item_alternative6) : '';
			!empty( $cart_item->single_item_alternative7) && intval( $cart_item->single_item_alternative7) > 0 ? array_push($detail_ids, $cart_item->single_item_alternative7) : '';
			
		}
		$this->load->model('item_model');
		$items = $this->item_model->get_items_by_ids($item_ids);
		$s_items = array();
		foreach ($items as $item)
		{
			$s_items[$item->item_id] = $item;
		}
		
		$this->load->model('item_detail_model');
		$details_temp = $this->item_detail_model->get_details($detail_ids);
		
		$details = array();
		foreach ($details_temp as $detail)
			$details[$detail->detail_id] = $detail;
		
		$total_price = 0;
		foreach ($cart_items as $cart_item)
		{
			$markup = 0;
			!empty( $cart_item->single_item_thickness) && intval( $cart_item->single_item_thickness) > 0 ? $markup += $details[$cart_item->single_item_thickness]->detail_attach_price : '';
			!empty( $cart_item->single_item_color) && intval( $cart_item->single_item_color) > 0 ? $markup += $details[$cart_item->single_item_color]->detail_attach_price : '';
			!empty( $cart_item->single_item_metal) && intval( $cart_item->single_item_metal) > 0 ? $markup += $details[$cart_item->single_item_metal]->detail_attach_price : '';
			!empty( $cart_item->single_item_linecolor) && intval( $cart_item->single_item_linecolor) > 0 ? $markup += $details[$cart_item->single_item_linecolor]->detail_attach_price : '';
			!empty( $cart_item->single_item_plate) && intval( $cart_item->single_item_plate) > 0 ? $markup += $details[$cart_item->single_item_plate]->detail_attach_price : '';
			!empty( $cart_item->single_item_fastener) && intval( $cart_item->single_item_fastener) > 0 ? $markup += $details[$cart_item->single_item_fastener]->detail_attach_price : '';
			!empty( $cart_item->single_item_placket) && intval( $cart_item->single_item_placket) > 0 ? $markup += $details[$cart_item->single_item_placket]->detail_attach_price : '';
			!empty( $cart_item->single_item_trouserstype) && intval( $cart_item->single_item_trouserstype) > 0 ? $markup += $details[$cart_item->single_item_trouserstype]->detail_attach_price : '';
			!empty( $cart_item->single_item_backbag) && intval( $cart_item->single_item_backbag) > 0 ? $markup += $details[$cart_item->single_item_backbag]->detail_attach_price : '';
			!empty( $cart_item->single_item_alternative1) && intval( $cart_item->single_item_alternative1) > 0 ? $markup += $details[$cart_item->single_item_alternative1]->detail_attach_price : '';
			!empty( $cart_item->single_item_alternative2) && intval( $cart_item->single_item_alternative2) > 0 ? $markup += $details[$cart_item->single_item_alternative2]->detail_attach_price : '';
			!empty( $cart_item->single_item_alternative3) && intval( $cart_item->single_item_alternative3) > 0 ? $markup += $details[$cart_item->single_item_alternative3]->detail_attach_price : '';
			!empty( $cart_item->single_item_alternative4) && intval( $cart_item->single_item_alternative4) > 0 ? $markup += $details[$cart_item->single_item_alternative4]->detail_attach_price : '';
			!empty( $cart_item->single_item_alternative5) && intval( $cart_item->single_item_alternative5) > 0 ? $markup += $details[$cart_item->single_item_alternative5]->detail_attach_price : '';
			!empty( $cart_item->single_item_alternative6) && intval( $cart_item->single_item_alternative6) > 0 ? $markup += $details[$cart_item->single_item_alternative6]->detail_attach_price : '';
			!empty( $cart_item->single_item_alternative7) && intval( $cart_item->single_item_alternative7) > 0 ? $markup += $details[$cart_item->single_item_alternative7]->detail_attach_price : '';
			
			$total_price += ($s_items[$cart_item->item_id]->item_price + $markup) * $cart_item->single_item_count;
		}
		
		
		//获得优惠劵，看看是否合法，合法的话，从总额中减去优惠额
		$discount_id = 0;
		if(!empty($discount_code))
		{
			$this->load->model('discount_model');
			
			//是否全局的
			$discount = $this->discount_model->get_global_by_code($discount_code);
			if ($discount != null)
			{
				$total_price -= $discount->minus_price;
				$discount_id = $discount->discount_id;
			}
			else 
			{
				//是否个人优惠劵
				$discount = $this->discount_model->get_personal($discount_code);
				if($discount == null)
					return $this->_json_response(array(), '777', 'discount NOT EXIST');
				
				$total_price -= $discount->minus_price;
				$this->discount_model->to_invalid($discount->discount_id);
				$discount_id = $discount->discount_id;
			}
		}
		
		//支付完成的话，将留言，cartID等加入到订单表
		$this->load->model('order_model');
		$message = (empty($message) || (strlen($message) == 0)) ? null : $message;
		$order_id = $this->order_model->add($cart_id, $receiver_id, $total_price, 1, NULL, $message, null, null);
		if($order_id == -1)
			return $this->_json_response(array(), '777', 'db error');
		
		$this->load->model('order_discount_model');
		if($discount_id != 0)
			$this->order_discount_model->add($order_id, $discount_id);
		//将cart设置为has_paid
		$this->load->model('cart_model');
		if ($this->cart_model->cart_pay($cart_id) == FALSE)
			return $this->_json_response(array(), '777', 'db error');
		
		//根据支付方式，跳到相应的应用支付
		$html_text = '';
		if ($pay_tool == 0){
			//支付宝
			$html_text = $this->alipay($order_id, $receiver_name, $receiver_area, $address, $phone, $total_price, $create_user);
		}
		else{
			//paypal
			$html_text = $this->paypal($order_id, $receiver_name, $receiver_area, $address, $phone, $total_price, $create_user);
		}
		
		if ($html_text == '')
			return $this->_json_response(array(), '777', 'pay fail');
		
		return $this->_json_response(array('html_text'=>$html_text));
	}
	
	public function pay_unpaid_order()
	{
		if(!$this->is_login())
			return $this->_json_response(array(), '777', 'NOT LOGIN');
		
		$pay_tool = intval($this->input->get('pay_tool'));
		$order_id = intval($this->input->get('order_id'));
		
		if ($this->_isempty($pay_tool, $order_id))
			return $this->_json_response(array(), '777', 'param empty');
		if($pay_tool !== 1 && $pay_tool !== 0)
			return $this->_json_response(array(), '777', 'pay tool error');
		//判断order_id存在且属于这个用户
		$this->load->model('order_model');
		$order = $this->order_model->get_single($order_id);
		if($order == null)
			return $this->_json_response(array(), '777', 'NOT EXIST');
		$this->load->model('receiver_model');
		$receiver = $this->receiver_model->get($order->receiver_id);
		if($receiver->customer_id != $this->session->userdata('customer_id'))
			return $this->_json_response(array(), '777', 'NOT YOUR ORDER');
		//根据支付方式，跳到相应的应用支付
		$html_text = '';
		if ($pay_tool == 0){
			//支付宝
			$html_text = $this->alipay($order_id, $receiver->receiver_name, $receiver->receiver_area, $receiver->receiver_address, $receiver->receiver_phone, $order->order_sum, 0);
		}
		else{
			//paypal
			$html_text = $this->paypal($order_id, $receiver->receiver_name, $receiver->receiver_area, $receiver->receiver_address, $receiver->receiver_phone, $order->order_sum, 0);
		}
		
		if ($html_text == '')
			return $this->_json_response(array(), '777', 'pay fail');
		
		return $this->_json_response(array('html_text'=>$html_text));
	}
	
	public function alipay($order_id, $rec_name, $receiver_area, $address, $phone, $total_price, $create_user)
	{
		//加载支付宝接口类文件
		require APPPATH.'third_party/alipay/alipay_submit.class.php';
		$this->config->load('alipay_config');
		$alipay_config = $this->config->item('alipay_config');
	
		//require_once("alipay.config.php");
	
		/**************************请求参数**************************/
	
		//支付类型
		$payment_type = "1";
		//必填，不能修改
		$this->load->helper('url');
		//服务器异步通知页面路径
		$notify_url = site_url('order/do_notify');
		//需http://格式的完整路径，不能加?id=123这类自定义参数
	
		//页面跳转同步通知页面路径
		$return_url = site_url('order/do_return').'/'.($create_user == TRUE? 1 : 0);
		//需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
	
		//卖家支付宝帐户
		$seller_email = $alipay_config['seller_email'];
		//必填
	
		//商户订单号
		$out_trade_no = $order_id;
		//商户网站订单系统中唯一订单号，必填
	
		//订单名称
		$subject = 'idjeans牛仔裤定制优品';
		//必填
	
		//付款金额
		$price = $total_price;
		//必填
	
		//商品数量
		$quantity = "1";
		//必填，建议默认为1，不改变值，把一次交易看成是一次下订单而非购买一件商品
		//物流费用
		$logistics_fee = "0.00";
		//必填，即运费
		//物流类型
		$logistics_type = "EXPRESS";
		//必填，三个值可选：EXPRESS（快递）、POST（平邮）、EMS（EMS）
		//物流支付方式
		$logistics_payment = "SELLER_PAY";
		//必填，两个值可选：SELLER_PAY（卖家承担运费）、BUYER_PAY（买家承担运费）
		//订单描述
	
		$body = 'idjeans牛仔裤定制优品';
		//商品展示地址
		//$show_url = ;
		//需以http://开头的完整路径，如：http://www.xxx.com/myorder.html
	
		//收货人姓名
		$receive_name = $rec_name;
		//如：张三
	
		//收货人地址
		$receive_address = $receiver_area.$address;
		//如：XX省XXX市XXX区XXX路XXX小区XXX栋XXX单元XXX号
	
		//收货人邮编
		$receive_zip = '';
		//如：123456
	
		//收货人电话号码
		$receive_phone = $phone;
		//如：0571-88158090
	
		//收货人手机号码
		$receive_mobile = $phone;
		//如：13312341234
	
	
		/************************************************************/
	
		//构造要请求的参数数组，无需改动
		$parameter = array(
				"service" => "create_partner_trade_by_buyer",
				"partner" => trim($alipay_config['partner']),
				"payment_type"	=> $payment_type,
				"notify_url"	=> $notify_url,
				"return_url"	=> $return_url,
				"seller_email"	=> $seller_email,
				"out_trade_no"	=> $out_trade_no,
				"subject"	=> $subject,
				"price"	=> $price,
				"quantity"	=> $quantity,
				"logistics_fee"	=> $logistics_fee,
				"logistics_type"	=> $logistics_type,
				"logistics_payment"	=> $logistics_payment,
				"body"	=> $body,
				//"show_url"	=> $show_url,
				"receive_name"	=> $receive_name,
				"receive_address"	=> $receive_address,
				"receive_zip"	=> $receive_zip,
				"receive_phone"	=> $receive_phone,
				"receive_mobile"	=> $receive_mobile,
				"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
		);
	
		//建立请求
		$alipaySubmit = new AlipaySubmit($alipay_config);
		$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
		return $html_text;
	}
	
	public function paypal($order_id, $rec_name, $receiver_area, $address, $phone, $total_price, $create_user)
	{
		
		require APPPATH.'third_party/paypal/CallerService.php';
		session_start();
		$this->load->helper('url');
		
		
		//*************************************
		if(! isset($_REQUEST['token'])) {
		
			/* The servername and serverport tells PayPal where the buyer
			 should be directed back to after authorizing payment.
			In this case, its the local webserver that is running this script
			Using the servername and serverport, the return URL is the first
			portion of the URL that buyers will return to after authorizing payment
			*/
			$serverName = $_SERVER['SERVER_NAME'];
			$serverPort = $_SERVER['SERVER_PORT'];
			$url=dirname('http://'.$serverName.':'.$serverPort.$_SERVER['REQUEST_URI']);
		
		
			$currencyCodeType='USD';
			$paymentType='Sale';
			
			$personName        = $rec_name;
			$SHIPTOSTREET      = $address;
			$SHIPTOCITY        = $receiver_area;
			$SHIPTOSTATE	   = $receiver_area;
			$SHIPTOCOUNTRYCODE = $receiver_area;
			$SHIPTOZIP         = '';
			$L_NAME0           = '个性定制牛仔裤';
			$L_AMT0            = $total_price;
			$L_QTY0            = 1;
			
			
			/* Construct the parameter string that describes the PayPal payment
			 the varialbes were set in the web form, and the resulting string
			is stored in $nvpstr
			*/
			//$itemamt = 0.00;
			//$itemamt = $L_QTY0*$L_AMT0;
			//$amt = 5.00+2.00+1.00+$itemamt;
			//$amt = $itemamt;
			//$maxamt= $amt+25.00;
			$amt = $L_AMT0*$L_QTY0;
			$nvpstr="";
		
			
			$amt = ceil($this->get_monetary() * $amt);
			
			/* The returnURL is the location where buyers return when a
			 payment has been succesfully authorized.
			The cancelURL is the location buyers are sent to when they hit the
			cancel button during authorization of payment during the PayPal flow
			*/
			$create_user = ($create_user == TRUE ? 1 : 0);
			$returnURL =urlencode($url.'/reviewOrderForPaypal?currencyCodeType='.$currencyCodeType.'&newuser='.$create_user.'&paymentType='.$paymentType."&paymentAmount=".$amt);
			$cancelURL =urlencode(site_url('order') );
		
			
			
			/*
			 * Setting up the Shipping address details
			*/
			/* $shiptoAddress = "&SHIPTONAME=$personName
				&SHIPTOSTREET=$SHIPTOSTREET
				&SHIPTOCITY=$SHIPTOCITY
				&SHIPTOSTATE=$SHIPTOSTATE
				&SHIPTOCOUNTRYCODE=$SHIPTOCOUNTRYCODE
				&SHIPTOZIP=$SHIPTOZIP";
			 
			$nvpstr="&ADDRESSOVERRIDE=1.
				$shiptoAddress.
				&L_NAME0=".$L_NAME0.
				"&L_AMT0=".$L_AMT0.
				"&L_QTY0=".$L_QTY0.
				"&MAXAMT=".(string)$maxamt.
				"&AMT=".(string)$amt.
				"&ITEMAMT=".(string)$itemamt.
				"&CALLBACKTIMEOUT=4".
				"&L_SHIPPINGOPTIONAMOUNT1=8.00".
				"&L_SHIPPINGOPTIONlABEL1=UPS Next Day Air".
				"&L_SHIPPINGOPTIONNAME1=UPS Air".
				"&L_SHIPPINGOPTIONISDEFAULT1=true".
				"&L_SHIPPINGOPTIONAMOUNT0=3.00".
				"&L_SHIPPINGOPTIONLABEL0=UPS Ground 7 Days".
				"&L_SHIPPINGOPTIONNAME0=Ground".
				"&L_SHIPPINGOPTIONISDEFAULT0=false".
				"&INSURANCEAMT=1.00".
				"&INSURANCEOPTIONOFFERED=true".
				"&CALLBACK=https://www.ppcallback.com/callback.pl".
				"&SHIPPINGAMT=8.00".
				"&SHIPDISCAMT=-3.00".
				"&TAXAMT=2.00".
				"&L_NUMBER0=1000".
				"&L_DESC0=Size: 8.8-oz".
				"&L_NUMBER1=10001".
				"&L_DESC1=Size: Two 24-piece boxes".
				"&L_ITEMWEIGHTVALUE1=0.5".
				"&L_ITEMWEIGHTUNIT1=lbs".
				"&ReturnUrl=".$returnURL.
				"&CANCELURL=".$cancelURL.
				"&CURRENCYCODE=".$currencyCodeType.
				"&PAYMENTACTION=".$paymentType;  */
			$nvpstr = "&AMT=".$amt."&"."&ReturnUrl=".$returnURL."&CANCELURL=".$cancelURL."&INVNUM=".$order_id."&NOSHIPPING=1";
			
			/* $nvpstr = "&PAYMENTREQUEST_0_AMT=$total_price&REQCONFIRMSHIPPING=1&NOSHIPPING=0&PAYMENTREQUEST_0_SHIPTONAME=$rec_name
			&PAYMENTREQUEST_0_SHIPTOSTREET=$address&PAYMENTREQUEST_0_SHIPTOCITY=$receiver_area&PAYMENTREQUEST_0_SHIPTOSTATE=$receiver_area
			&PAYMENTREQUEST_0_SHIPTOZIP=123123&PAYMENTREQUEST_0_SHIPTOPHONENUM=$phone&PAYMENTREQUEST_0_ITEMAMT=$total_price
			&PAYMENTREQUEST_0_INVNUM=$order_id&PAYMENTREQUEST_0_NOTIFYURL=www.a.com"; */
			
			//$nvpstr = $nvpHeader.$nvpstr;
			 
			/* Make the call to PayPal to set the Express Checkout token
			 If the API call succeded, then redirect the buyer to PayPal
			to begin to authorize payment.  If an error occured, show the
			resulting errors
			*/
			$resArray=hash_call("SetExpressCheckout",$nvpstr);
			$_SESSION['reshash']=$resArray;
		
			$ack = strtoupper($resArray["ACK"]);
			if($ack=="SUCCESS"){
				// Redirect to paypal.com here
				$token = urldecode($resArray["TOKEN"]);
				$payPalURL = PAYPAL_URL.$token;
				$sHtml = "<form name='paypalSubmit' action='".$payPalURL."' method='post'></form>";
				$sHtml = $sHtml."<script>document.forms['paypalSubmit'].submit();</script>";
				return $sHtml;
			
			} else  {
				echo "APIERROR";
			}
			
		}
		//********************************************************
		/* 
		$paypal->add_field( 'PAYMENTREQUEST_0_AMT', $total_price);
		$paypal->add_field( 'REQCONFIRMSHIPPING', 1);
		$paypal->add_field( 'NOSHIPPING', 0);
		$paypal->add_field( 'PAYMENTREQUEST_0_SHIPTONAME', $rec_name);
		$paypal->add_field( 'PAYMENTREQUEST_0_SHIPTOSTREET', $address);
		$paypal->add_field( 'PAYMENTREQUEST_0_SHIPTOCITY', $receiver_area);
		$paypal->add_field( 'PAYMENTREQUEST_0_SHIPTOSTATE', $receiver_area);
		$paypal->add_field( 'PAYMENTREQUEST_0_SHIPTOZIP', '');
		$paypal->add_field( 'PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE', '');
		$paypal->add_field( 'PAYMENTREQUEST_0_SHIPTOPHONENUM', $phone);
		$paypal->add_field( 'PAYMENTREQUEST_0_ITEMAMT', $total_price);
		//$paypal->add_field( 'PAYMENTREQUEST_0_SHIPPINGAMT', 0);
		//$paypal->add_field( 'PAYMENTREQUEST_0_INSURANCEAMT', 0);
		$paypal->add_field( 'PAYMENTREQUEST_0_INVNUM', $order_id);
		$paypal->add_field( 'PAYMENTREQUEST_0_NOTIFYURL', ''); */
		
	}
	
	public function nodify_for_paypal()
	{
		require APPPATH.'third_party/alipay/alipay_notify.class.php';
		logResult('4');
		
		//从 PayPal 出读取 POST 信息同时添加变量„cmd‟
		$req = 'cmd=_notify-validate';
		foreach ($_POST as $key => $value) {
			$value = urlencode(stripslashes($value));
			$req .= "&$key=$value";
		}
		//建议在此将接受到的信息记录到日志文件中以确认是否收到 IPN 信息
		//将信息 POST 回给 PayPal 进行验证
		$header .= "POST /cgi-bin/webscr HTTP/1.1\r\n";
		$header .= "Content-Type:application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length:" . strlen($req) ."\r\n\r\n";
		//在 Sandbox 情况下，设置：
		$fp = fsockopen('www.sandbox.paypal.com',80,$errno,$errstr,30);
		//$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);
		//将 POST 变量记录在本地变量中
		//该付款明细所有变量可参考：
		//https://www.paypal.com/IntegrationCenter/ic_ipn-pdt-variable-reference.html
		$item_name = $_POST['item_name'];
		$item_number = $_POST['item_number'];
		$payment_status = $_POST['payment_status'];
		$payment_amount = $_POST['mc_gross'];
		$payment_currency = $_POST['mc_currency'];
		$txn_id = $_POST['txn_id'];
		$receiver_email = $_POST['receiver_email'];
		$payer_email = $_POST['payer_email'];
		//…
		//判断回复 POST 是否创建成功
		if (!$fp) {
			//HTTP 错误
		}else {
			//将回复 POST 信息写入 SOCKET 端口
			fputs ($fp, $header .$req);
			//开始接受 PayPal 对回复 POST 信息的认证信息
			while (!feof($fp)) {
				$res = fgets ($fp, 1024);
				//已经通过认证
				if (strcmp ($res, "VERIFIED") == 0) {
					//检查付款状态
					//检查 txn_id 是否已经处理过
					//检查 receiver_email 是否是您的 PayPal 账户中的 EMAIL 地址
					//检查付款金额和货币单位是否正确
					//处理这次付款，包括写数据库
				}else if (strcmp ($res, "INVALID") == 0) {
					//未通过认证，有可能是编码错误或非法的 POST 信息
				}
			}
			fclose ($fp);
		}
	}
	
	public function reviewOrderForPaypal()
	{
		require APPPATH.'third_party/paypal/CallerService.php';
		session_start();
		$this->load->helper('url');
		
		$token =urlencode( $_REQUEST['token']);
		
		/* Build a second API request to PayPal, using the token as the
		 ID to get the details on the payment authorization
		*/
		$nvpstr="&TOKEN=".$token;
		
		/* Make the API call and store the results in an array.  If the
		 call was a success, show the authorization details, and provide
		an action to complete the payment.  If failed, show the error
		*/
		$resArray=hash_call("GetExpressCheckoutDetails",$nvpstr);
		$_SESSION['reshash']=$resArray;
		$ack = strtoupper($resArray["ACK"]);
		
		if($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING'){
		
			//将getExpressCheckoutDetail表单的内容发到DoExpress然后调用它的函数
			
			$_SESSION['token']=$_REQUEST['token'];
			$_SESSION['payer_id'] = $_REQUEST['PayerID'];
			
			$_SESSION['paymentAmount']=$_REQUEST['paymentAmount'];
			$_SESSION['currCodeType']=$_REQUEST['currencyCodeType'];
			$_SESSION['paymentType']=$_REQUEST['paymentType'];
			
			$resArray=$_SESSION['reshash'];
			$_SESSION['TotalAmount']= $resArray['AMT'] + $resArray['SHIPDISCAMT'];
			
			
			ini_set('session.bug_compat_42',0);
			ini_set('session.bug_compat_warn',0);
			
			/* Gather the information to make the final call to
			 finalize the PayPal payment.  The variable nvpstr
			holds the name value pairs
			*/
			$token =urlencode( $_SESSION['token']);
			$paymentAmount =urlencode ($_SESSION['TotalAmount']);
			$paymentType = urlencode($_SESSION['paymentType']);
			$currCodeType = urlencode($_SESSION['currCodeType']);
			$payerID = urlencode($_SESSION['payer_id']);
			$serverName = urlencode($_SERVER['SERVER_NAME']);
			
			$nvpstr='&TOKEN='.$token.'&PAYERID='.$payerID.'&PAYMENTACTION='.$paymentType.'&AMT='.$paymentAmount.'&CURRENCYCODE='.$currCodeType.'&IPADDRESS='.$serverName ;
			
			
			
			/* Make the call to PayPal to finalize payment
			 If an error occured, show the resulting errors
			*/
			$resArray=hash_call("DoExpressCheckoutPayment",$nvpstr);
			
			/* Display the API response back to the browser.
			 If the response from PayPal was a success, display the response parameters'
			If the response was an error, display the errors received using APIError.php.
			*/
			$ack = strtoupper($resArray["ACK"]);
			
			
			if($ack != 'SUCCESS' && $ack != 'SUCCESSWITHWARNING'){
				$_SESSION['reshash']=$resArray;
				$location = "APIError.php";
				header("Location: $location");
			}
			else{
				if ($_REQUEST['newuser'] == 1)
				{
					//logResult("new cus");
					$email = $this->session->userdata('customer_name');
					$this->load->view('cart/pay_create_acount/pay_create_acount_head');
					$this->load->view('header');
					$this->load->view('cart/pay_create_acount/pay_create_acount_content', array('email'=>$email));
					$this->load->view('footer');
					$this->load->view('cart/pay_create_acount/pay_create_acount_trail');
				}
				else
				{
					//logResult("old cus");
					$this->load->view('cart/pay_have_account/pay_have_account_head');
					$this->load->view('header');
					$this->load->view('cart/pay_have_account/pay_have_account_content');
					$this->load->view('footer');
					$this->load->view('cart/pay_have_account/pay_have_account_trail');
				}
			}
		} else  {
			//Redirecting to APIError.php to display errors.
			$location = "APIError.php";
			header("Location: $location");
		}
	}
	
	public function APIError(){
		
		/*************************************************
		 APIError.php
		
		Displays error parameters.
		
		Called by DoDirectPaymentReceipt.php, TransactionDetails.php,
		GetExpressCheckoutDetails.php and DoExpressCheckoutPayment.php.
		
		*************************************************/
		
		session_start();
		$resArray=$_SESSION['reshash'];
	
		
		
		
		  //it will print if any URL errors 
			if(isset($_SESSION['curl_error_no'])) { 
					$errorCode= $_SESSION['curl_error_no'] ;
					$errorMessage=$_SESSION['curl_error_msg'] ;	
					session_unset();	
		
		
		   
		
				echo "Error Number";
				echo $errorCode;
			
				echo "Error Message:";
				echo $errorMessage;
			}
			 else {
		
		
		    
		    require 'ShowAllResponse.php';
			 }
		
				
	}
	
	public function do_return($is_new_customer)
	{
		require APPPATH.'third_party/alipay/alipay_notify.class.php'; 
		$this->config->load('alipay_config');
		$alipay_config = $this->config->item('alipay_config');

		//计算得出通知验证结果
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyReturn();
		if($verify_result) {
			//验证成功
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//请在这里加上商户的业务逻辑程序代码
	
			//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
			//获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
	
			//商户订单号
	
			$out_trade_no = $_GET['out_trade_no'];
	
			//支付宝交易号
	
			$trade_no = $_GET['trade_no'];
	
			//交易状态
			$trade_status = $_GET['trade_status'];
	
	
			if($_GET['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {
				//判断该笔订单是否在商户网站中已经做过处理
				//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
				//如果有做过处理，不执行商户的业务程序
			}
			else {
				//echo "trade_status=".$_GET['trade_status'];
			}
	
			$this->load->helper('url');
			if ($is_new_customer == 1)
			{
				logResult("new cus");
				$email = $this->session->userdata('customer_name');
				$this->load->view('cart/pay_create_acount/pay_create_acount_head');
				$this->load->view('header');
				$this->load->view('cart/pay_create_acount/pay_create_acount_content', array('email'=>$email));
				$this->load->view('footer');
				$this->load->view('cart/pay_create_acount/pay_create_acount_trail');
			}
			else
			{
				logResult("old cus");
				$this->load->view('cart/pay_have_account/pay_have_account_head');
				$this->load->view('header');
				$this->load->view('cart/pay_have_account/pay_have_account_content');
				$this->load->view('footer');
				$this->load->view('cart/pay_have_account/pay_have_account_trail');
			}
	
			//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
	
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		}
		else {
			logResult("验证失败");
			//验证失败
			//如要调试，请看alipay_notify.php页面的verifyReturn函数
			echo "验证失败";
		}
	}
	
	public function do_notify()
	{
		require APPPATH.'third_party/alipay/alipay_notify.class.php';
		$this->config->load('alipay_config');
		$alipay_config = $this->config->item('alipay_config');
	
		//计算得出通知验证结果
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyNotify();
	
		if($verify_result) {//验证成功
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//请在这里加上商户的业务逻辑程序代
	
	
			//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
	
			//获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
	
			//商户订单号
	
			$out_trade_no = $_POST['out_trade_no'];
			$order_id = $out_trade_no;
	
			//支付宝交易号
	
			$trade_no = $_POST['trade_no'];
	
			//交易状态
			$trade_status = $_POST['trade_status'];
			
			logResult($trade_status);
			if($_POST['trade_status'] == 'WAIT_BUYER_PAY') {
				//该判断表示买家已在支付宝交易管理中产生了交易记录，但没有付款
	
				//判断该笔订单是否在商户网站中已经做过处理
				//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
				$this->load->model('order_model');
				$this->order_model->change_status($order_id, 1);
				//如果有做过处理，不执行商户的业务程序
	
				echo "success";		//请不要修改或删除
	
				//调试用，写文本函数记录程序运行情况是否正常
				logResult("1");
			}
			else if($_POST['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {
				//该判断表示买家已在支付宝交易管理中产生了交易记录且付款成功，但卖家没有发货
	
				//判断该笔订单是否在商户网站中已经做过处理
				//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
				$this->load->model('order_model');
				$this->order_model->change_status($order_id, 2);
				//如果有做过处理，不执行商户的业务程序
					
				echo "success";		//请不要修改或删除
	
				//调试用，写文本函数记录程序运行情况是否正常
				logResult("2");
			}
			else if($_POST['trade_status'] == 'WAIT_BUYER_CONFIRM_GOODS') {
				//该判断表示卖家已经发了货，但买家还没有做确认收货的操作
	
				//判断该笔订单是否在商户网站中已经做过处理
				//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
				$this->load->model('order_model');
				$this->order_model->change_status($order_id, 3);
				//如果有做过处理，不执行商户的业务程序
					
				echo "success";		//请不要修改或删除
	
				logResult('3');
				//调试用，写文本函数记录程序运行情况是否正常
				//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
			}
			else if($_POST['trade_status'] == 'TRADE_FINISHED') {
				//该判断表示买家已经确认收货，这笔交易完成
	
				//判断该笔订单是否在商户网站中已经做过处理
				//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
				$this->load->model('order_model');
				$this->order_model->change_status($order_id, 4);
				//如果有做过处理，不执行商户的业务程序
					
				echo "success";		//请不要修改或删除
				logResult('4');
				//调试用，写文本函数记录程序运行情况是否正常
				//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
			}
			else {
				//其他状态判断
				$this->load->model('order_model');
				$this->order_model->change_status($order_id, 5);
				echo "success";
				logResult('0');
				//调试用，写文本函数记录程序运行情况是否正常
				//logResult ("这里写入想要调试的代码变量值，或其他运行的结果记录");
			}
	
			//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
	
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		}
		else {
			//验证失败
			echo "fail";
	
			//调试用，写文本函数记录程序运行情况是否正常
			//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
		}
	}
	
	
	private function _splite_photos($items)
	{
		if (!is_array($items))
			return;
		foreach ($items as $item)
		{
			$item->item_photos = explode('|', $item->item_photo);
			$item->item_small_photos = explode('|', $item->item_small_photo);
			unset($item->item_photo);
			unset($item->item_small_photo);
		}
	}
	
	public function leaveMsg(){
		$order_id = intval($this->input->get('order_id'));
		$msg = $this->input->get('msg');
		$this->load->model('order_model');
		$order = $this->order_model->get_single($order_id);
		if($order == NULL)
			return $this->_json_response(array(), 777, 'order not exist');
		$this->load->model('receiver_model');
		$receiver = $this->receiver_model->get2($order->receiver_id);
		if($receiver->customer_id != $this->session->userdata('customer_id'))
			return $this->_json_response(array(), 777, 'NOT YOUR ORDER');
		$this->order_model->leaveMsg($order_id, $msg);
		return $this->_json_response(array());
	}
	
	public function feedback(){
		$order_id = intval($this->input->get('order_id'));
		$feedback = $this->input->get('feedback');
		$this->load->model('order_model');
		$order = $this->order_model->get_single($order_id);
		if($order == NULL)
			return $this->_json_response(array(), 777, 'order not exist');
		if($order->order_feedback != null)
			return  $this->_json_response(array(), 777, 'HAVE EVER FEEDBACK');
		$this->load->model('receiver_model');
		$receiver = $this->receiver_model->get2($order->receiver_id);
		if($receiver->customer_id != $this->session->userdata('customer_id'))
			return $this->_json_response(array(), 777, 'NOT YOUR ORDER');
		$this->order_model->feedback($order_id, $feedback);
		return $this->_json_response(array());
	}
	
}
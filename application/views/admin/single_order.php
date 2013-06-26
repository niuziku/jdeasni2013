	<div id="main">
    	<div id="nav">
        	<h3>订单</h3>
            <a class="other_link" href="<?php echo site_url('admin/order');?>">返回订单列表</a>
        </div>
        
        <div id="content">
        	<div id="single_order">
            	<div id="single_order_header">
                </div>
            	<div id="single_order_receiver">
                	<h3>收件人信息</h3>
                </div>
                <div id="single_order_item">
                	<h3>商品信息</h3>
                </div>
            </div>
        </div>
    </div>
    
    <script type="application/javascript">
		$(document).ready(function() {
            get_order_list();
        });
		
		var order_id = null;
		var order_express = null;
		var order_express_num = null;
		
		function get_order_list() {
			var url = location.href;
			var last_devide = url.lastIndexOf('/');
			var url_length = url.length;
			var order_num = url.substr(last_devide + 1, url_length - 1);
			
			$.ajax({
				url: admin_url + "order/single_order/" + order_num,
				data: {},
				type: "post",
				dataType: "json",
				success: function(data, textStatus) {
					if(data.code == 0) {
						var data_obj = data.data;
						order_id = data_obj.order_id;
						order_express = data_obj.order_express;
						order_express_num = data_obj.order_express_num;
						
						var order_time = data_obj.order_time;
						var order_sum = parseInt(data_obj.order_sum);
						var order_status = parseInt(data_obj.order_status);
						var order_comment = data_obj.order_comment;
						var order_feedback = data_obj.order_feedback;
						
						var receiver_name = data_obj.receiver_name;
						var receiver_area = data_obj.receiver_area;
						var receiver_address = data_obj.receiver_address;
						var receiver_phone = data_obj.receiver_phone;
						
						var item_array = data_obj.item_array;
						var item_array_length = item_array.length;
						
						var item_name = null;
						var item_price = null;
						var item_type = null;
						
						var item_thickness = null;
						var item_color = null;
						var item_metal = null;
						var item_linecolor = null;
						var item_plate = null;
						var item_fastener = null;
						var item_placket = null;
						var item_count = null;
						var item_sum = null;
						
						var measure_yaowei = null;
						var measure_shengao = null;
						var measure_tizhong = null;
						var measure_kuchang = null;
						var measure_datui = null;
						var measure_jiaowei = null;
						var measure_qiandang = null;
						var measure_tunwei = null;
						var measure_xigai = null;
						var measure_houdang = null;
						
						var detail_array =  data_obj.detail_array;
						
						var thickness_name = null;
						var color_name = null;
						var metal_name = null;
						var linecolor_name = null;
						var plate_name = null;
						var fastener_name = null;
						var placket_name = null;
						var trouserstype_name = null;
						var backbag_name = null;
						
						var thickness_price = 0;
						var color_price = 0;
						var metal_price = 0;
						var linecolor_price = 0;
						var plate_price = 0;
						var fastener_price = 0;
						var placket_price = 0;
						var trouserstype_price = 0;
						var backbag_price = 0;
						
						var minus_price = data_obj.minus_price;
						minus_price = minus_price == null ? 0 : parseInt(minus_price);
						var order_original_sum =  minus_price + order_sum;
						
						if(order_express == null) {
							order_express = "无";
						}
						
						if(order_express_num == null) {
							order_express_num = "无";
						}
						
						if(order_comment == null) {
							order_comment = "无";
						}
						
						if(order_feedback == null) {
							order_feedback = "无";
						}
						
						
						switch(order_status) {
							case 1 : order_status_str = "<h4 class='wait_check'>等待确认</h4>";break;
							case 2 : order_status_str = "<h4 class='making'>制作中</h4>";break;
							case 3 : order_status_str = "<h4 class='sending'>快速配送中</h4>";break;
							case 4 : order_status_str = "<h4 class='finish_sent'>配送完成</h4>";break;
							case 5 : order_status_str = "<h4 class='close_trade'>关闭交易</h4>";break;
							default : order_status_str = "<h4 class='access_fail'>获取订单状态失败</h4>";
						}
						
						$("#single_order_header").append("<div class='order_status'>" + order_status_str + "</div><div class='order_time'>下单于: " + order_time + "</div><div class='status_operate'><select id='status_select' name='order_status'><option value='1'>等待确认</option><option value='2'>制作中</option><option value='3'>快速配送中</option><option value='4'>配送成功</option><option value='5'>关闭交易</option></select><button class='change_button' onclick='change_status()'>更改<button></div>");
						
						if(document.getElementById('status_select').options.length > 0 && order_status < 5) {
							document.getElementById('status_select').options[order_status].selected = true;
						}
						
						$("#single_order_receiver").append("<div class='receiver_name'>收件人：<span>" + receiver_name + "</span></div><div class='receiver_phone'>联系电话：<span>" + receiver_phone + "</span></div><div class='receiver_area'>地区：<span>" + receiver_area + "</span></div><div class='receiver_address'>详细地址：<span>" + receiver_address + "</span></div><div class='order_express'>快递公司：<span>" + order_express + "</span></div><div class='order_express_num'>快递号：<span>" + order_express_num + "</span><button class='change_button' onclick='modify_express()'>修改</button></div><div class='order_comment'>买家留言：<span>" + order_comment + "</span></div><div class='order_feedback'>买家反馈：<span>" + order_feedback + "</span></div>");
						
						$("#single_order_item").append("<div class='item_list'></div><div class='sum_info'><div class='original_sum'>订单小结：<span>" + order_original_sum + "</span></div><div class='discount_money'>折扣优惠： <span>-" + minus_price + "</span></div><div class='order_sum'>实际付款：<span>" + order_sum + "</span></div>");
						
						if(order_express == "无") {
							$("#single_order_receiver .order_express").empty();
							$("#single_order_receiver .order_express_num").empty();
							$("#single_order_receiver .order_express").append("快递公司：<input name='order_express' type='text'>");
							$("#single_order_receiver .order_express_num").append("快递号：<input name='order_express_num' type='text'><button class='change_button' onclick='submit_express()'>提交</button>");
						}
						for(var i = 0; i < item_array_length; i++) {
							item_name = item_array[i].item_name;
							item_type = parseInt(item_array[i].item_type);
							item_price = parseInt(item_array[i].item_price);
						
							item_thickness = item_array[i].single_item_thickness;
							item_color = item_array[i].single_item_color;
							item_metal = item_array[i].single_item_metal;
							item_linecolor = item_array[i].single_item_linecolor;
							item_plate = item_array[i].single_item_plate;
							item_fastener = item_array[i].single_item_fastener;
							item_placket = item_array[i].single_item_placket;
							item_count = parseInt(item_array[i].single_item_count);
							
							item_sum = item_price * item_count;
						
							measure_yaowei = parseInt(item_array[i].measure_yaowei) > 1000 ? 
									'W'+parseInt(item_array[i].measure_yaowei/100) : item_array[i].measure_yaowei;
							
							measure_shengao = item_array[i].measure_shengao;
							measure_tizhong = item_array[i].measure_tizhong;
							measure_kuchang = parseInt(item_array[i].measure_kuchang) > 1000 ? 
									'L'+parseInt(item_array[i].measure_kuchang/100) : item_array[i].measure_kuchang;
							measure_datui = item_array[i].measure_datui;
							measure_jiaowei = item_array[i].measure_jiaowei;
							measure_qiandang = item_array[i].measure_qiandang;
							measure_tunwei = item_array[i].measure_tunwei;
							measure_xigai = item_array[i].measure_xigai;
							measure_houdang = item_array[i].measure_houdang;
							
							thickness_name = detail_array[i].thickness_name;
							color_name = detail_array[i].color_name;
							metal_name = detail_array[i].metal_name;
							linecolor_name = detail_array[i].linecolor_name;
							plate_name = detail_array[i].plate_name;
							fastener_name = detail_array[i].fastener_name;
							placket_name = detail_array[i].placket_name;
							trouserstype_name = detail_array[i].trouserstype_name;
							backbag_name = detail_array[i].backbag_name;
							
							switch(item_type) {
								case 1 : item_type = "洗水牛仔";break;
								case 2 : item_type = "赤耳单宁";break;
								case 3 : item_type = "休闲裤";break;
								default : item_type = "获取商品种类失败";
							}
							
							
							$("#single_order_item .item_list").append("<div class='single_item'><div class='item_summary'><div class='item_name'>" + item_name + "</div><div class='item_type'>（种类：" + item_type + "</div><div class='item_price'>&nbsp;|&nbsp;单价：" + item_price + "）</div><div class='item_count'>数量：" + item_count + "</div></div><div class='item_detail'><div class='item_thickness detail_name'>厚度：" + thickness_name + "</div><div class='item_color detail_name'>颜色：" + color_name + "</div><div class='item_plate detail_name'>板型：" + plate_name + "</div><div class='item_metal detail_name'>撞钉：" + metal_name + "</div><div class='item_linecolor detail_name'>线色：" + linecolor_name + "</div><div class='item_fastener detail_name'>纽扣：" + fastener_name + "</div><div class='item_placket detail_name'>门襟：" + placket_name + "</div><div class='item_trouserstype detail_name'>裤型：" + trouserstype_name + "</div><div class='item_backbag detail_name'>后袋：" + backbag_name + "</div></div><div class='measure_info'><div class='measure_yaowei measure_item'>腰围：" + measure_yaowei + "</div><div class='measure_shengao measure_item'>身高：" + measure_shengao + "</div><div class='measure_tizhong measure_item'>体重：" + measure_tizhong + "</div><div class='measure_kuchang measure_item'>裤长：" + measure_kuchang + "</div><div class='measure_datui measure_item'>大腿：" + measure_datui + "</div><div class='measure_jiaowei measure_item'>脚围：" + measure_jiaowei + "</div><div class='measure_qiandang measure_item'>前档：" + measure_qiandang + "</div><div class='measure_tunwei measure_item'>臀围：" + measure_tunwei + "</div><div class='measure_xigai measure_item'>膝盖：" + measure_xigai + "</div><div class='measure_houdang measure_item'>后档：" + measure_houdang + "</div></div></div>");
						}
					}
					else {
					}
				},
				error: function() {
					
				}
			});
		}
		
		function change_status() {
			var status_index = $("#status_select").val(); 
			if(confirm("确定修改当前订单状态？")) {
				$.ajax({
					url: admin_url + "order/change_status",
					data: {order_id: order_id, status_index: status_index},
					dataType: "json",
					type: "post",
					success: function(data, textStatus){ 
						if(data.code == 0) {
							location.reload();
						}
						else {
						}
					},
					error: function() {
						
					}
				});
			}
		}
		
		function submit_express() {
			var express = $.trim($("#single_order_receiver input[name=order_express]").val());
			var express_num = $.trim($("#single_order_receiver input[name=order_express_num]").val());
			
			if(express == "") {
				alert("请填写快递公司！");
				return false;
			}
			
			if(express_num == "") {
				alert("请填写快递号！");
				return false;
			}
			
			if(!(/^[0-9]*$/.test(express_num))) {
				alert("快递号只能包含数字！");
				return false;
			}
			
			$.ajax({
				url: admin_url + "order/upadte_express",
				data: {order_id: order_id, express: express, express_num: express_num},
				dataType: "json",
				type: "post",
				success: function(data, textStatus){ 
					if(data.code == 0) {
						location.reload();
					}
					else {
					}
				},
				error: function() {
					
				}
			});
		}
		
		function modify_express() {
			$("#single_order_receiver .order_express").empty();
			$("#single_order_receiver .order_express_num").empty();
			
			express_str = (order_express == "无")?"":order_express;
			express_str_num = (order_express_num == "无")?"":order_express_num;
			
			$("#single_order_receiver .order_express").append("快递公司：<input name='order_express' type='text' value='" + express_str + "'>");
			$("#single_order_receiver .order_express_num").append("快递号：<input name='order_express_num' type='text' value='" + express_str_num + "'><button class='change_button' onclick='submit_express()'>提交</button><button class='change_button cancel_button' onclick='cancel_modify_express()'>取消</button>");
		}
		
		function cancel_modify_express() {
			$("#single_order_receiver .order_express").empty();
			$("#single_order_receiver .order_express_num").empty();
			
			$("#single_order_receiver .order_express").append("快递公司：<span>" + order_express + "</span>");
			$("#single_order_receiver .order_express_num").append("快递号：<span>" + order_express_num + "</span><button class='change_button' onclick='modify_express()'>修改</button");
		}
    </script>
	<div id="main">
    	<div id="nav">
        	<h3>订单列表</h3>
        </div>
        
        <div id="content">
        	<ul id="order_list">
            </ul>
        </div>
    </div>
    
    <script type="application/javascript">
	
		var MAX_DISPLAY = 10;
		
		var page_num = 1;
		var page_amount = 1;
		
		$(document).ready(function() {
            get_order_list();
        });
		
		function get_order_list() {
			var url = location.href;
			var page_mark = url.lastIndexOf('page_num=');

			if(page_mark > 0) {
				page_num = parseInt(url.substr(page_mark + 9, url.length - 1));
			}
			else {
				page_num = 1;
			}
			
			$.ajax({
				url: admin_url + "order/order_list/" + page_num,
				data: {},
				type: "post",
				dataType: "json",
				complete: get_page_amount,
				success: function(data, textStatus) {
					if(data.code == 0) {
						var data_length = data.data.length;
						var order_id = null;
						var order_time = null;
						var order_status = null;
						var order_sum = null;
						var order_express = null;
						var order_express_num = null;
						var receiver_name = null;
						var receiver_phone = null;
						var item_array = new Array();
						var item_array_length = 0;
						
						var order_status_str = null;
						var order_area_str = null;
						
						for(var i = 0; i < data_length; i++) {
							order_id = data.data[i].order_id;
							order_time = data.data[i].order_time;
							order_sum = data.data[i].order_sum;
							order_express = data.data[i].order_express;
							order_express_num = data.data[i].order_express_num;
							receiver_name = data.data[i].receiver_name;
							receiver_phone = data.data[i].receiver_phone;
							order_status = parseInt(data.data[i].order_status);
							item_array = data.data[i].item_array;
							item_array_length = item_array.length;
							
							if(order_express == null) {
								order_express = "无";
							}
							
							if(order_express_num == null) {
								order_express_num = "无";
							}
							
							switch(order_status) {
								case 1 : order_status_str = "<h4 class='wait_check'>等待确认</h4>";break;
								case 2 : order_status_str = "<h4 class='making'>制作中</h4>";break;
								case 3 : order_status_str = "<h4 class='sending'>快速配送中</h4>";break;
								case 4 : order_status_str = "<h4 class='finish_sent'>配送完成</h4>";break;
								case 5 : order_status_str = "<h4 class='close_trade'>关闭交易</h4>";break;
								default : order_status_str = "<h4 class='access_fail'>获取订单状态失败</h4>";
							}
							
							$("#order_list").append("<li class='order_item' id='order_" + order_id + "'><div class='order_header'><div class='order_status'>" + order_status_str + "</div><a href='" + admin_url + "order/single/" + order_id + "'>查看/修改订单</a></div><div class='peoson_info'><span class='receiver_name'>收件人：" + receiver_name + "</span><span class='receiver_phone'>联系电话：" + receiver_phone + "</span><span class='order_express'>快递公司：" + order_express + "</span><span class='order_express_num'>快递单号：" + order_express_num + "</span></div><div class='item_info'><div class='single_item'><span class='single_item_title'>购买商品：</span></div><div class='order_sum'>总价：<span>" + order_sum + "</span></div></div><div class='order_time'>下单时间：" + order_time + "</div></li>");
							
							order_area_str = "#order_" + order_id + " .single_item";
							
							for(var j = 0; j < item_array_length; j++) {
								$(order_area_str).append("<span>" + item_array[j].item_name + "</span>");
							}
						}
						
					}
					else {
					}
				},
				error: function() {
					
				}
			});
		}
		
		function get_page_amount() {
			$.ajax({
				url: admin_url + "order/order_amount",
				data: {},
				type: "post",
				dataType: "json",
				complete:setPageNav,
				success: function(data, textStatus) {
					if(data.code == 0) {
						page_amount = Math.ceil(parseInt(data.data.order_amount) / (1.0 * MAX_DISPLAY));
					}
					else {
					}
				},
				error: function() {
					
				}
			});
		}
		
		function setPageNav() {
			var current_page = page_num;
			var before_page = current_page - 1;
			var after_page = current_page + 1;
			
			if(document.getElementById("page")) {
				$("page").remove();
			}
			$("#content").append("<div id='page'><ul id='page_nav'></ul></div>");
			
			
			if(current_page != 1) {
				$("#page_nav").append("<li><li><a href='" + admin_url + "order?page_num=" + before_page + "'>上一页</a></li>");
			}
			
			if(page_amount <= 5) {
				for(var i = 1; i < page_amount; i++) {
					if(current_page == i) {
						$("#page_nav").append("<li class='current_page'>" + current_page + "</li>");
					}
					else {
						$("#page_nav").append("<li><a href='" + admin_url + "order?page_num=" + i + "'>" + i + "</a></li>");
					}
				}
			}
			else {
				if(current_page <=3) {
					for(var i = 1; i <= 5; i++) {
						if(current_page == i) {
							$("#page_nav").append("<li class='current_page'>" + current_page + "</li>");
						}
						else {
							$("#page_nav").append("<li><a href='" + admin_url + "order?page_num=" + i + "'>" + i + "</a></li>");
						}
					}
				}
				else if((page_amount - current_page) < 2) {
					for(var i = page_amount - 4; i <= page_amount; i++) {
						if(current_page == i) {
							$("#page_nav").append("<li class='current_page'>" + current_page + "</li>");
						}
						else {
							$("#page_nav").append("<li><a href='" + admin_url + "order?page_num=" + i + "'>" + i + "</a></li>");
						}
					}
				}
				else {
					for(var i = current_page - 2; i <= current_page + 2; i++) {
						if(current_page == i) {
							$("#page_nav").append("<li class='current_page'>" + current_page + "</li>");
						}
						else {
							$("#page_nav").append("<li><a href='" + admin_url + "order?page_num=" + i + "'>" + i + "</a></li>");
						}
					}
				}
			}
			
			if(page_amount != 0) {
				if(current_page != page_amount) {
					$("#page_nav").append("<li><a href='" + admin_url + "order?page_num=" + after_page + "'>下一页</a></li>");
				}
				$("#page_nav").append("<li>(共" + page_amount + "页)</li>")
			}
		}
    </script>
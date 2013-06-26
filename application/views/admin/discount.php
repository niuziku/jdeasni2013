	<div id="main">
    	<div id="nav">
        	<h3>优惠券列表（有效）</h3>
            <a style="color:#68228B;" class="other_link" href="<?php echo site_url('admin/discount/invalid');?>">无效优惠券</a>
            <span class="other_link"> &nbsp;|&nbsp; </span>
            <a class="other_link" href="<?php echo site_url('admin/discount/add');?>">添加优惠券</a>
        </div>
        <div id="content">
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
		get_list();
	});
	
	function get_list() {
		document.getElementById('content').innerHTML = "<ul id='discount_list'><li class='discount_item'><span class='discount_code'>优惠码</span><span class='discount_type'>优惠类型</span><span class='minus_price'>优惠额度</span><span class='valid'>是否有效</span></li></ul>";
		$.ajax({
			url : admin_url + "discount/discount_list",
			data : {},
			type: "get",
			dataType : "json",
			success : function(data, status) {
				var data_length = data.data.length;
				var discount_id = null;
				var discount_code = null;
				var discount_type = null;
				var minus_price = null;
				var valid = null;
				
				for(var i = 0; i < data_length; i++) {
					discount_id = data.data[i].discount_id;
					discount_code = data.data[i].discount_code;
					discount_type = parseInt(data.data[i].discount_type);
					minus_price = parseInt(data.data[i].minus_price);
					valid = parseInt(data.data[i].valid);
					switch(discount_type) {
						case 1 : discount_type = "一次性优惠券"; break;
						case 2 : discount_type = "可复用优惠券"; break;
						default : discount_type = "未分类优惠券";
					}
					switch(valid) {
						case 0 : valid = "无效"; break;
						case 1 : valid = "有效"; break;
						default : valid = "未知";
					}
					$('#discount_list').append("<li class='discount_item' id='discount_"+ discount_id + "'><span class='discount_code'>" + discount_code + "</span><span class='discount_type'>" + discount_type + "</span><span class='minus_price'>" + minus_price + "</span><span class='valid'>" + valid + "</span><a class='delete_discount' href='javascript:void(0);' onclick='invalid_discount(" + discount_id + ")'>设为无效</a></li>");
				}
			},
			error : function() {
				
			}
		});
	}
	
	function invalid_discount(discount_id) {
		if(confirm("确认设为无效？")) {
			$.ajax({
				url : admin_url + "discount/invalid_discount",
				data : {discount_id:discount_id},
				type: "post",
				dataType : "json",
				success : function(data, status) {
					$('#discount_list').remove();
					get_list();
				},
				error : function() {
					
				}
			});
		}
		else {
			return false;
		}
	}
    </script>
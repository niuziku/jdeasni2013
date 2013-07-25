	<div id="main">
    	<div id="nav">
        	<h3>已下架商品</h3>
            <a class="other_link" href="<?php echo site_url('admin/item');?>">返回商品列表</a>
        </div>
        <div id="content">
        	<div id="type_select">
            	<span>商品类型：
                	<select name="item_type" id="item_type_select">
                    	<option value="1" selected="selected">洗水牛仔</option>
                        <option value="2">赤耳单宁</option>
                        <option value="3">休闲裤</option>
                    </select>
                </span>
                <button onclick="searchType()" class="search_button">筛选</button>
            </div>
        </div>
        <span id="images_folder" style="display:none;"><?php echo base_url('images/'); ?></span>
    </div>
    
    <script type="text/javascript">
		var MAX_DISPLAY = 10;
		
		var page_num = 1;
		var page_amount = 1;
		var type_num = 1;
		
		$(document).ready(function() {
            init();
        });
		
		function init() {
			var url = location.search;
			var type_mark = url.lastIndexOf('type=');
			var page_mark = url.lastIndexOf('page_num=');

			if(type_mark > 0) {
				type_num = parseInt(url.substr(type_mark + 5, page_mark - 2));
				page_num = parseInt(url.substr(page_mark + 9, url.length - 1));
				
			}
			else {
				type_num = 1;
				page_num = 1;
			}
			$("#item_type_select").val(type_num);
			searchOperation();
		}
		
		function searchType() {
			var item_index = $("#item_type_select").val();
			
			type_num = item_index;
			page_num = 1;
			location.href = admin_url + "item/recycle?type=" + type_num + "&page_num=" + page_num;
		}
		
		function searchOperation() {
			
			if(document.getElementById("item_list")) {
				$("#item_list").remove();
			}
			
			$("#content").append("<ul id='item_list'></ul>");
			
			var images_folder = $('#images_folder').text() + '/';
			
			$.ajax({
				url:admin_url + "item/search_offsale_item/" + type_num + "/" + page_num,
				data:{},
				type:"post",
				dataType:"json",
				complete: get_page_amount,
				success: function(data, status) {
					if(data.code == 0) {
						var data_length = data.data.length;
						var item_id = null
						var item_name = null;
						var item_price = null;
						var item_intro = null;
						var item_type = null;
						var item_small_photo = null;
						var item_material_image = null;
						var item_provenance = null;
						var item_weight = null;
						
						var single_item_id = null;
						var item_type_str = null;
						
						for(var i = 0; i < data_length; i++) {
							item_id = data.data[i].item_id;
							item_name = data.data[i].item_name;
							item_price = parseInt(data.data[i].item_price);
							item_intro = data.data[i].item_intro;
							item_type = parseInt(data.data[i].item_type);
							item_small_photo = data.data[i].item_small_photo;
							item_material_image = data.data[i].item_material_image;
							item_provenance = data.data[i].item_provenance;
							item_weight = data.data[i].item_weight;
							
							single_item_id = "single_item" + i;
							photo_id = "item_photo_area" + i;
							photo_id_str = "#" + photo_id;
							
							switch(item_type) {
								case 1: item_type_str = "洗水牛仔"; break;
								case 2: item_type_str = "赤耳丹宁"; break;
								case 3: item_type_str = "休闲裤"; break;
								default: item_type_str = "未分类";
							}
							
							if(item_type == 2) {
								$("#item_list").append("<li id='" + single_item_id + "'><div class='item_info'><span class='material'>商品布料：<img src='" +images_folder + 'selvedge/' + item_material_image + "'</span><span>商品名称：" + item_name + "</span><span>商品种类：" + item_type_str + "</span><span>商品价格：" + item_price + "</span><span>商品产地：" + item_provenance + "</span><span>商品重量：" + item_weight + "</span><span>商品简介：" + item_intro + "</span></div><div class='item_photo_area' id='" + photo_id + "'><div class='link_area'><a class='delete_link' href='javascript:void(0)' onclick='deleteItem(" + item_id + ")'>删除商品</a><a class='onsale_link' href='javascript:void(0)' onclick='onsaleItem(" + item_id + ")'>重新上架</a></div></div></li>");
							}
							else {
								$("#item_list").append("<li id='" + single_item_id + "'><div class='item_info'><span>商品名称：" + item_name + "</span><span>商品种类：" + item_type_str + "</span><span>商品价格：" + item_price + "</span><span>商品简介：" + item_intro + "</span></div><div class='item_photo_area' id='" + photo_id + "'><div class='link_area'><a class='delete_link' href='javascript:void(0)' onclick='deleteItem(" + item_id + ")'>删除商品</a><a class='onsale_link' href='javascript:void(0)' onclick='onsaleItem(" + item_id + ")'>重新上架</a></div></div></li>");
							}
							
							photo_array = item_small_photo.split("|");
							
							for(var j = 0 ; j < photo_array.length; j++) {
								$(photo_id_str).append("<img src='" + images_folder + 'item/' + photo_array[j] + "' />")
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
		
		function onsaleItem(item_id) {
			if(confirm("重新上架该商品？")) {
				$.ajax({
					url:admin_url + "item/onsale_item",
					data:{item_id:item_id},
					type:"post",
					dataType:"json",
					success:function(data) {
						if(data.code == 0) {
							$("#item_list").remove();
							$("#page").remove();
							searchOperation();
						}
						else {
						}
					},
					error:function() {
						
					}
				});
			}
			else {
				return false;
			}
		}
		
		function deleteItem(item_id) {
			if(confirm("若该商品与其他订单相关联，删除后将引起其他表单的变化，建议保留。确认删除？")) {
				$.ajax({
					url:admin_url + "item/delete_item",
					data:{item_id:item_id},
					type:"post",
					dataType:"json",
					success:function(data) {
						if(data.code == 0) {
							$("#item_list").remove();
							$("#page").remove();
							searchOperation();
						}
						else {
						}
					},
					error:function() {
						
					}
				});
			}
			else {
				return false;
			}
		}
		
		
		function get_page_amount() {
			$.ajax({
				url: admin_url + "item/item_offsale_amount/" + type_num,
				data: {},
				type: "post",
				dataType: "json",
				complete:setPageNav,
				success: function(data, textStatus) {
					if(data.code == 0) {
						page_amount = Math.ceil(parseInt(data.data.item_amount) / (1.0 * MAX_DISPLAY));
						
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
				$("#page").remove();
			}
			$("#content").append("<div id='page'><ul id='page_nav'></ul></div>");
			
			
			if(current_page != 1) {
				$("#page_nav").append("<li><li><a href='" + admin_url + "item/recycle?type=" + type_num + "&page_num=" + before_page + "'>上一页</a></li>");
			}
			
			if(page_amount <= 5) {
				for(var i = 1; i <= page_amount; i++) {
					if(current_page == i) {
						$("#page_nav").append("<li class='current_page'>" + current_page + "</li>");
					}
					else {
						$("#page_nav").append("<li><a href='" + admin_url + "item/recycle?type=" + type_num + "&page_num=" + i + "'>" + i + "</a></li>");
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
							$("#page_nav").append("<li><a href='" + admin_url + "item/recycle?type=" + type_num + "&page_num=" + i + "'>" + i + "</a></li>");
						}
					}
				}
				else if((page_amount - current_page) < 2) {
					for(var i = page_amount - 4; i <= page_amount; i++) {
						if(current_page == i) {
							$("#page_nav").append("<li class='current_page'>" + current_page + "</li>");
						}
						else {
							$("#page_nav").append("<li><a href='" + admin_url + "item/recycle?type=" + type_num + "&page_num=" + i + "'>" + i + "</a></li>");
						}
					}
				}
				else {
					for(var i = current_page - 2; i <= current_page + 2; i++) {
						if(current_page == i) {
							$("#page_nav").append("<li class='current_page'>" + current_page + "</li>");
						}
						else {
							$("#page_nav").append("<li><a href='" + admin_url + "item/recycle?type=" + type_num + "&page_num=" + i + "'>" + i + "</a></li>");
						}
					}
				}
			}
			
			if(page_amount != 0) {
				if(current_page != page_amount) {
					$("#page_nav").append("<li><a href='" + admin_url + "item/recycle?type=" + type_num + "&page_num=" + after_page + "'>下一页</a></li>");
				}
				$("#page_nav").append("<li>(共" + page_amount + "页)</li>")
			}
		}
	</script>
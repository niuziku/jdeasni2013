	<div id="main">
    	<div id="nav">
        	<h3>商品列表</h3>
            <a style="color:#68228B;" class="other_link" href="<?php echo site_url('admin/item/recycle');?>">已下架商品</a>
            <span class="other_link"> &nbsp;|&nbsp; </span>
            <a class="other_link" href="<?php echo site_url('admin/item/add');?>">添加商品</a>
        </div>
        <div id="content">
        	<div id="type_select">
            	<span>商品类型：
                	<select name="item_type">
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
		var item_last_index = null;
		
		$(document).ready(function() {
            searchType();
        });
		
		function searchType() {
			var item_index = document.getElementsByName("item_type").item(0).options.selectedIndex;
			
			item_last_index = item_index + 1;
			searchOperation();
		}
		
		function searchOperation() {
			
			if(document.getElementById("item_list")) {
				$("#item_list").remove();
			}
			
			$("#content").append("<ul id='item_list'></ul>");
			
			var images_folder = $('#images_folder').text() + '/';
			
			$.ajax({
				url:admin_url + "item/search_item",
				data:{item_type:item_last_index},
				type:"post",
				dataType:"json",
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
								$("#item_list").append("<li id='" + single_item_id + "'><div class='item_info'><span class='material'>商品布料：<img src='" +images_folder + 'selvedge/' + item_material_image + "'</span><span>商品名称：" + item_name + "</span><span>商品种类：" + item_type_str + "</span><span>商品价格：" + item_price + "</span><span>商品产地：" + item_provenance + "</span><span>商品重量：" + item_weight + "</span><span>商品简介：" + item_intro + "</span></div><div class='item_photo_area' id='" + photo_id + "'><div class='link_area'><a class='delete_link' href='javascript:void(0)' onclick='offsaleItem(" + item_id + ")'>移到下架区</a></div></div></li>");
							}
							else {
								$("#item_list").append("<li id='" + single_item_id + "'><div class='item_info'><span>商品名称：" + item_name + "</span><span>商品种类：" + item_type_str + "</span><span>商品价格：" + item_price + "</span><span>商品简介：" + item_intro + "</span></div><div class='item_photo_area' id='" + photo_id + "'><div class='link_area'><a class='delete_link' href='javascript:void(0)' onclick='offsaleItem(" + item_id + ")'>移到下架区</a></div></div></li>");
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
		
		function offsaleItem(item_id) {
			if(confirm("是否将该商品移动到下架区？")) {
				$.ajax({
					url:admin_url + "item/offsale_item",
					data:{item_id:item_id},
					type:"post",
					dataType:"json",
					success:function(data) {
						if(data.code == 0) {
							$("#item_list").remove();
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
	</script>
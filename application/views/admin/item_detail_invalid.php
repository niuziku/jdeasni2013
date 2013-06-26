	<div id="main">
    	<div id="nav">
        	<h3>无效细节</h3>
            <a class="other_link" href="<?php echo site_url('admin/item_detail');?>">商品细节列表</a>
        </div>
        
        <div id="content">
        	<div id="type_select">
            	<span>商品类型：
                	<select onchange="setDetailType()" name="item_type">
                    	<option value="1" selected="selected">洗水牛仔</option>
                        <option value="2">赤耳单宁</option>
                        <option value="3">休闲裤</option>
                    </select>
                </span>
                <span>细节类型：
                	<select name="detail_type">
                    </select>
                </span>
                <button onclick="searchType()" class="search_button">筛选</button>
            </div>
            
            <span id="images_folder" style="display:none;"><?php echo base_url('images/detail'); ?></span>
        </div>
    </div>
    
	<script type="text/javascript">
        var item_last_value = null;
        var detail_last_value = null;
        
		$(document).ready(function() {
            setDetailType();
			searchType();
        });
		
        function setDetailType() {
            var item_index = document.getElementsByName('item_type').item(0).options.selectedIndex + 1;
            var detail_obj = document.getElementsByName('detail_type').item(0);
            detail_obj.options.length = 0;
            switch(item_index) {
				case 0 : break;
				case 1 : detail_obj.options.add(new Option("厚度", "1"));
						 detail_obj.options.add(new Option("颜色", "2"));
						 detail_obj.options.add(new Option("板型", "3"));
						 detail_obj.options.add(new Option("门襟", "4"));
						 detail_obj.options.add(new Option("纽扣", "5"));
						 detail_obj.options.add(new Option("撞钉", "6"));
						 detail_obj.options.add(new Option("线色", "7"));
						 detail_obj.options.add(new Option("后袋", "9"));
						 break;
				case 2 : detail_obj.options.add(new Option("门襟", "4"));
						 detail_obj.options.add(new Option("纽扣", "5"));
						 detail_obj.options.add(new Option("撞钉", "6"));
						 detail_obj.options.add(new Option("线色", "7")); 
						 detail_obj.options.add(new Option("裤型", "8"));
						 detail_obj.options.add(new Option("后袋", "9"));
						 break;
				case 3 : detail_obj.options.add(new Option("厚度", "1"));
						 detail_obj.options.add(new Option("颜色", "2"));
						 detail_obj.options.add(new Option("板型", "3"));
						 detail_obj.options.add(new Option("门襟", "4"));
						 detail_obj.options.add(new Option("纽扣", "5"));
						 detail_obj.options.add(new Option("撞钉", "6"));
						 detail_obj.options.add(new Option("线色", "7"));
						 break;
				default : break;
			}
        }
        
        function searchType() {
            var item_index = document.getElementsByName('item_type').item(0).options.selectedIndex;
            var detail_index = document.getElementsByName('detail_type').item(0).options.selectedIndex;
            
            item_last_value = document.getElementsByName('item_type').item(0).options[item_index].value;
            detail_last_value = document.getElementsByName('detail_type').item(0).options[detail_index].value;
            searchOperation();
        }
        
        
        function searchOperation() {
            if(document.getElementById('detail_list')) {
                $('#detail_list').remove();
            }
            $("#content").append("<ul id=\"detail_list\"></ul>");
            
            var images_folder = $('#images_folder').text() + '/';
            
            $.ajax({
                url : admin_url + "item_detail/search_invalid_detail",
                data : {item_type:item_last_value,detail_type:detail_last_value},
                type: "post",
                dataType : "json",
                success : function(data, status) {
                    var data_length = data.data.length;
                    var detail_id = null;
                    var item_type = null;
                    var detail_type = null;
					var detail_name = null
                    var detail_attach_price = null;
					var detail_description = null;
                    var detail_image = null;
					
                    for(var i = 0; i < data_length; i++) {
                        detail_id = data.data[i].detail_id;
                        item_type = parseInt(data.data[i].item_type);
                        detail_type = parseInt(data.data[i].detail_type);
                        detail_name = data.data[i].detail_name;
						detail_attach_price = parseInt(data.data[i].detail_attach_price);
                        detail_description = data.data[i].detail_description;
                        detail_image = data.data[i].detail_image
						detail_incart_image = data.data[i].detail_incart_image
                        if(item_type == 1) {
                            switch(detail_type) {
                                case 1 : detail_type = "厚度"; break;
                                case 2 : detail_type = "颜色"; break;
                                case 3 : detail_type = "板型"; break;
                                case 4 : detail_type = "门襟"; break;
                                case 5 : detail_type = "纽扣"; break;
                                case 6 : detail_type = "撞钉"; break;
                                case 7 : detail_type = "线色"; break;
								case 9 : detail_type = "后袋"; break;
                                default : detail_type = "未分类";
                            }
                        }
                        else if(item_type == 2) {
                            switch(detail_type) {
                                case 4 : detail_type = "门襟"; break;
                                case 5 : detail_type = "纽扣"; break;
                                case 6 : detail_type = "撞钉"; break;
                                case 7 : detail_type = "线色"; break;
                                case 8 : detail_type = "后袋"; break;
                                case 9 : detail_type = "裤型"; break;
                                default : detail_type = "未分类";
                            }
                        }
						else if(item_type == 3) {
                            switch(detail_type) {
                                case 1 : detail_type = "厚度"; break;
                                case 2 : detail_type = "颜色"; break;
                                case 3 : detail_type = "板型"; break;
                                case 4 : detail_type = "门襟"; break;
                                case 5 : detail_type = "纽扣"; break;
                                case 6 : detail_type = "撞钉"; break;
                                case 7 : detail_type = "线色"; break;
                                default : detail_type = "未分类";
                            }
                        }
                        else {
                            detail_type = "未分类";
                        }
                        
                        switch(item_type) {
                            case 1 : item_type = "洗水牛仔"; break;
                            case 2 : item_type = "赤耳单宁"; break;
                            case 3 : item_type = "休闲裤"; break;
                            default : item_type = "未分类";
                        }
                        
                        $('#detail_list').append("<li><div class='image_area'><img class='detail_image' src='" + images_folder + detail_image + "' /><img class='incart_image' src='" + images_folder + detail_incart_image + "' /></div><div class='info_area'><span class='item_type'>商品类型：" + item_type + "</span><span class='detail_type'>细节类型：" + detail_type + "</span><span class='detail_name'>商品名称：" + detail_name + "</span><span class='detail_attach_price'>额外价格：" + detail_attach_price + "</span><span class='detail_description'>细节描述：" + detail_description + "</span><span class='operation_link'><a class='delete_link' href='javascript:void(0)' onclick='deleteDetail(" + detail_id + ")'>删除</a><a class='valid_link' href='javascript:void(0)' onclick='validDetail(" + detail_id + ")'>设为有效</a></span><div></li>");
                    }
                },
                error : function() {
					
                }
            });
        }
        
		function validDetail(detail_id) {
            if(confirm("重新设为有效？")) {
                $.ajax({
                    url : admin_url + "item_detail/valid_item_detail",
                    data : {detail_id:detail_id},
                    type: "post",
                    dataType : "json",
                    success : function(data, status) {
                        if(data.code == 0) {
                            $('#detail_list').remove();
                            searchOperation();
                        }
                        else {
                        }
                    },
                    error : function() {
						
                    }
                });
            }
            else {
                return false;
            }
        }
		
        function deleteDetail(detail_id) {
            if(confirm("若该细节与其他订单相关联，删除后将引起其他表单的变化，建议保留。确认删除？")) {
                $.ajax({
                    url : admin_url + "item_detail/delete_item_detail",
                    data : {detail_id:detail_id},
                    type: "post",
                    dataType : "json",
                    success : function(data, status) {
                        if(data.code == 0) {
                            $('#detail_list').remove();
                            searchOperation();
                        }
                        else {
                        }
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
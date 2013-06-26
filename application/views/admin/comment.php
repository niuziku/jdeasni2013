	<div id="main">
    	<div id="nav">
        	<h3>评论列表</h3>
        </div>
        
        <div id="content">
        	<div id='comment'></div>
        </div>
        <span id="images_folder" style="display:none;"><?php echo base_url('images/comment'); ?></span>
    </div>
    
    <script type="text/javascript">
		
		var MAX_DISPLAY = 10;
		
		var images_folder = $('#images_folder').text() + "/";
		var page_num = 1;
		var page_amount = 1;
		
		var start_comment_id = 0;
		var end_comment_id = 0;
		
		$(document).ready(function() {
            get_list();
			get_page_amount();
        });
		
		function get_list() {
			
			var url = location.href;
			var page_mark = url.lastIndexOf('page_num=');

			if(page_mark > 0) {
				page_num = parseInt(url.substr(page_mark + 9, url.length - 1));
			}
			else {
				page_num = 1;
			}
			
			if(document.getElementById('comment_list')) {
				$("#comment_list").remove();
			}
			
			$('#comment').append("<ul id='comment_list'></ul>");
			var data_length = 0;
			var li_id = null;
			var li_id_str = null;
			var reply_form_id = null;
			
			$.ajax({
				url: admin_url + "comment/comment_list/" + page_num,
				data: {},
				type: "post",
				dataType: "json",
				complete: getReply,
				success: function(data, textStatus) {
					if(data.code == 0) {
						var comment_id = null;
						var comment_email = null;
						var comment_phone = null;
						var comment_name = null;
						var comment_content = null;
						var comment_time = null;
						var comment_public = null;
						var comment_public_str = null;
						var comment_photo = null;
						
						data_length = data.data.length;
						for(var i = 0; i < data_length; i++) {
							comment_id = data.data[i].comment_id;
							comment_email = (data.data[i].comment_email == null) ? "未填写" : data.data[i].comment_email;
							comment_phone = (data.data[i].comment_phone == null) ? "未填写" : data.data[i].comment_phone;
							comment_name = data.data[i].comment_name;
							comment_content = data.data[i].comment_content;
							comment_time = data.data[i].comment_time;
							comment_public = data.data[i].comment_public;
							comment_public_str = (comment_public == 0) ? "(私密评论)" : "";
							comment_photo = data.data[i].comment_photo;
							
							if(i == 0) {
								end_comment_id = parseInt(comment_id);
							}
							start_comment_id = parseInt(comment_id);
							
							li_id = "comment_" +  comment_id;
							li_id_str = "#comment_" +  comment_id;
							reply_form_id = "reply_form_" + comment_id;
							$('#comment_list').append("<li id='" + li_id + "' class='single_comment'></li>");
							if(comment_photo == null || comment_photo == '') {
								$(li_id_str).append("<div class='comment_area'><span class='comment_name'>" + comment_name + "</span><span class='comment_public'>" + comment_public_str + "</span><span class='comment_email'>邮箱：" + comment_email + "</span><span class='comment_phone'>电话：" + comment_phone + "</span><span class='comment_delete'><a class='delete_link' href='javascript:void(0)' onclick='deleteComment(" + comment_id + ")'>删除</a></span><span class='comment_content'>" + comment_content + "</span><span class='comment_time'>提交于：" + comment_time + "</span></div>");
							}
							else {
								$(li_id_str).append("<div class='comment_area'><span class='comment_name'>" + comment_name + "</span><span class='comment_public'>" + comment_public_str + "</span><span class='comment_email'>邮箱：" + comment_email + "</span><span class='comment_phone'>电话：" + comment_phone + "</span><span class='comment_delete'><a class='delete_link' href='javascript:void(0)' onclick='deleteComment(" + comment_id + ")'>删除</a></span><span class='comment_content'>" + comment_content + "</span><span class='comment_photo'><a href='" + images_folder + comment_photo + "' target='_blank' title='点击查看原图'><img src='" + images_folder + comment_photo + "' /></a></span><span class='comment_time'>提交于：" + comment_time + "</span></div>");
							};
							
							$(li_id_str).append("<div id='reply_area_" + comment_id + "' class='reply_area'><form id='" + reply_form_id + "' method='post' class='reply_form' name='reply_form'><input type='hidden' name='comment_public' value='" +comment_public  + "'><input type='hidden' name='parent_id' value='" + comment_id + "'><textarea id='reply_textarea_" + comment_id + "' name='comment_content'></textarea><a class='submit_button' href='javascript:void(0)' onclick='submitReply(" + comment_id + ")'>回复</a></div>");
						}
					}
					else {
					}
					
				},
				error: function() {
					
				}
			});
			
		}
		
		function getReply() {
			$.ajax({
				url: admin_url + "comment/reply_list/" + start_comment_id + "/" + end_comment_id,
				data: {},
				type: "post",
				dataType: "json",
				success: function(data, textStatus) {
					if(data.code == 0) {
						var reply_id = null;
						var reply_content = null;
						var reply_time = null;
						var reply_parent_id = null;
						
						var reply_area_str = null;
						var reply_form_str = null;
						var reply_form_id = null;
						var data_length = data.data.length;
						for(var i = 0; i < data_length; i++) {
							reply_id = data.data[i].comment_id;
							reply_parent_id = data.data[i].parent_id;
							reply_content = data.data[i].comment_content;
							reply_time = data.data[i].comment_time;
							reply_form_id = "reply_form_" + reply_parent_id;
							
							if(document.getElementById(reply_form_id)) {
								reply_form_str = "#" + reply_form_id;
								reply_area_str = "#reply_area_" + reply_parent_id;
								$(reply_form_str).remove();
								$(reply_area_str).append("<span class='reply_content'>" + reply_content + "</span><span class='reply_time'>回复于：" + reply_time + "</span><span class='comment_delete'><a class='delete_link' href='javascript:void(0)' onclick='deleteComment(" + reply_id + ")'>删除回复</a></span>");
							}
						}
						
						for(var j = end_comment_id; j >= start_comment_id; j--) {
							reply_form_id = "reply_form_" + j;
							if(document.getElementById(reply_form_id)) {
								document.getElementById(reply_form_id).style.display = "block";
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
		
		function submitReply(comment_id) {
			var form_id = "#reply_form_" + comment_id;
			var textarea_id = "#reply_textarea_" + comment_id;
			
			if($(textarea_id).val() == "") {
				alert("回复内容不能为空！");
				return false;
			}
			
			$.ajax({
				url: admin_url + "comment/add_reply",
				data: $(form_id).serialize(),
				type: "post",
				dataType: "json",
				success: function(data, textStatus) {
					if(data.code == 0) {
						get_list(page_num);
					}
					else {
					}
				},
				error: function() {
					
				}
			});
		}
		
		function deleteComment(comment_id) {
			if(confirm("是否删除？")) {
				$.ajax({
					url: admin_url + "comment/delete_comment",
					data: {comment_id : comment_id},
					type: "post",
					dataType: "json",
					success: function(data, textStatus) {
						if(data.code == 0) {
							get_list(page_num);
						}
						else {
						}
					},
					error: function() {
						
					}
				});
			}
			else {
				return false;
			}
		}
		
		function get_page_amount() {
			$.ajax({
					url: admin_url + "comment/comment_amount",
					data: {},
					type: "post",
					dataType: "json",
					complete:setPageNav,
					success: function(data, textStatus) {
						if(data.code == 0) {
							page_amount = Math.ceil(parseInt(data.data.comment_amount) / (1.0 * MAX_DISPLAY));
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
				$("#page_nav").append("<li><li><a href='" + admin_url + "comment?page_num=" + before_page + "'>上一页</a></li>");
			}
			
			if(page_amount <= 5) {
				for(var i = 1; i < page_amount; i++) {
					if(current_page == i) {
						$("#page_nav").append("<li class='current_page'>" + current_page + "</li>");
					}
					else {
						$("#page_nav").append("<li><a href='" + admin_url + "comment?page_num=" + i + "'>" + i + "</a></li>");
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
							$("#page_nav").append("<li><a href='" + admin_url + "comment?page_num=" + i + "'>" + i + "</a></li>");
						}
					}
				}
				else if((page_amount - current_page) < 2) {
					for(var i = page_amount - 4; i <= page_amount; i++) {
						if(current_page == i) {
							$("#page_nav").append("<li class='current_page'>" + current_page + "</li>");
						}
						else {
							$("#page_nav").append("<li><a href='" + admin_url + "comment?page_num=" + i + "'>" + i + "</a></li>");
						}
					}
				}
				else {
					for(var i = current_page - 2; i <= current_page + 2; i++) {
						if(current_page == i) {
							$("#page_nav").append("<li class='current_page'>" + current_page + "</li>");
						}
						else {
							$("#page_nav").append("<li><a href='" + admin_url + "comment?page_num=" + i + "'>" + i + "</a></li>");
						}
					}
				}
			}
			
			if(page_amount != 0) {
				if(current_page != page_amount) {
					$("#page_nav").append("<li><a href='" + admin_url + "comment?page_num=" + after_page + "'>下一页</a></li>");
				}
				$("#page_nav").append("<li>(共" + page_amount + "页)</li>")
			}
		}
	</script>
    
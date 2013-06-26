	<div id="main">
    	<div id="nav">
        	<h3>新闻列表</h3>
            <a class="other_link" href="<?php echo site_url('admin/news/add');?>">添加新闻</a>
        </div>
        <div id="content">
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
		get_list();
	});
	
	function get_list() {
		document.getElementById('content').innerHTML = "<ul id='news_list'><li class='news_item'><span class='news_title'>题目</span><span class='news_time'>发表时间</span><span class='news_type'>类型</span></li></ul>";
		$.ajax({
			url : admin_url + "news/news_list",
			data : {},
			type: "post",
			dataType : "json",
			success : function(data, status) {
				if(data.code == 0) {
					var data_length = data.data.length;
					var news_id = null;
					var news_title = null;
					var news_time = null;
					var news_type = null;
					
					for(var i = 0; i < data_length; i++) {
						news_id = data.data[i].news_id;
						news_title = data.data[i].news_title;
						news_time = data.data[i].news_time;
						news_type = parseInt(data.data[i].news_type);
						switch(news_type) {
							case 1 : news_type = "I.D企划预告"; break;
							case 2 : news_type = "I.D新品展示"; break;
							case 3 : news_type = "实用教程"; break;
							default : news_type = "未分类";
						}
						$('#news_list').append("<li class='news_item' id='news_"+ news_id + "'><span class='news_title'><a href='" + admin_url + "news/single/" + news_id + "'>" + news_title + "</a></span><span class='news_time'>" + news_time + "</span><span class='news_type'>" + news_type + "</span><a class='delete_news' href='javascript:void(0);' onclick='delete_news(" + news_id + ")'>删除新闻</a></li>");
					}
				}
				else {
				}
			},
			error : function() {
				
			}
		});
	}
	
	function delete_news(news_id) {
		if(confirm("确认删除？")) {
			$.ajax({
				url : admin_url + "news/delete_news",
				data : {news_id:news_id},
				type: "post",
				dataType : "json",
				success : function(data, status) {
					$('#news_list').remove();
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
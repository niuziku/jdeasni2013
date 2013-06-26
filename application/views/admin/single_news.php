	<div id="main">
    	<div id="nav">
            <a class="other_link" href="<?php echo site_url('admin/news');?>">返回新闻列表</a>
        </div>
        <div id="content">
        	<div id="news_content"></div>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
		var url = location.href;
		var str_length = url.length;
		var start_location = url.lastIndexOf("/");
		var news_id_length = str_length - start_location - 1;
		var news_id = url.substr(start_location + 1, news_id_length);
		$.ajax({
			url : admin_url + "news/single_news/" + news_id,
			data : {},
			type: "post",
			dataType : "json",
			success : function(data, status) {
				var news_title = data.data.news_title;
				var news_time = data.data.news_time;
				var news_content = data.data.news_content;
				var news_type = parseInt(data.data.news_type);
				switch(news_type) {
					case 1 : news_type = "I.D企划预告"; break;
					case 2 : news_type = "I.D新品展示"; break;
					case 3 : news_type = "实用教程"; break;
					default : news_type = "未分类";
				}
				
				var title_str = "<h3>" + news_title + "<span>&nbsp;(" + news_time + "&nbsp;|&nbsp;" + news_type + ")</span></h3>";
				$('#nav').append(title_str);
				$('#news_content').append(news_content);
			},
			error : function() {
				
			}
		});
	});
    </script>
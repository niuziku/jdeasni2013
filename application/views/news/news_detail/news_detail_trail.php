<script charset="utf-8" src="<?php echo base_url('js/global.js'); ?>"></script>
<script type="text/javascript">

var href = location.href;
var param = href.split('?');
var news_id = ( param[1] == null ?  1 : parseInt(param[1].split('=')[1]) );

var category = ['LD企划预告', 'LD新品展示', '实用教程'];

function get_news() {
	$.ajax({
			url: site_url + "news/get",
			data: {news_id : news_id},
			type: "get",
			dataType: "json",
			success: function(data) {
				if(data.code == 0){
					var news = data.data.news; 	
					$('.news-content .title').text(news.news_title);
					$('.news-content .category').text(category[news.news_type-1]);
					$('.news-content .time').text(news.news_time);
					$('.news-content p').after(news.news_content);
				}
				else{
				}
			},
			error: function() {
				
			}
		});
}

$(document).ready(function(){
	get_news();
});
</script>
</body>
</html>
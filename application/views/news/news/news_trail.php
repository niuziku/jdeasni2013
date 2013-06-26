<script charset="utf-8" src="<?php echo base_url('js/global.js'); ?>"></script>
<script type="text/javascript">

var MAX_DISPLAY = 12;
var page_amount = 1;

var href = location.href;
var param = href.split('?');
var news_type = 0;
var page_num = 1;
if(param[1] != null){
	var param = param[1].split('&');
	news_type = ( param[0] == null ?  0 : parseInt(param[0].split('=')[1]) );
	page_num = ( param[1] == null ?  1 : parseInt(param[1].split('=')[1]) );	
}

/*分页*/

function get_page_amount() {
	$.ajax({
			url: site_url + "news/get_news_num",
			data: {type : news_type},
			type: "get",
			dataType: "json",
			complete:setPageNav,
			success: function(data, textStatus) {
				if(data.code == 0) {
					page_amount = Math.ceil(parseInt(data.data.news_num) / (1.0 * MAX_DISPLAY));
				}
				else {
				}
			},
			error: function() {
			}
		});
}

function setPageNav() {
	if(page_amount == 1 || page_amount == 0)
		return;
	var current_page = page_num;
	var before_page = current_page - 1;
	var after_page = current_page + 1;
	if(current_page != 1) {
		$('.page-change ul').append('<li><a href="' + site_url + 'news?type=' + news_type + '&page=' + (current_page - 1) + '">&laquo;</a></li>')
	}
	
	if(page_amount <= 5) {
		for(var i = 1; i <= page_amount; i++) {
			if(current_page == i) {
				$('.page-change ul').append('<li class="active"><a href="javascript:void(0)">' + current_page + '</a></li>');
			}
			else {
				$('.page-change ul').append('<li><a href="' + site_url + 'news?type=' + news_type + '&page=' + i + '">' + i + '</a></li>');
			}
		}
	}
	else {
		if(current_page <=3) {
			for(var i = 1; i <= 5; i++) {
				if(current_page == i) {
					$('.page-change ul').append('<li class="active"><a href="javascript:void(0)">' + current_page + '</a></li>');
				}
				else {
					$('.page-change ul').append('<li><a href="' + site_url + 'news?type=' + news_type + '&page=' + i + '">' + i + '</a></li>');
				}
			}
		}
		else if((page_amount - current_page) < 2) {
			for(var i = page_amount - 4; i <= page_amount; i++) {
				if(current_page == i) {
					$('.page-change ul').append('<li class="active"><a href="javascript:void(0)">' + current_page + '</a></li>');
				}
				else {
					$('.page-change ul').append('<li><a href="' + site_url + 'news?type=' + news_type + '&page=' + i + '">' + i + '</a></li>');
				}
			}
		}
		else {
			for(var i = current_page - 2; i <= current_page + 2; i++) {
				if(current_page == i) {
					$('.page-change ul').append('<li class="active"><a href="javascript:void(0)">' + current_page + '</a></li>');
				}
				else {
					$('.page-change ul').append('<li><a href="' + site_url + 'news?type=' + news_type + '&page=' + i + '">' + i + '</a></li>');
				}
			}
		}
	}
	
	if(current_page != page_amount) {
		var next_page = current_page + 1;
		$('.page-change ul').append('<li><a href="' + site_url + 'news?type=' + news_type + '&page=' + next_page + '">&raquo;</a></li>');
	}
}


var category = ['LD企划预告', 'LD新品展示', '实用教程'];
	
function get_news(){
	$.ajax({
		url : site_url + ((news_type == 0) ? 'news/get_news' : 'news/get_news_by_type'),
		data : {
			start : (page_num - 1) * MAX_DISPLAY,
			length : MAX_DISPLAY,
			type : news_type
		},
		type : 'get',
		dataType : 'json',
		success : function(data){
			if(data.code == 0){
				var re = /src="([^"]*)"/;
				var news = data.data.news;
				if(news.length > 0){
					for(var i = 0; i < news.length && i < 3; i++){
						var news_image = news[i].news_content.match(re);
						if(news_image != null)
							news_image = news_image[1];




						var news_ca = news[i].news_content.replace(/<\/?.+?>/g,"");
						news_ca = news_ca.replace(/&nbsp;/g,"");
						
						var html = '<div class="one-news span4">' + 
				                		'<a href="' + site_url + 'news/detail?news=' + news[i].news_id + '" class="thumbnail">';
			                
			    		if(news_image != null)
				    		html += '<div class="new-pic"><img src="' +  news_image + '" style="width:100%;"/></div>';
			           	html += '<h4>' + news[i].news_title + '</h4>' + 
						         '<p><span class="category">' + category[news[i].news_type - 1] + '</span><span class="time">' + news[i].news_time + '</span></p>' +
						         '<p class="content">';
			           
			            html += news_ca;
			            html += '</p>' + 
						     '</a>' + 
					     '</div>';
						$('.news-block .row-fluid').eq(0).append(html);
					}
				}
				if(news.length > 3){
					for(var i = 3; i < news.length && i < 6; i++){
						var news_image = news[i].news_content.match(re);
						if(news_image != null)
							news_image = news_image[1];

						var news_ca = news[i].news_content.replace(/<\/?.+?>/g,"");
						news_ca = news_ca.replace(/&nbsp;/g,"");
						

						var html = '\
							<div class="one-news span4">\
				                <a href="' + site_url + 'news/detail?news=' + news[i].news_id + '" class="thumbnail">';
			                
			    		if(news_image != null)
				    		html += '<div class="new-pic"><img src="' + news_image + '" style="width:100%;"/></div>';
			           	html += '\
						       		<h4>' + news[i].news_title + '</h4>\
						            <p><span class="category">' + category[news[i].news_type - 1] + '</span><span class="time">' + news[i].news_time + '</span></p>\
						            <p class="content">';
			           
			            html += news_ca;
			            html += '\
						            </p>\
						         </a>\
					         </div>';
						$('.news-block .row-fluid').eq(1).append(html);
					}
				}
				if(news.length > 6){
					for(var i = 6; i < news.length && i < 9; i++){
						var news_image = news[i].news_content.match(re);
						if(news_image != null)
							news_image = news_image[1];


						var news_ca = news[i].news_content.replace(/<\/?.+?>/g,"");
						news_ca = news_ca.replace(/&nbsp;/g,"");
						
						var html = '\
							<div class="one-news span4">\
				                <a href="' + site_url + 'news/detail?news=' + news[i].news_id + '" class="thumbnail">';
			                
			    		if(news_image != null)
				    		html += '<div class="new-pic"><img src="' +  news_image + '" style="width:100%;"/></div>';
			           	html += '\
						       		<h4>' + news[i].news_title + '</h4>\
						            <p><span class="category">' + category[news[i].news_type - 1] + '</span><span class="time">' + news[i].news_time + '</span></p>\
						            <p class="content">';
			           
			            html += news_ca;
			            html += '\
						            </p>\
						         </a>\
					         </div>';
						$('.news-block .row-fluid').eq(1).append(html);
					}
				}
			}
			else{
			}
		},
		error : function(){
		} 
	});
}

$(document).ready(function(){

	var categorys = $('.category-block ul .category');
	for(var i = 0; i < categorys.length; i++){
		if(i == news_type)
			categorys.eq(i).find('span').attr("class", "label label-success");
		else
			categorys.eq(i).find('span').attr("class", "label");
	}
	
	get_news();
	get_page_amount();
});
</script>

</body>
</html>
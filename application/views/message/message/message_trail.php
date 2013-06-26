<script type="text/javascript" src="<?php echo base_url('js/message.js');?>"></script>
<script charset="utf-8" src="<?php echo base_url('js/global.js'); ?>"></script>
<script charset="utf-8" src="<?php echo base_url('js/jquery.form.js'); ?>"></script>
<script type="text/javascript">
/*后台交互*/

//图片上传

function fileUpload(){
    $('#add-picture').click(function(){
        $('.image-upload').click();
    });
    $('.image-upload').change(function(){
            $('.desc-picture').submit();
    });
    $('.desc-picture').submit(function(){
        $('.desc-picture').ajaxSubmit({
            beforeSubmit: function(){
            	if($('.image-item')) {
            		del_image($('.image-item').attr('src'));
            		$('.photo').removeAttr('value');
    			}
            },
            success: function(data){
                if(data.code == 0){
                   var offset = $('#add-picture').offset();
                   var x = offset.left;
                   var y = offset.top;
                   $('#add-picture').after(
						'<div class="popover fade bottom in" style="top: ' + (y-80) + 'px; left: ' + (x-180) + 'px; display: block;">' +
		                    '<div class="arrow" style="left:10%;"></div>' +
		                    '<h3 class="popover-title"></h3>' +
		                    '<div class="popover-content">' +
		                    	'<img class="image-item" width="100px" src="' + images_url + 'comment/' + data.data.image_name + '" />' +
		                        '<a href="javascript:(0)" class="del-image">删除</a>' +
		                    '</div>' +
		                '</div>'
                    );
	                
                    
                    $('.del-image').click(function(){
                   		del_image($('.image-item').attr('src'));
                		return false;
                    });
                    $('.photo').attr('value', data.data.image_name);
                }
                else{
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
            },
            dataType: 'json'
        });
        return false;
    });
    
}

function del_image(image_url){
	$.ajax({
		url: site_url + "comment/del_image",
		data: {image: image_url},
		type: "get",
		dataType: "json",
		success: function(data, textStatus) {
			if(data.code == 0) {
				$('.image-item').remove();
				$('.del-image').remove();
				$('.photo').removeAttr('value');
				$('.popover').remove();
			}
			else {
			}
		},
		error: function() {
		}
	});
}

//评论
function comment(){
	$(".form-horizontal").ajaxForm({
		dataType: "json",
		url: site_url + "comment/create",
		type: "get",
		beforeSubmit: function(){},
		success: function(data){
			if(data.code == 0){
				window.location.href= '?page=1';
			}
			else{
			}
		}
	});
}

function get_comment_list(start, num){
	$.ajax({
		url : site_url + 'comment/get',
		data : {
			start : start,
			num : num 
		},
		type : "get",
		dataType : "json",
		success : function(data, textStatus){
			if(data.code == 0){

				var comments = data.data.comments;
				for(key in comments){
					$html = '<div class="message" style="padding-top:0;">' +
		        				'<p class="name">' + comments[key].comment_name + '<span class="time">' + comments[key].comment_time + '</span></p>' +
					        	'<p>' + comments[key].comment_content + '</p>';
					if(comments[key].comment_photo != null && comments[key].comment_photo != '' ){
						$html += '<a href="javascript:void(0)"><img src="' + images_url + 'comment/' + comments[key].comment_photo + '" class="message-img"/></a>'
					}
	                
		        	if(comments[key].admin_comment != null){
						$html += '<div class="reply">' +
			            			'<p class="name">' + comments[key].admin_comment.comment_name + '<span class="time">' + comments[key].admin_comment.comment_time + '</span></p>' +
			            			'<p>' + comments[key].admin_comment.comment_content + '</p>' + 
			            		'</div>';
			        }
			        $html + '</div>';
					$('#leave-message').append($html);
				}
			}
			else{
			}
		},
		error : function(){
		}
	});
}


/*分页*/
var page_amount = 1;
var MAX_DISPLAY = 12;


var href = location.href;
var param = href.split('?');
var page_num = ( param[1] == null ?  1 : parseInt(param[1].split('=')[1]) );

function get_page_amount() {
	$.ajax({
			url: site_url + "comment/get_amount_of_customer",
			data: {},
			type: "get",
			dataType: "json",
			complete:setPageNav,
			success: function(data, textStatus) {
				if(data.code == 0) {
					page_amount = Math.ceil(parseInt(data.data.amount) / (1.0 * MAX_DISPLAY));
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
		$('.page-change ul').append('<li><a href="' + site_url + 'comment?page=' + (current_page - 1) + '">&laquo;</a></li>')
	}
	
	if(page_amount <= 5) {
		for(var i = 1; i <= page_amount; i++) {
			if(current_page == i) {
				$('.page-change ul').append('<li class="active"><a href="javascript:void(0)">' + current_page + '</a></li>');
			}
			else {
				$('.page-change ul').append('<li><a href="' + site_url + 'comment?page=' + i + '">' + i + '</a></li>');
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
					$('.page-change ul').append('<li><a href="' + site_url + 'comment?page=' + i + '">' + i + '</a></li>');
				}
			}
		}
		else if((page_amount - current_page) < 2) {
			for(var i = page_amount - 4; i <= page_amount; i++) {
				if(current_page == i) {
					$('.page-change ul').append('<li class="active"><a href="javascript:void(0)">' + current_page + '</a></li>');
				}
				else {
					$('.page-change ul').append('<li><a href="' + site_url + 'comment?page=' + i + '">' + i + '</a></li>');
				}
			}
		}
		else {
			for(var i = current_page - 2; i <= current_page + 2; i++) {
				if(current_page == i) {
					$('.page-change ul').append('<li class="active"><a href="javascript:void(0)">' + current_page + '</a></li>');
				}
				else {
					$('.page-change ul').append('<li><a href="' + site_url + 'comment?page=' + i + '">' + i + '</a></li>');
				}
			}
		}
	}
	
	if(current_page != page_amount) {
		var next_page = current_page + 1;
		$('.page-change ul').append('<li><a href="' + site_url + 'comment?page=' + next_page + '">&raquo;</a></li>');
	}
}

$(document).ready(function() {
	get_comment_list((page_num-1) * MAX_DISPLAY, MAX_DISPLAY);
	get_page_amount();
	fileUpload();
	comment();
});
</script>
</body>
</html>
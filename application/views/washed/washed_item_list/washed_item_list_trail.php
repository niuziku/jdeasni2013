<script charset="utf-8" src="<?php echo base_url('js/global.js'); ?>"></script>
<script type="text/javascript">
		/*var y = 0;
		$(document).ready(function() {
			init();
			showDetail();
		});
		
		function init() {
			$(".detail").hide();
		}
		
		function showDetail() {
			$(".shopping-item").hover(function(){
				$(".detail").stop().show().css({ "bottom" : "-150px" }).animate({bottom : 5}, 300);
			}
			,function(){
				$(".detail").stop().animate({bottom : -150}, 300);
			});
		}*/



	var MAX_DISPLAY = 12;
	var page_amount = 1;
	var href = location.href;
	var param = href.split('?');
	var page_num = ( param[1] == null ?  1 : parseInt(param[1].split('=')[1]) );
	
	$.ajax({
		url : site_url + 'item/get_items_by_type',
		data : {
			item_type : 1,
			start : (page_num-1) * MAX_DISPLAY,
			num : MAX_DISPLAY
		},
		type : "get",
		dataType : "json",
		success : function(data, textStatus){
			if(data.code == 0){
				var items = data.data;
				if(items.length > 0){
					for(var i = 0; i < items.length && i < 4; i++){
						$('.thumbnails').eq(0).append('\
							<li class="span3">' + 
								'<a href="' + site_url + 'item/washed_item/' + items[i].item_id + '" class="thumbnail"><img src="' + images_url + 'item/' + items[i].item_photos[0] + '" />' +
									'<div class="detail">' + 
										'<p class="name">' + items[i].item_name + '</p>' + 
										'<p class="price-large right"><span>RMB</span>' + items[i].item_price + '</p>' +
									'</div>' +
								'</a>' + 
							'</li>'
						);
					}
				}
				if(items.length > 4){
					for(var i = 4; i < items.length && i < 8; i++){
						$('.thumbnails').eq(1).append('\
							<li class="span3">' + 
								'<a href="' + site_url + 'item/washed_item/' + items[i].item_id + '" class="thumbnail"><img src="' + images_url + 'item/' + items[i].item_photos[0] + '" />' +
									'<div class="detail">' + 
										'<p class="name">' + items[i].item_name + '</p>' + 
										'<p class="price-large right"><span>RMB</span>' + items[i].item_price + '</p>' +
									'</div>' +
								'</a>' + 
							'</li>'
						);
					}
				}
				if(items.length > 8){
					for(var i = 8; i < items.length && i < 12; i++){
						$('.thumbnails').eq(2).append('\
							<li class="span3">' + 
								'<a href="' + site_url + 'item/washed_item/' + items[i].item_id + '" class="thumbnail"><img src="' + images_url + 'item/' + items[i].item_photos[0] + '" />' +
									'<div class="detail">' + 
										'<p class="name">' + items[i].item_name + '</p>' + 
										'<p class="price-large right"><span>RMB</span>' + items[i].item_price + '</p>' +
									'</div>' +
								'</a>' + 
							'</li>'
						);
					}
				}
			}
			else{
			}
		},
		error : function(){
		}
	});



	/*分页*/
	

	function get_page_amount() {
		$.ajax({
				url: site_url + "item/get_items_num_by_type",
				data: {item_type : 1},
				type: "get",
				dataType: "json",
				complete:setPageNav,
				success: function(data, textStatus) {
					if(data.code == 0) {
						page_amount = Math.ceil(parseInt(data.data.items_num) / (1.0 * MAX_DISPLAY));
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
			$('.page-change ul').append('<li><a href="' + site_url + 'item/washed_item_list?page=' + (current_page - 1) + '">&laquo;</a></li>')
		}
		
		if(page_amount <= 5) {
			for(var i = 1; i <= page_amount; i++) {
				if(current_page == i) {
					$('.page-change ul').append('<li class="active"><a href="#">' + current_page + '</a></li>');
				}
				else {
					$('.page-change ul').append('<li><a href="' + site_url + 'item/washed_item_list?page=' + i + '">' + i + '</a></li>');
				}
			}
		}
		else {
			if(current_page <=3) {
				for(var i = 1; i <= 5; i++) {
					if(current_page == i) {
						$('.page-change ul').append('<li class="active"><a href="#">' + current_page + '</a></li>');
					}
					else {
						$('.page-change ul').append('<li><a href="' + site_url + 'item/washed_item_list?page=' + i + '">' + i + '</a></li>');
					}
				}
			}
			else if((page_amount - current_page) < 2) {
				for(var i = page_amount - 4; i <= page_amount; i++) {
					if(current_page == i) {
						$('.page-change ul').append('<li class="active"><a href="#">' + current_page + '</a></li>');
					}
					else {
						$('.page-change ul').append('<li><a href="' + site_url + 'item/washed_item_list?page=' + i + '">' + i + '</a></li>');
					}
				}
			}
			else {
				for(var i = current_page - 2; i <= current_page + 2; i++) {
					if(current_page == i) {
						$('.page-change ul').append('<li class="active"><a href="#">' + current_page + '</a></li>');
					}
					else {
						$('.page-change ul').append('<li><a href="' + site_url + 'item/washed_item_list?page=' + i + '">' + i + '</a></li>');
					}
				}
			}
		}
		
		if(current_page != page_amount) {
			var next_page = current_page + 1;
			$('.page-change ul').append('<li><a href="' + site_url + 'item/washed_item_list?page=' + next_page + '">&raquo;</a></li>');
		}
	}

	$(document).ready(function(){
		get_page_amount();
	});
	</script>
	
</body>
</html>
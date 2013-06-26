	<script charset="utf-8" src="<?php echo base_url('js/global.js'); ?>"></script>
	<script type="application/javascript">
	
		$(document).ready(function(e) {

			get_selvedge_list();
        });

        function get_selvedge_list(){
            $.ajax({
				url: site_url + 'item/get_items_by_type',
				data : {
					start : -1,
					item_type : 2
				},
				type : 'get',
				dataType : 'json',
				success : function(data){
					var items = data.data;
					for(var i = 0; i < items.length; i++){
						if(items[i].item_weight != null && items[i].item_weight != ''){
							if(parseFloat(items[i].item_weight) <= 13.4){
								var html = '\
									<li><a href="' + site_url + 'item/selvedge_item/' + items[i].item_id + '" class="thumbnail"><img src="' + images_url + 'selvedge/' + items[i].item_material_image + '" /></a>\
					                	<div class="selvedge-detail">\
					                        <p>编号: ' + items[i].item_name + '</p>\
					                        <p>重量: ' + items[i].item_weight + '</p>\
					                        <p>产地: ' + items[i].item_provenance + '</p>\
					                        <p class="price-large"><span>RMB</span>' + items[i].item_price + '</p>\
					                    </div>\
					                </li>\
									'
								$('#oz13').append(html);
							}
							if(parseFloat(items[i].item_weight) > 13.4 && parseFloat(items[i].item_weight) <= 14){
								var html = '\
									<li><a href="' + site_url + 'item/selvedge_item/' + items[i].item_id + '" class="thumbnail"><img src="' + images_url + 'selvedge/' + items[i].item_material_image + '" /></a>\
					                	<div class="selvedge-detail">\
					                        <p>编号: ' + items[i].item_name + '</p>\
					                        <p>重量: ' + items[i].item_weight + '</p>\
					                        <p>产地: ' + items[i].item_provenance + '</p>\
					                        <p class="price-large"><span>RMB</span>' + items[i].item_price + '</p>\
					                    </div>\
					                </li>\
									'
								$('#oz14').append(html);
							}
								
							if(parseFloat(items[i].item_weight) > 14 && parseFloat(items[i].item_weight) <= 14.8){
								var html = '\
									<li><a href="' + site_url + 'item/selvedge_item/' + items[i].item_id + '" class="thumbnail"><img src="' + images_url + 'selvedge/' + items[i].item_material_image + '" /></a>\
					                	<div class="selvedge-detail">\
					                        <p>编号: ' + items[i].item_name + '</p>\
					                        <p>重量: ' + items[i].item_weight + '</p>\
					                        <p>产地: ' + items[i].item_provenance + '</p>\
					                        <p class="price-large"><span>RMB</span>' + items[i].item_price + '</p>\
					                    </div>\
					                </li>\
									'
								$('#oz14-4').append(html);
							}
							if(parseFloat(items[i].item_weight) > 14.8 && parseFloat(items[i].item_weight) <= 15.9){
								var html = '\
									<li><a href="' + site_url + 'item/selvedge_item/' + items[i].item_id + '" class="thumbnail"><img src="' + images_url + 'selvedge/' + items[i].item_material_image + '" /></a>\
					                	<div class="selvedge-detail">\
					                        <p>编号: ' + items[i].item_name + '</p>\
					                        <p>重量: ' + items[i].item_weight + '</p>\
					                        <p>产地: ' + items[i].item_provenance + '</p>\
					                        <p class="price-large"><span>RMB</span>' + items[i].item_price + '</p>\
					                    </div>\
					                </li>\
									'
								$('#oz15').append(html);
							}
							if(parseFloat(items[i].item_weight) >15.9 && parseFloat(items[i].item_weight) <=17){
								var html = '\
									<li><a href="' + site_url + 'item/selvedge_item/' + items[i].item_id + '" class="thumbnail"><img src="' + images_url + 'selvedge/' + items[i].item_material_image + '" /></a>\
					                	<div class="selvedge-detail">\
					                        <p>编号: ' + items[i].item_name + '</p>\
					                        <p>重量: ' + items[i].item_weight + '</p>\
					                        <p>产地: ' + items[i].item_provenance + '</p>\
					                        <p class="price-large"><span>RMB</span>' + items[i].item_price + '</p>\
					                    </div>\
					                </li>\
									'
								$('#oz16t17').append(html);
							}
							if(parseFloat(items[i].item_weight) > 17){
								var html = '\
									<li><a href="' + site_url + 'item/selvedge_item/' + items[i].item_id + '" class="thumbnail"><img src="' + images_url + 'selvedge/' + items[i].item_material_image + '" /></a>\
					                	<div class="selvedge-detail">\
					                        <p>编号: ' + items[i].item_name + '</p>\
					                        <p>重量: ' + items[i].item_weight + '</p>\
					                        <p>产地: ' + items[i].item_provenance + '</p>\
					                        <p class="price-large"><span>RMB</span>' + items[i].item_price + '</p>\
					                    </div>\
					                </li>\
									'
								$('#oz18').append(html);
							}


				            $(".thumbnail").mouseover(function(){
								$(this).next(".selvedge-detail").show();
							});
							
							$(".thumbnail").mouseout(function(e) {
				                $(this).next(".selvedge-detail").hide();
				            });
						}
							
					}
				},
				error : function(){
				}
            });
        }
    </script>
</body>
</html>
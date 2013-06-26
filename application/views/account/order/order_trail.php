<script charset="utf-8" src="<?php echo base_url('js/global.js'); ?>"></script>
<script type="text/javascript">

$(document).ready(function(){
	get_order();

});

function get_order(){
	$.ajax({
		url : site_url + 'order/get',
		data : {
			start : 0,
			length : 10
		},
		type : 'get',
		dataType : 'json',
		success : function(data){
			if(data.code == 0){
				orders = data.data.orders;
				for(i = 0; i < orders.length; ++i){
					order = orders[i];
					order_status = '等待买家付款';
					order_class = 'order-wait';
					extra_message = '';
					switch(parseInt(order.order_status)){
						case 1: 
							order_status = '等待买家付款';
							extra_message = '';
							order_class = 'order-wait';
							break;
						case 2: 
							order_status = '制作中';
							extra_message = '制作一般需要12~15天';
							order_class = 'order-make';
							break;
						case 3: 
							order_status = '卖家已发货，等待买家确认';
							if(order.order_express != null && order.order_express_num != null)
								extra_message = order.order_express + ' : ' + order.order_express_num;
							else
								extra_message = '';
							order_class = 'order-deliver';
							break;
						case 4: 
							order_status = '交易成功结束';
							extra_message = '欢迎下次再来~';
							order_class = 'order-finish';
							break;
						case 5: 
							order_status = '交易中途关闭';
							extra_message = '';
							order_class = 'order-wait';
							break;
						default:break;
					}
					$html = 
						'<div class="order-block">' + 
							'<input class="order_id" type="hidden" value="' + order.order_id + '"/>' +
	                		'<div class="order-header">' + 
                				'<div class="alert ' + order_class + '">' + 
				                       '<ul class="inline">' +
				                           '<li><h3>' + order_status + '</h3></li>' +
				                           '<li>' + extra_message + '</li>' +
				                           '<li class="time"><span class="title">下单时间: </span>' + order.order_time + '</li>' +
			                        '</ul>' +
			                    '</div>' +
				            '</div>' +
            
			            	'<div class="order-container">' +
			                
			                	'<div class="order-operation">' +
			                        '<ul>' +
			                            '<li class="title">收件人:</li>' +
			                            '<li>' + order.receiver_name + ' <a href="javascript:void(0)"><span class="label">地址</span></a></li>' +
			                        '</ul>' +  (
					                	parseInt(order.order_status) == 1 ? 
			                        		'<a href="javascript:void(0)" role="button" class="btn topay">去付款</a>' : 
			                        		'<a href="javascript:void(0)" role="button" class="btn" data-toggle="modal">留言</a>'
			                        ) + 
		                            
		                            '<div id="MessageModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' + 
		                                '<div class="modal-header">' + 
		                                    '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>' +
		                                    '<h3 id="myModalLabel">订单留言</h3>' +
		                                '</div>' +
		                                '<div class="modal-body">' +
		                                    '<p>这是之前的留言啦</p>' +
		                                '</div>' +
		                                '<div class="modal-footer">' +
		                                    '<button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>' +
		                                    '<button class="btn btn-primary disabled">留言</button>' +
		                                '</div>' + 
		                            '</div>' +
			                        
			                    '</div><!-- div order operation -->' + 
				                '<div class="total-price">' + 
		                        	'<p class="price-large"><span>RMB</span>' + order.order_sum + '</p>' +
		                            '<p class="discount">(优惠: -RMB ' + (order.minus_price == null ? 0 : order.minus_price) + ')</p>' + 
		                        '</div>';
                    items = order.single_items;
                    for(k = 0; k < items.length; ++k){
						var item = items[k];
						var item_size = '';
						if(item.measure_yaowei > 1000)
							item_size = 'W' + item.measure_yaowei/100 + ' L' + item.measure_kuchang/100;
						else
							item_size = '合身尺寸';
						for(j = 0; j < item.single_item_count; ++j){
							
							option_detail = '<ul class="inline">';
							var detail_num = 0;
							$.each(item, function(key,val){
								if(val && typeof(val) == 'object' && key != 'item_photos' && key != 'item_small_photos'){
									option_detail += '<li><img class="order-option-img img-rounded" src="' + images_url + 'detail/' + val.detail_incart_image + '" alt="' + val.detail_incart_image + '"/></li>';
									detail_num++;
								}
							});
							if(detail_num == 0)
								option_detail += '<li><img style="width:40px; height:40px;"  class="order-option-img img-rounded" src="' + images_url + 'item/' + item.item_photos[0] + '"/></li>';
							option_detail += '</ul>';

							
							$html += 
				                    '<div class="order-item-detail">' +
				                        '<a href="javascript:void(0)"><img src="' + images_url + 'item/' + item.item_photos[0] + '" class="item-img"/></a>' +
				                        '<a href="javascript:void(0)" class="item-name">' + item.item_name + '</a>' +
				                        '<p class="price-small"><span>RMB</span>' + (parseInt(item.item_price) + parseInt(item.markup)) + '</p>' +
				                        '<div class="fit-type">' +
				                            '<p>' + item_size + '</p>' +
				                        '</div>' +
				
				                        '<div class="select-option">' +
					                        option_detail + 
				                        '</div>' +
				                    '</div><!-- item detail -->' +
				                    '<hr>';
						}
						
                    }
			        $html +=   '</div><!-- order container -->' +'</div><!-- order block -->';           
			        $('#right-block').append($html);
				} 

				$(".topay").click(function(){
					$.ajax({
						url : site_url + 'order/pay_unpaid_order',
						data: {
								pay_tool: 0,
								order_id : $(this).parent().parent().parent().find('.order_id').val()
							},
						type: 'get',
						dataType: 'json',
						success: function(data){
							if(data.code == 0){
								var html = data.data.html_text;
								$('#alipay-jump').append(html);
							}
						},
						error: function(){
						} 
					});
				});
			}
			else{
			}
		},
		error : function(){
		}
	});
}

</script>

</body>
</html>
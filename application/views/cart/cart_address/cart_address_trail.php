<script type="text/javascript" src="<?php echo base_url('js/checked_input.js');?>"></script>
<script charset="utf-8" src="<?php echo base_url('js/global.js'); ?>"></script>
<script type="text/javascript">
/*后台交互*/

function get_item_message(item_msg){
	var item_id = item_msg['detail'].item_id;
	$.ajax({
		url : site_url + 'item/get_item_by_id',
		data : {item_id : item_id},
		type : 'get',
		dataType : 'json',
		async: false,
		success : function(data){
			if(data.code == 0){
				var item = data.data.item;
				append_item(item, item_msg);
			}
		},
		error : function(){
		}
	});
}

function append_item(item, item_msg){
	for(j = 0; j < item_msg['count']; ++j){
		//add-html

		option_detail = '<ul class="inline">';
		var details = item_msg['detail'];
		var detail_num = 0;
		
		$.each(details, function(key,val){
			if(val && typeof(val) == 'object'){
				option_detail += '<li><img class="cart-option-img img-rounded" src="' + images_url + 'detail/' + val.detail_incart_image + '" alt="' + val.detail_incart_image + '"/></li>';
				detail_num++;
			}
		});

		if(detail_num == 0)
			option_detail += '<li><img style="width:50px; height:50px;"  class="cart-option-img img-rounded" src="' + images_url + 'item/' + item.item_photos[0] + '"/></li>';
		option_detail += '</ul>';

		var item_size = '';
		if(item_msg['measure'].measure_yaowei > 1000)
			item_size = 'W' + item_msg['measure'].measure_yaowei/100 + ' L' + item_msg['measure'].measure_kuchang/100;
		else
			item_size = '合身尺寸';
		
		var html = 
			'<div class="cart-item">' + 
		        '<img src="' + images_url + 'item/' + item.item_photos[0] + '" class="item-img" />' +
	            '<div class="cart-item-detail">' + 
	            	'<a href="#" class="item-name">' + item.item_name + '</a>' +
	                '<div class="fit-type">' + 
	                	'<p>' + item_size + '</p>' +
	                '</div>' + 
					'<div class="select-option">' + 
						option_detail + 
	                '</div>' +
	                '<div class="item-operation">' + 
	                	'<ul class="inline">' +
	                    	'<li><p class="price-large single-price"><span>RMB</span>' + (parseInt(item.item_price) + parseInt(item_msg['markup'])) + '</p></li>' +
	                    '</ul>' +
	                '</div>' + 
	            '</div><!-- item detail -->' + 
	        '</div><!-- one item -->';
		$('#discut').before(html);
	}
}

function get_cart(){
	$.ajax({
		url : site_url + 'cart/get',
		data : {},
		type : 'get',
		dataType : 'json',
		success : function(data){
			if(data.code == 0){
				var cart = data.data.cart;
				for(i = 0; i < cart.length; ++i){
					get_item_message(cart[i]);
				}
				get_sum(0);
			}
		},
		error : function(){
		} 
	});
}

function discount(){
	discount_code = $('#discount').val();
	if(discount_code){
		$.ajax({
			url : site_url + 'discount/get',
			data : {discount_code : discount_code},
			type : 'get',
			dataType : 'json',
			success : function(data){
				if(data.code == 0){
					minus_price = data.data.minus_price;
					$('.total-price').empty();
					$('.total-price').append('<span>优惠: RMB</span>-'+minus_price);
					get_sum(minus_price);
				}
				else{
					$('.total-price').empty();
					$('.total-price').append('<span>优惠: RMB</span>0');
					get_sum(0);
				}
			},
			error : function(){
			}
		});
	}
	else{
		$('.total-price').empty();
		$('.total-price').append('<span>优惠: RMB</span>0');
	}
}

function get_sum(minus_price){
	var amount = 0;
	$.each($('.single-price'), function(index, val){
		amount += parseInt($(this).text().substring(3));
	});
	amount -= minus_price;
	$('.price-verylarge').empty();
	$('.price-verylarge').append('<span>实付款: RMB</span>' +amount);
}

function pay(){
	email = $('input[name="email"]').val();
	receiver_name = $('input[name="name"]').val();
	phone = $('input[name="phone"]').val();
	province = $('input[name="province"]').val();
	city = $('input[name="city"]').val();
	address = $('textarea[name="address"]').val();
	pay_tool = $('input:radio[name="payment"]:checked').val();
	message = $('input[name="message"]').val();
	discount_code = $('input[name="discount"]').val();

	$.ajax({
		url : site_url + 'order/doOrder',
		data: {
				email : email,
				receiver_name : receiver_name,
				phone : phone,
				province : province,
				city :city,
				address : address,
				pay_tool : pay_tool,
				message : message,
				discount_code : discount_code 
			},
		type: 'post',
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
}

$(document).ready(function(){
	get_cart();
	$('#discount-btn').click(function(){
		discount();
	});

	$('.btn-success').click(function(){
		pay();
	})
});
</script>
</body>
</html>
<script type="text/javascript" src="<?php echo base_url('js/checked_input.js');?>"></script>
<script charset="utf-8" src="<?php echo base_url('js/global.js'); ?>"></script>
<script type="text/javascript">
/*后台交互*/
$(document).ready(function(){

	get_receivers();
	
	get_cart();
	$('#discount-btn').click(function(){
		discount();
	});

	$('.btn-success').click(function(){
		pay();
	})
});


function get_receivers(){
	$.ajax({
		url : site_url + 'receiver/get_all',
		data : {},
		type: 'get',
		dataType : 'json',
		success : function(data){
			if(data.code == 0){
				receivers = data.data.receivers;
				for(var i = 0; i < receivers.length; i++){
					var html = 
						'<label>' +
            				'<input type="radio" name="address_select" value="' + receivers[i].receiver_id + '" ' + (receivers[i].is_default == 1 ? 'checked' : '') + '/><span>' + receivers[i].receiver_area + ',' + receivers[i].receiver_address + ' | 收件人：' + receivers[i].receiver_name +  ' | 联系电话：' + receivers[i].receiver_phone +'</span>' +
                    		'<a class="set-default" onclick="set_receiver_default($(this))">设为默认</a> <a class="delete" onclick="del_receiver($(this))">删除</a>' + 
                		'</label>';
					$('.select-address #add_new_address').before(html);
				} 

				changeReceiverMsg();
			}
		},
		error : function(){
			
		}
	});
}

function changeReceiverMsg(){
	$('input[name="address_select"]').change(function(){
		var receiver = $('.select-address').find('input:radio[name="address_select"]:checked').next().text(	); 
		if(receiver == null || receiver == ''){
			return;
		}
		receiver = receiver.split('|');
		receiver_name = $.trim(receiver[1]).substring(4);
		phone = $.trim(receiver[2]).substring(5);
		province = receiver[0].split(',')[0];
		city = receiver[0].split(',')[1];
		address = receiver[0].split(',')[2];

		$('#province').text(province);
		$('#city').text(city);
		$('#address').text(address);
		$('#phone').text(phone);
		$('#name').text(receiver_name);
	});
}

function addReceiverMsg(){
	$('#province').text($('#input_province').val());
	$('#city').text($('#input_city').val());
	$('#address').text($('#input_address').val());
	$('#phone').text($('#input_phone').val());
	$('#name').text($('#input_name').val());
}

function set_receiver_default(obj){
	var receiver_id = obj.parent().find('input').attr('value');
	$.ajax({
		url : site_url + 'receiver/set_default',
		data : {receiver_id : receiver_id},
		type: 'get',
		dataType : 'json',
		success : function(data){
			if(data.code == 0){
				
			}
		},
		error : function(){
			
		}
	});
}

function del_receiver(obj){
	var receiver_id = obj.parent().find('input').attr('value');
	$.ajax({
		url : site_url + 'receiver/del',
		data : {receiver_id : receiver_id},
		type: 'get',
		dataType : 'json',
		success : function(data){
			if(data.code == 0){
				obj.parent().slideUp("slow", del_block);

				delReceiverMsg();
			}
		},
		error : function(){
			
		}
	});
}

function delReceiverMsg(){
	$('#province').text('');
	$('#city').text('');
	$('#address').text('');
	$('#phone').text('');
	$('#name').text('');	
}

function del_block(){
	$(this).remove();
}

function add_receiver(){
	var name = $('#address_input_form #input_name').val();
	var phone = $('#address_input_form #input_phone').val();
	var province = $('#address_input_form #input_province').val();
	var city = $('#address_input_form #input_city').val();
	var address = $('#address_input_form #input_address').val();
	var area = province + ',' + city;
	$.ajax({
		url : site_url + 'receiver/add',
		data : {
			name : name,
			phone : phone,
			area : area,
			address : address,
			is_default : 0 
		},
		type: 'get',
		dataType : 'json',
		success : function(data){
			if(data.code == 0){
				$(".select-address").prepend(
					"<label><input type='radio' name='address_select' value='" +  data.data.receiver_id + "' checked='checked'/><span>" + $("#input_province").val() + ", " + $("#input_city").val() + ", " + $("#input_address").val() + " | 收件人: " + $("#input_name").val() + " | 联系电话: " + $("#input_phone").val() + "</span>" +
					" <a class='set-default' onclick='set_receiver_default($(this))'>设为默认</a> <a class='delete' onclick='del_receiver($(this))'>删除</a></label>");
				$("#address_input_form").hide("fast");
				$("#add_new_address").show("fast");
				changeReceiverMsg();
			}
		},
		error : function(){
			
		}
	});
}

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
	var receiver = $('.select-address').find('input:radio[name="address_select"]:checked').next().text(	); 
	if(receiver == null || receiver == ''){
		alert("请选择或添加联系人");
		return;
	}
	receiver = receiver.split('|');
	receiver_name = $.trim(receiver[1]).substring(4);
	phone = $.trim(receiver[2]).substring(5);
	province = receiver[0].split(',')[0];
	city = receiver[0].split(',')[1];
	address = receiver[0].split(',')[2];
	pay_tool = $('input:radio[name="payment"]:checked').val();
	message = $('input[name="message"]').val();
	discount_code = $('input[name="discount"]').val();
	
	$.ajax({
		url : site_url + 'order/doOrder',
		data: {
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
</script>
</body>
</html>
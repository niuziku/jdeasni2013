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
			option_detail += '<li><img style="width:60px; height:60px;" class="cart-option-img img-rounded" src="' + images_url + 'item/' + item.item_photos[0] + '"/></li>';
		option_detail += '</ul>';

		var item_size = '';
		if(item_msg['measure'].measure_yaowei > 1000)
			item_size = 'W' + item_msg['measure'].measure_yaowei/100 + ' L' + item_msg['measure'].measure_kuchang/100;
		else
			item_size = '合身尺寸';
		
		var html = 
		'<div class="item-block">' + 
			'<div class="cart-item row-fluid">' + 
		        '<img src="' + images_url + 'item/' + item.item_photos[0] + '" class="item-img" />' +
	            '<div class="cart-item-detail">' + 
	            	'<a href="#" class="item-name">' + item.item_name + '</a>' +
	                '<a class="fit-type" onclick="showMeasure($(this))">' + 
	                	item_size + 
	                '</a>' + 
	                '<div class="popover fade right in" style="top: 100px; left: 236px; display: none;">' +
	                    '<div class="arrow"></div>' +
	                    '<h3 class="popover-title"></h3>' +
	                    '<div class="popover-content">' +
	                            '<p id="shengao">身高:' + item_msg['measure'].measure_shengao + 'cm</p>' +
	                            '<p id="tizhong">体重:' + item_msg['measure'].measure_tizhong + 'cm</p>' +
	                            '<p id="yaowei">腰围:' + item_msg['measure'].measure_yaowei + 'cm</p>' +
	                            '<p id="kuchang">裤长:' + item_msg['measure'].measure_kuchang + 'cm</p>' +
	                            
	                            '<p id="datui">大腿:' + item_msg['measure'].measure_datui + 'cm</p>' +
	                            '<p id="jiaowei">脚围:' + item_msg['measure'].measure_jiaowei + 'cm</p>' +
	                            '<p id="qiandang">前档:' + item_msg['measure'].measure_qiandang + 'cm</p>' +
	                            '<p id="tunwei">臀围:' + item_msg['measure'].measure_tunwei + 'cm</p>' +
	                            '<p id="xigai">膝盖:' + item_msg['measure'].measure_xigai + 'cm</p>' +
	                            '<p id="houdang">后档:' + item_msg['measure'].measure_houdang + 'cm</p>' +
	                    '</div>' +
                    '</div>' + 
					'<div class="select-option">' + 
	                    option_detail + 
	                '</div>' +
	                '<div class="item-operation">' + 
	                	'<ul class="inline">' +
	                    '<li><p class="price-large single-price"><span>RMB</span>' + (parseInt(item.item_price) + parseInt(item_msg['markup'])) + '</p></li>' +
	                    '<li class="delete">' + 
	                    	'<a href="javascript:void(0)">加一条</a>' + 
	                    	'<a href="javascript:void(0)" style="padding-left:26px;">删除</a>' +
								'<ul class="item-message" style="display:none	">' +
									'<li title="item_id">' + (details.item_id == null || details.item_id == '' ? '' : details.item_id) + '</li>' +
									'<li title="color">' + (details.single_item_color == null || details.single_item_color == '' ? '' : details.single_item_color.detail_id) + '</li>' +
									'<li title="fastener">' + (details.single_item_fastener == null || details.single_item_fastener == '' ? '' : details.single_item_fastener.detail_id) + '</li>' +
									'<li title="linecolor">' + (details.single_item_linecolor == null || details.single_item_linecolor == '' ? '' :details.single_item_linecolor.detail_id)  + '</li>' +
									'<li title="metal">' + (details.single_item_metal == null || details.single_item_metal == '' ? '' : details.single_item_metal.detail_id) + '</li>' +
									'<li title="placket">' + (details.single_item_placket == null || details.single_item_placket == '' ? '' : details.single_item_placket.detail_id) + '</li>' +
									'<li title="plate">' + (details.single_item_plate == null || details.single_item_plate == '' ? '' : details.single_item_plate.detail_id) + '</li>' +
									'<li title="thickness">' + (details.single_item_thickness == null || details.single_item_thickness == '' ? '' : details.single_item_thickness.detail_id) + '</li>' +
									'<li title="trouserstype">' + (details.single_item_trouserstype == null || details.single_item_trouserstype == '' ? '' : details.single_item_trouserstype.detail_id) + '</li>' +
									'<li title="backbag">' + (details.single_item_backbag == null || details.single_item_backbag == '' ? '' : details.single_item_backbag.detail_id) + '</li>' +
									'<li title="alternative1">' + (details.single_item_alternative1 == null || details.single_item_alternative1 == '' ? '' : details.single_item_alternative1.detail_id) + '</li>' +
									'<li title="alternative2">' + (details.single_item_alternative2 == null || details.single_item_alternative2 == '' ? '' : details.single_item_alternative2.detail_id) + '</li>' +
									'<li title="alternative3">' + (details.single_item_alternative3 == null || details.single_item_alternative3 == '' ? '' : details.single_item_alternative3.detail_id) + '</li>' +
									'<li title="alternative4">' + (details.single_item_alternative4 == null || details.single_item_alternative4 == '' ? '' : details.single_item_alternative4.detail_id) + '</li>' +
									'<li title="alternative5">' + (details.single_item_alternative5 == null || details.single_item_alternative5 == '' ? '' : details.single_item_alternative5.detail_id) + '</li>' +
									'<li title="alternative6">' + (details.single_item_alternative6 == null || details.single_item_alternative6 == '' ? '' : details.single_item_alternative6.detail_id) + '</li>' +
									'<li title="alternative7">' + (details.single_item_alternative7 == null || details.single_item_alternative7 == '' ? '' : details.single_item_alternative7.detail_id) + '</li>' +
									'<li title="yaowei">' + item_msg['measure'].measure_yaowei + '</li>' +
									'<li title="shengao">' + item_msg['measure'].measure_shengao + '</li>' +
									'<li title="tizhong">' + item_msg['measure'].measure_tizhong + '</li>' +
									'<li title="kuchang">' + item_msg['measure'].measure_kuchang + '</li>' +
									'<li title="datui">' + item_msg['measure'].measure_datui + '</li>' +
									'<li title="jiaowei">' + item_msg['measure'].measure_jiaowei + '</li>' +
									'<li title="qiandang">' + item_msg['measure'].measure_qiandang + '</li>' +
									'<li title="houdang">' + item_msg['measure'].measure_houdang + '</li>' +
									'<li title="tunwei">' + item_msg['measure'].measure_tunwei + '</li>' +
									'<li title="xigai">' + item_msg['measure'].measure_xigai + '</li>' + 
								'</ul>' + 
	                    '</li>' +
	                    '</ul>' +
	                '</div>' + 
	            '</div><!-- item detail -->' + 
	        '</div><!-- one item -->' + 
            '<hr/>' +
        '</div>';
		$('.cart-operation').before(html);

	}
}

function showMeasure(obj){
	if(obj.text() != '合身尺寸')
		return;
	if(obj.next().is(":hidden"))
		obj.next().show();
	else
		obj.next().hide();	
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
				get_sum();
				$.each($('.delete'), function(i,val){
					var item_id = $(this).find('ul').find('li[title="item_id"]').text();
					var color = $(this).find('ul').find('li[title="color"]').text();
					var fastener = $(this).find('ul').find('li[title="fastener"]').text();
					var linecolor = $(this).find('ul').find('li[title="linecolor"]').text();
					var metal = $(this).find('ul').find('li[title="metal"]').text();
					var placket = $(this).find('ul').find('li[title="placket"]').text();
					var plate = $(this).find('ul').find('li[title="plate"]').text();
					var thickness = $(this).find('ul').find('li[title="thickness"]').text();
					var trouserstype = $(this).find('ul').find('li[title="trouserstype"]').text();
					var backbag = $(this).find('ul').find('li[title="backbag"]').text();
					var alternative1 = $(this).find('ul').find('li[title="alternative1"]').text();
					var alternative2 = $(this).find('ul').find('li[title="alternative2"]').text();
					var alternative3 = $(this).find('ul').find('li[title="alternative3"]').text();
					var alternative4 = $(this).find('ul').find('li[title="alternative4"]').text();
					var alternative5 = $(this).find('ul').find('li[title="alternative5"]').text();
					var alternative6 = $(this).find('ul').find('li[title="alternative6"]').text();
					var alternative7 = $(this).find('ul').find('li[title="alternative7"]').text();
					
					var yaowei = $(this).find('ul').find('li[title="yaowei"]').text();
					var shengao = $(this).find('ul').find('li[title="shengao"]').text();
					var tizhong = $(this).find('ul').find('li[title="tizhong"]').text();
					var kuchang = $(this).find('ul').find('li[title="kuchang"]').text();
					var datui = $(this).find('ul').find('li[title="datui"]').text();
					var jiaowei = $(this).find('ul').find('li[title="jiaowei"]').text();
					var qiandang = $(this).find('ul').find('li[title="qiandang"]').text();
					var houdang = $(this).find('ul').find('li[title="houdang"]').text();
					var tunwei = $(this).find('ul').find('li[title="tunwei"]').text();
					var xigai = $(this).find('ul').find('li[title="xigai"]').text();

					//add item
					$(this).find('a').eq(0).click(function(){
						var c_block = $(this).parent().parent().parent().parent().parent().parent();
						$.ajax({
							url : site_url + 'cart/add_item',
							data : {
								item_id: item_id,
								
								thickness: thickness,
								color: color,
								metal: metal,
								linecolor: linecolor,
								plate: plate,
								fastener: fastener,
								placket: placket,
								trouserstype : trouserstype,
								backbag : backbag,
								alternative1 : alternative1,
								alternative2 : alternative2,
								alternative3 : alternative3,
								alternative4 : alternative4,
								alternative5 : alternative5,
								alternative6 : alternative6,
								alternative7 : alternative7,
		
								yaowei: yaowei,
								shengao: shengao,
								tizhong: tizhong,
								kuchang: kuchang,
								datui: datui,
								jiaowei: jiaowei,
								qiandang: qiandang,
								tunwei: tunwei,
								xigai: xigai,
								houdang: houdang,
		
								count : 1
							},
							type : "get",
							dataType : "json",
							success : function(data, textStatus){
								if(data.code == 0){
									//增加一个div块并向下滑动
									var new_block = c_block.clone(true);
									new_block.css("display", "none");
									c_block.after(new_block);
									new_block.slideDown("slow");
									get_sum();
								}
								else{
								}
							},
							error : function(){
							}
						});
					});
					
					//delete item
					$(this).find('a').eq(1).click(function(){
						var c_block = $(this).parent().parent().parent().parent().parent().parent();
						$.ajax({
							url : site_url + 'cart/del_item',
							data : {
								item_id: item_id,
								
								thickness: thickness,
								color: color,
								metal: metal,
								linecolor: linecolor,
								plate: plate,
								fastener: fastener,
								placket: placket,
								trouserstype : trouserstype,
								backbag : backbag,
								alternative1 : alternative1,
								alternative2 : alternative2,
								alternative3 : alternative3,
								alternative4 : alternative4,
								alternative5 : alternative5,
								alternative6 : alternative6,
								alternative7 : alternative7,
								
								yaowei: yaowei,
								shengao: shengao,
								tizhong: tizhong,
								kuchang: kuchang,
								datui: datui,
								jiaowei: jiaowei,
								qiandang: qiandang,
								tunwei: tunwei,
								xigai: xigai,
								houdang: houdang,
		
								count : 1
							},
							type : "get",
							dataType : "json",
							success : function(data, textStatus){
								if(data.code == 0){
									//删除一个div块并向上滑动
									c_block.slideUp("slow", del_block);
								}
								else{
								}
							},
							error : function(){
							}
						});
					});
				});
			}
		},
		error : function(){
		} 
	});
}

function del_block(){
	$(this).remove();
	get_sum();
}

function get_sum(){
	var amount = 0;
	$.each($('.single-price'), function(index, val){
		amount += parseInt($(this).text().substring(3));
	});
	$('#total-price').empty();
	$('#total-price').append('<span>合计: RMB</span>' +amount);
}


$(document).ready(function(){
	get_cart();
});
</script>

</body>
</html>
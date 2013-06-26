<script type="text/javascript" src="<?php echo base_url('js/washed.js');?>"></script>
<script charset="utf-8" src="<?php echo base_url('js/global.js'); ?>"></script>
<script type="text/javascript">
		/*后台交互*/
		
		var href = location.href;
		var param = href.split('/');
		var item_id = param[param.length-1];

		$.ajax({
			url : site_url + 'item/get_item_by_id',
			data : {
				item_id : item_id
			},
			type : "get",
			dataType : "json",
			success : function(data, textStatus){
				if(data.code == 0){
					var item = data.data.item;
					//防止不合法的item进入，影响细节选择
					if(item.item_type != 1)
						window.location.href = "/index.php";
					$('.big-photo').attr('src', images_url + 'item/' + item.item_photos[0]);
					$('.item-name').text(item.item_name);
					$('.price-large span').after(item.item_price);
					$('#price').attr('value', item.item_price);
					$('.item-intro').text(item.item_intro);
					for(var i = 0; i < item.item_small_photos.length; ++i){
						$('.small-photo-group .inline').append(
							'<li><img src="' + images_url + 'item/' + item.item_small_photos[i] + '" /></li>'
						);	
					}
					
					$('.default').attr('style', 'background-image:url(' + images_url + 'item/' + item.item_photos[0] + '); background-size:cover;');
					//$('.add-cart-header .price-small').append('<span>小计：RMB</span><p>'+item.item_price+'</p>');
					$('.price-label').text(item.item_price);
					$('.item-id').attr('value', item.item_id);


					$(".small-photo-group img").click(function(){
						var photo_path = $(this).attr("src");
						photo_path = photo_path.replace('_thumb', '');
						$(".big-photo").attr("src",photo_path);
					});

					get_detail();
					
				}
				else{
				}
			},
			error : function(){
			}
		});


		/*商品细节尺码选择*/
		function addToCart(){
			$('#buy-button').click(function(){
				
				if ($("#size-list").css("display") == 'none' )
					return;
				
				/*细节选择*/
				var thickness = $('input[name="thickness"]:checked').prev().prev().val();
				var color = $('input[name="color"]:checked').prev().prev().val();
				var metal = $('input[name="rivet"]:checked').prev().prev().val();
				var linecolor = $('input[name="linecolor"]:checked').prev().prev().val();
				var plate = $('input[name="plate"]:checked').prev().prev().val();
				var fastener = $('input[name="button"]:checked').prev().prev().val();
				var placket = $('input[name="placket"]:checked').prev().prev().val();
				
				/*var thickness = $('#thickness').text().split('：')[1];
				var color = $('#color').text().split('：')[1];
				var metal = $('#metal').text().split('：')[1];
				var linecolor = $('#linecolor').text().split('：')[1];
				var plate = $('#plate').text().split('：')[1];
				var fastener = $('#fastener').text().split('：')[1];
				var placket = $('#placket').text().split('：')[1];

				thickness = thickness == null ? '默认' : thickness;
				color = color == null ? '默认' : color;
				metal = metal == null ? '默认' : metal;
				linecolor = linecolor == null ? '默认' : linecolor;
				plate = plate == null ? '默认' : plate;
				fastener = fastener == null ? '默认' : fastener;
				placket = placket == null ? '默认' : placket;*/

				/*尺码选择*/
				var shengao = $('#shengao').text().split('：')[1];
				var tizhong = $('#tizhong').text().split('：')[1];
				var yaowei = $('#yaowei').text().split('：')[1];
				var kuchang = $('#kuchang').text().split('：')[1];
				var datui = $('#datui').text().split('：')[1];
				var jiaowei = $('#jiaowei').text().split('：')[1];
				var qiandang = $('#qiandang').text().split('：')[1];
				var tunwei = $('#tunwei').text().split('：')[1];
				var xigai = $('#xigai').text().split('：')[1];
				var houdang = $('#houdang').text().split('：')[1];

				if(yaowei != null && yaowei.indexOf('W') != -1)
					yaowei = parseInt(yaowei.substring(1)) * 100;
				
				if(kuchang != null && kuchang.indexOf('L') != -1)
					kuchang = parseInt(kuchang.substring(1)) * 100;
				
				shengao = shengao == null ? 0 : parseInt(shengao);
				tizhong = tizhong == null ? 0 : parseInt(tizhong);
				yaowei = yaowei == null ? $('select[name="yaowei"]').val() : parseInt(yaowei);
				kuchang = kuchang == null ? $('select[name="kuchang"]').val() : parseInt(kuchang);
				datui = datui == null ? 0 : parseInt(datui);
				jiaowei = jiaowei == null ? 0 : parseInt(jiaowei);
				qiandang = qiandang == null ? 0 : parseInt(qiandang);
				tunwei = tunwei == null ? 0 : parseInt(tunwei);
				xigai = xigai == null ? 0 : parseInt(xigai);
				houdang = houdang == null ? 0 : parseInt(houdang);

				$.ajax({
					url : site_url + 'cart/add_item',
					data : {
						item_id: $('.item-id').attr('value'),
						
						thickness: thickness,
						color: color,
						metal: metal,
						linecolor: linecolor,
						plate: plate,
						fastener: fastener,
						placket: placket,

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
							window.location.href = site_url + 'cart';
						}
						else{
						}
					},
					error : function(){
					}
				});
			});
		}

		function get_detail(){
			$.ajax({
				url: site_url + 'item_detail/get_by_item_type',
				data : {item_type : 1},
				type : 'get',
				dataType : 'json',
				success : function(data){

					if(data.code == 0){
						var details = data.data.details;

						//thickness
						var s_detail = get_by_detail_type(1, details);
						var html = '<input type="hidden" name="thickness-attach-price" value="0"/>';
						var li_class = 'sample';
						var bt_class = 'btn sample';
						for(var i = 0; i < s_detail.length; ++i){
							html += 
								'<li class="' + li_class + '">' + 
		                        	'<label>' +
		                        	'<input type="hidden" value="' + s_detail[i].detail_id + '">' +
		                        	'<input type="hidden" name="attach-price" value="' + s_detail[i].detail_attach_price + '">' +
		                            '<input type="radio"  name="thickness" value="' + s_detail[i].detail_name + '">' + 
		                        	'<button class="' + bt_class + '" style="background-image:url(' + images_url + 'detail/' + s_detail[i].detail_image + '); background-size:cover;" onclick="changePrice($(this))">' +                           
		                                '<span>' +
		                               
		                                '</span>' +
		                            '</button>' +
		                          	'</label>' +
		                        '</li>';
	                        li_class = 'option';
	                        bt_class = 'btn option';
							
						}
						$('#thickness-select .option-list').append(html);

						//color
						s_detail = get_by_detail_type(2, details);
						var html = '<input type="hidden" name="color-attach-price" value="0"/>';
						html += 
							'<li class="sample">' + 
		                        '<label>' + 
			                        '<input type="radio" name="color" value="default"/>' + 
			                    	'<button class="btn sample default" style="background-image:url(' + $(".big-photo").attr("src") + ');  background-size:cover;">' +                            
			                            '<span class="as-pic">' + 
			                           		'如图' +
			                            '</span>' +
			                        '</button>' +
		                      	'</label>' +
		                    '</li>';
						for(var i = 0; i < s_detail.length; ++i){
							html += 
								'<li class="option">' + 
		                        	'<label>' +
		                        	'<input type="hidden" value="' + s_detail[i].detail_id + '">' + 
		                        	'<input type="hidden" name="attach-price" value="' + s_detail[i].detail_attach_price + '">' +
		                            '<input type="radio" name="color" value="' + s_detail[i].detail_name + '"/>' +
		                        	'<button class="btn option" style="background-image:url(' + images_url + 'detail/' + s_detail[i].detail_image + ');background-size:cover;" onclick="changePrice($(this))">' +                              
		                                '<span>' +
		                                	s_detail[i].detail_name +
		                                '</span>' +
		                            '</button>' +
		                          	'</label>' +
		                        '</li>';
						}
						$('#color-select .option-list').append(html);

						//plate
						s_detail = get_by_detail_type(3, details);
						var html = '<input type="hidden" name="plate-attach-price" value="0"/>';
                    	html += 
							'<li class="sample">' + 
		                        '<label>' + 
			                        '<input type="radio" name="plate" value="default"/>' + 
			                    	'<button class="btn sample default" style="background-image:url(' + $(".big-photo").attr("src") + ');  background-size:cover;">' +                            
			                            '<span class="as-pic">' + 
			                           		'如图' +
			                            '</span>' +
			                        '</button>' +
		                      	'</label>' +
		                    '</li>';
						for(var i = 0; i < s_detail.length; ++i){
							html += 
								'<li class="option">' + 
		                        	'<label>' +
		                        	'<input type="hidden" value="' + s_detail[i].detail_id + '">' +
		                        	'<input type="hidden" name="attach-price" value="' + s_detail[i].detail_attach_price + '">' +
		                            '<input type="radio" name="plate" value="' + s_detail[i].detail_name + '"/>' +
		                        	'<button class="btn option" style="background-image:url(' + images_url + 'detail/' + s_detail[i].detail_image + ');background-size:cover;" onclick="changePrice($(this))">' +                              
		                                '<span>' +
		                                	s_detail[i].detail_name +
		                                '</span>' +
		                            '</button>' +
		                          	'</label>' +
		                        '</li>';
						}
						$('#banxing-select .option-list').append(html);

						//menjin
						s_detail = get_by_detail_type(4, details);
						var html = '<input type="hidden" name="placket-attach-price" value="0"/>';
						var li_class = 'sample';
						var bt_class = 'btn sample';
						for(var i = 0; i < s_detail.length; ++i){
							html += 
								'<li class="' + li_class + '">' +
		                            '<label>' +
		                        	'<input type="hidden" value="' + s_detail[i].detail_id + '">' +
		                        	'<input type="hidden" name="attach-price" value="' + s_detail[i].detail_attach_price + '">' +
		                            '<input type="radio" name="placket" value="' + s_detail[i].detail_name + '" />' +
		                            '<button class="' + bt_class + '" style="background-image:url(' + images_url + 'detail/' + s_detail[i].detail_image + '); background-size:cover;" onclick="changePrice($(this))">' +                           
		                                '<span>' +
		                               		s_detail[i].detail_name + 
		                                '</span>' +
		                            '</button>' +
		                            '</label>' +
		                        '</li>';
							li_class = 'option';
	                        bt_class = 'btn option';
						}
						$('#fly-select .option-list').append(html);

						//纽扣
						s_detail = get_by_detail_type(5, details);
						var html = '<input type="hidden" name="button-attach-price" value="0"/>';
                    	html += 
							'<li class="sample">' + 
		                        '<label>' + 
			                        '<input type="radio" name="button" value="如图"/>' + 
			                    	'<button class="btn sample default" style="background-image:url(' + $(".big-photo").attr("src") + ');  background-size:cover;">' +                            
			                            '<span class="as-pic">' + 
			                           		'如图' +
			                            '</span>' +
			                        '</button>' +
		                      	'</label>' +
		                    '</li>';
						for(var i = 0; i < s_detail.length; ++i){
							html += 
								'<li class="option">' + 
		                        	'<label>' +
		                        	'<input type="hidden" value="' + s_detail[i].detail_id + '">' +
		                        	'<input type="hidden" name="attach-price" value="' + s_detail[i].detail_attach_price + '">' +
		                            '<input type="radio" name="button" value="' + s_detail[i].detail_name + '"/>' +
		                        	'<button class="btn option" style="background-image:url(' + images_url + 'detail/' + s_detail[i].detail_image + ');background-size:cover;" onclick="changePrice($(this))">' +                              
		                                '<span>' +
		                                	s_detail[i].detail_name +
		                                '</span>' +
		                            '</button>' +
		                          	'</label>' +
		                        '</li>';
						}
						$('#metal-select .option-list').append(html);

						//zhuanding
						s_detail = get_by_detail_type(6, details);
						var html = '<input type="hidden" name="rivet-attach-price" value="0"/>';
                    	html += 
							'<li class="sample">' + 
		                        '<label>' + 
			                        '<input type="radio" name="rivet" value="如图"/>' + 
			                    	'<button class="btn sample default" style="background-image:url(' + $(".big-photo").attr("src") + ');  background-size:cover;">' +                            
			                            '<span>' + 
			                           		'如图' +
			                            '</span>' +
			                        '</button>' +
		                      	'</label>' +
		                    '</li>';
						for(var i = 0; i < s_detail.length; ++i){
							html += 
								'<li class="option">' + 
		                        	'<label>' +
		                        	'<input type="hidden" value="' + s_detail[i].detail_id + '">' +
		                        	'<input type="hidden" name="attach-price" value="' + s_detail[i].detail_attach_price + '">' +
		                            '<input type="radio" name="rivet" value="' + s_detail[i].detail_name + '"/>' +
		                        	'<button class="btn option" style="background-image:url(' + images_url + 'detail/' + s_detail[i].detail_image + ');background-size:cover;" onclick="changePrice($(this))">' +                              
		                                '<span>' +
		                                	s_detail[i].detail_name +
		                                '</span>' +
		                            '</button>' +
		                          	'</label>' +
		                        '</li>';
						}
						$('#metal2-select .option-list').append(html);

						//linecolor
						s_detail = get_by_detail_type(7, details);
						var html = '<input type="hidden" name="linecolor-attach-price" value="0"/>';
                    	html += 
							'<li class="sample">' + 
		                        '<label>' + 
			                        '<input type="radio" name="linecolor" value="default"/>' + 
			                    	'<button class="btn sample default" style="background-image:url(' + $(".big-photo").attr("src") + ');  background-size:cover;">' +                            
			                            '<span class="as-pic">' + 
			                           		'如图' +
			                            '</span>' +
			                        '</button>' +
		                      	'</label>' +
		                    '</li>';
						for(var i = 0; i < s_detail.length; ++i){
							html += 
								'<li class="option">' + 
		                        	'<label>' +
		                        	'<input type="hidden" value="' + s_detail[i].detail_id + '">' +
		                        	'<input type="hidden" name="attach-price" value="' + s_detail[i].detail_attach_price + '">' +
		                            '<input type="radio" name="linecolor" value="' + s_detail[i].detail_name + '"/>' +
		                        	'<button class="btn option" style="background-image:url(' + images_url + 'detail/' + s_detail[i].detail_image + ');background-size:cover;"  onclick="changePrice($(this))">' +                              
		                                '<span>' +
		                                	s_detail[i].detail_name +
		                                '</span>' +
		                            '</button>' +
		                          	'</label>' +
		                        '</li>';
						}
						$('#linecolor-select .option-list').append(html);

						//func. for select size
						init();
						hideSize();		//get custom fit size in this func.						
						//show more select func.
						showMoreSelect();					
						//get standard size
						getSelect();					
						checkCustomFit();					
						buy_check();
						radio_checked_style();
						
						addToCart();
					}
				},
				error : function(){
				}
			});
		}

		function changePrice(obj){
			var attach_price = 0;
			obj.parent().parent().parent().find('input:first').attr('value', obj.prev().prev().val());
			attach_price += parseInt($('input[name="thickness-attach-price"]').val());
			attach_price += parseInt($('input[name="color-attach-price"]').val());
			attach_price += parseInt($('input[name="plate-attach-price"]').val());
			attach_price += parseInt($('input[name="placket-attach-price"]').val());
			attach_price += parseInt($('input[name="button-attach-price"]').val());
			attach_price += parseInt($('input[name="rivet-attach-price"]').val());
			attach_price += parseInt($('input[name="linecolor-attach-price"]').val());
			var price = parseInt($('#price').val());
			
			$('.price-label').text(parseInt(attach_price) + parseInt(price));
		}
		
		$(window).scroll(function() {
			if($(document).scrollTop() < 100 ) {
				$("#sidebar").css({"position":"static", "margin-left":"10px"});
			}
			else {
				$("#sidebar").css({"position":"fixed", "top":"0px", "left":"50%", "margin-left":"248px"});
			}
		});
		
		function get_by_detail_type(detail_type, details){
			var t_details = new Array();
			for(var i = 0; i < details.length; ++i){
				if(details[i].detail_type == detail_type)
					t_details.push(details[i]);
			}
			return t_details;
		}

		$(document).ready(function(){
		});
    </script>    
    
</body>
</html>
<script type="text/javascript">
$(document).ready(function(){

	get_measures();
});

function get_measures(){
	$.ajax({
		url : site_url + 'size/get',
		data : {},
		type: 'get',
		dataType : 'json',
		success : function(data){
			if(data.code == 0){
				measures = data.data.measures;
				for(var i = 0; i < measures.length; i++){
					var item_size = '';
					if(measures[i].measure_yaowei > 1000 || measures[i].measure_kuchang > 1000)
						item_size = 'W' + measures[i].measure_yaowei/100 + ' ' + 'L' + measures[i].measure_kuchang/100;
					else
						item_size = '腰围：' + measures[i].measure_yaowei + 'cm 裤长：' + measures[i].measure_kuchang + 'cm 臀围：' + measures[i].measure_tunwei + 'cm';
					var html = 
						'<tr class="" id="">' +
							'<input value="' + measures[i].measure_id + '" type="hidden">' + 
		                    '<td>' + item_size + '</td>' +
		                    '<td>' +
		                        '<a href="javascript:void()" onClick="del_measure($(this))">删除</a>' +
		                    '</td>';
					 if(measures[i].measure_default == true)
		                    html += '<td class="measure_default"><a class="be-default" href="javascript:void()" onClick="set_measure_default($(this))">默认尺码</a></td>' +
		                '</tr>';
					 else
						 html += '<td class="measure_default"><a class="set-default" href="javascript:void()" onClick="set_measure_default($(this))">设为默认</a></td>' +
			                '</tr>';

		                
					/*var html = 
						'<tr class="" id="">' +
							'<input value="' + receivers[i].receiver_id + '" type="hidden">' + 
		                    '<td>' + receivers[i].receiver_name+ '</td>' +
		                    '<td>' + receivers[i].receiver_area.replace(",", " ") + ' ' + receivers[i].receiver_address + '</td>' + 
		                    '<td>' + receivers[i].receiver_phone + '</td>' + 
		                    '<td>' + 
		                        '<a href="javascript:void()" onClick="del_receiver($(this))">删除</a>' +
		                    '</td>';
                    if(receivers[i].is_default == true)
                    	html += '<td class="address_default"><a href="javascript:void()" class="be-default" onclick="set_receiver_default($(this))">默认地址</a></td>' +
		                '</tr>';
                    else
		                html += '<td class="address_default"><a href="javascript:void()" class="set-default" onclick="set_receiver_default($(this))">设为默认</a></td>' +
		                '</tr>';*/
					$('.table-striped').append(html);
				} 
			}
		},
		error : function(){
			
		}
	});
}

function set_measure_default(obj){
	var measure_id = obj.parent().parent().find('input').attr('value');
	$.ajax({
		url : site_url + 'size/set_default',
		data : {measure_id : measure_id},
		type: 'get',
		dataType : 'json',
		success : function(data){
			if(data.code == 0){
				$('.be-default').text("设为默认");
				$('.be-default').attr("class", "set-default");
				obj.text("默认尺码");
				obj.attr("class", "be-default");	
			}
		},
		error : function(){
			
		}
	});
}

function del_measure(obj){
	var measure_id = obj.parent().parent().find('input').attr('value');
	$.ajax({
		url : site_url + 'size/del_measure',
		data : {measure_id : measure_id},
		type: 'get',
		dataType : 'json',
		success : function(data){
			if(data.code == 0){
				obj.parent().parent().hide("slow");
			}
		},
		error : function(){
			
		}
	});
}
</script>
</body>
</html>
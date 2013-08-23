<script type="text/javascript">

$(document).ready(function(){

	get_receivers();
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
		                '</tr>';
					/*var html = 
						'<label>' +
            				'<input type="radio" name="address_select" value="' + receivers[i].receiver_id + '" ' + (receivers[i].is_default == 1 ? 'checked' : '') + '/><span>' + receivers[i].receiver_area + ',' + receivers[i].receiver_address + ' | 收件人：' + receivers[i].receiver_name +  ' | 联系电话：' + receivers[i].receiver_phone +'</span>' +
                    		'<a class="set-default" onclick="set_receiver_default($(this))">设为默认</a> <a class="delete" onclick="del_receiver($(this))">删除</a>' + 
                		'</label>';*/
					$('.table-striped').append(html);
				} 
			}
		},
		error : function(){
			
		}
	});
}

function set_receiver_default(obj){
	var receiver_id = obj.parent().parent().find('input').attr('value');
	$.ajax({
		url : site_url + 'receiver/set_default',
		data : {receiver_id : receiver_id},
		type: 'get',
		dataType : 'json',
		success : function(data){
			if(data.code == 0){
				$('.be-default').text("设为默认");
				$('.be-default').attr("class", "set-default");
				obj.text("默认地址");
				obj.attr("class", "be-default");	
			}
		},
		error : function(){
			
		}
	});
}

function del_receiver(obj){
	var receiver_id = obj.parent().parent().find('input').attr('value');
	$.ajax({
		url : site_url + 'receiver/del',
		data : {receiver_id : receiver_id},
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
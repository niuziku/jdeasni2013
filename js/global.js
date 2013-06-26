var base_url = 'http://localhost/idjeans/';
//var base_url = 'http://www.idjeans.cn/';
var site_url = base_url + 'index.php/';
var images_url = base_url + 'images/';

$(document).ready(function(){
	login_jump();
});

function login_jump(){
	$('#my-account').click(function(){
		$.ajax({
			url : site_url + 'login/is_login',
			data : {},
			type : 'get',
			dataType : 'json',
			success : function(data){
				if(data.code == 0 && data.data.login == true){
					window.location.href = site_url + 'order';
				}
				else{
					window.location.href = site_url + 'login';
				}
			},
			error : function(){
			}
		});
	});
}
<script charset="utf-8" src="<?php echo base_url('js/jquery.form.js'); ?>"></script>
<script charset="utf-8" src="<?php echo base_url('js/global.js'); ?>"></script>
<script type="text/javascript">


$(document).ready(function(){
	login();
	$('.login-btn').click(function(){
		$(".form-horizontal").submit();
	});
});

function login(){
	$(".form-horizontal").ajaxForm({
		dataType: "json",
		url: site_url + 'login/dologin',
		type: "post",
		beforeSubmit: function(){},
		success: function(data){
			if(data.code == 0){
				window.location.href= site_url + 'order';
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
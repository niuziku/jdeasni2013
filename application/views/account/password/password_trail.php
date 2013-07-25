<script charset="utf-8" src="<?php echo base_url('js/global.js'); ?>"></script>
<script charset="utf-8" src="<?php echo base_url('js/jquery.form.js'); ?>"></script>
<script charset="utf-8" src="<?php echo base_url('js/global.js'); ?>"></script>
<script type="text/javascript">


$(document).ready(function(){
	changePassword();
	$('#change-psd-btn').click(function(){
		$(".form-horizontal").submit();
	});
});

function changePassword(){
	$(".form-horizontal").ajaxForm({
		dataType: "json",
		url: site_url + 'customer/change_password',
		type: "post",
		beforeSubmit: function(){},
		success: function(data){
			if(data.code == 0){
				alert('密码修改成功');
				window.location.href= site_url + 'order';
			}
			else{
				alert(data.message);
			}
		},
		error : function(){
		}
	});
}
</script>
</body>
</html>
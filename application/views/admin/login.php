<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('css/admin.css'); ?>" />
	<title>Login</title>
    <script type="text/javascript" src="<?php echo base_url('js/jquery-1.9.1.min.js'); ?>"></script>
</head>

<body>

<div id="wrap">
    <div id="login">
        <form id="login_form" name="login_form" method="post">
        	<h3>登陆</h3>
            <p><span>账户</span><input type="text" name="email"></p>
            <p><span>密码</span><input type="password" name="password"></p>
            <p><input class="login_button" type="submit" name="submit" value="登陆"></p>
        </form>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	var admin_url = "<?php echo site_url('admin')?>" + '/';
	$("#login_form").submit(function() {
		
		if(login_form.email.value=="") {
			alert("账户不能为空！");
			document.login_form.elements[0].focus();
			return false;
		}
		
		if(login_form.password.value=="") {
			alert("密码不能为空！");
			document.login_form.elements[1].focus();
			return false;
		}
		$.ajax({
			url : admin_url + "login/login_operation",
			data : $("#login_form").serialize(),
			type: "post",
			dataType : "json",
			success : function(data, status) {
				if(data.code == 0) {
					window.location.href = admin_url + "order";
				}
				else {
					alert("用户名或密码错误！");
					document.login_form.elements[0].focus();
					return false;
				}
			},
			error : function() {
				
			}
		});
		return false;
	});
});
</script>
</body>

</html>
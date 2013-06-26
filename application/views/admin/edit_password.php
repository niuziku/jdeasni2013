	<div id="main">
		<div id="nav">
        	<h3>修改密码</h3>
        </div>
        
        <div id="content">
        	<form id="password_form" name="password_form" method="post">
            	<p><span>原密码</span><input name="old_password" type="password" /></p>
                <p><span>新密码</span><input name="new_password" type="password" /></p>
                <p><span>重复新密码</span><input name="new_password_twice" type="password" /></p>
                <input class="submit_button" type="submit" name="submit" value="提交" />
            </form>
        </div>
        
        <script type="text/javascript">
			$(document).ready(function() {
				var admin_url = "<?php echo site_url('admin');?>" + '/';
				$("#password_form").submit(function() {
					
					if(password_form.old_password.value=="") {
						alert("旧密码不能为空！");
						document.password_form.elements[0].focus();
						return false;
					}
					if(password_form.new_password.value=="") {
						alert("新密码不能为空！");
						document.password_form.elements[1].focus();
						return false;
					}
					if(password_form.new_password.value.length < 6) {
						alert("新密码不能少于6位！");
						document.password_form.elements[1].focus();
						return false;
					}
					if(password_form.new_password_twice.value=="") {
						alert("请重新输入新密码！");
						document.password_form.elements[2].focus();
						return false;
					}
					if(password_form.new_password.value!=password_form.new_password_twice.value) {
						alert("新密码输入不一致！");
						document.password_form.elements[2].focus();
						return false;
					}
					if(password_form.old_password.value==password_form.new_password_twice.value) {
						alert("新密码与旧密码相同！");
						document.password_form.elements[1].focus();
						return false;
					}
					
					$.ajax({
						url : admin_url + "admin/password_operation",
						data : $("#password_form").serialize(),
						type: "post",
						dataType : "json",
						success : function(data, status) {
							if(data.code == 0) {
								alert("修改成功！");
							}
							else if(data.code == 666) {
								alert("旧密码错误！");
							}
							else {
							}
						},
						error : function() {
							
						}
					});
					return false;
				});
			});
		</script>
    </div>
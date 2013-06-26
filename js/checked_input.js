$(document).ready(function() {
	get_address();
	check_address();
});

function get_address() {
	
	$("#input_name").change(function() {
		$("#name").text($("#input_name").val());
	});
	
	$("#input_phone").change(function() {
		$("#phone").text($("#input_phone").val());
	});
	
	$("#input_province").change(function() {
		$("#province").text($("#input_province").val());
	});
	
	$("#input_city").change(function() {
		$("#city").text($("#input_city").val());
	});
	
	$("#input_address").change(function() {
		$("#address").text($("#input_address").val());
	});
}


function check_address() {
	var email_reg = /^([a-zA-Z0-9]+[\_|\.]?)*[a-zA-Z0-9]+@+[a-zA-Z0-9]+([a-zA-Z0-9]+[\_|\.]?)*[a-zA-Z0-9]+\.+[a-zA-Z]{2,4}$/;
	var cellphone_reg = /^[0-1][0-9]{10}$/;
	
	$("#input_email").blur(function() {
		if ($("#input_email").val() == ''){
		//icon
			$("#input_email").next().addClass("icon-remove icon-red");
			$("#input_email").next().removeClass("icon-ok icon-green");
			//tips word
			$("#input_email").next().next().css({color: '#BA1F1F'});
			$("#input_email").next().next().text("请填写邮箱");
			wrong = 1;
		}
		else
			if (! email_reg.test($("#input_email").val()) ){
				//icon
				$("#input_email").next().addClass("icon-remove icon-red");
				$("#input_email").next().removeClass("icon-ok icon-green");
				//tips word
				$("#input_email").next().next().css({color: '#BA1F1F'});
				$("#input_email").next().next().text("邮箱格式不对");
				wrong = 1;
			}
			else {
				//icon
				$("#input_email").next().removeClass("icon-remove icon-red");
				$("#input_email").next().addClass("icon-ok icon-green");
				//tips word
				$("#input_email").next().next().text("");
			}
	});
	
	$("#input_name").blur(function() {
		if ($("#input_name").val() == ''){
		//icon
			$("#input_name").next().addClass("icon-remove icon-red");
			$("#input_name").next().removeClass("icon-ok icon-green");
			//tips word
			$("#input_name").next().next().css({color: '#BA1F1F'});
			$("#input_name").next().next().text("请填写收件人名字");
		}
		else {
				//icon
				$("#input_name").next().removeClass("icon-remove icon-red");
				$("#input_name").next().addClass("icon-ok icon-green");
				//tips word
				$("#input_name").next().next().text("");
			}
	});
	
	$("#input_phone").blur(function() {
		if ($("#input_phone").val() == ''){
		//icon
			$("#input_phone").next().addClass("icon-remove icon-red");
			$("#input_phone").next().removeClass("icon-ok icon-green");
			//tips word
			$("#input_phone").next().next().css({color: '#BA1F1F'});
			$("#input_phone").next().next().text("请填写联系电话");
		}
		else {
				//icon
				$("#input_phone").next().removeClass("icon-remove icon-red");
				$("#input_phone").next().addClass("icon-ok icon-green");
				//tips word
				$("#input_phone").next().next().text("");
			}
		/*else
			if (! email_reg.test($("#input_email").val()) ){
				//icon
				$("#input_email").next().addClass("icon-remove icon-red");
				$("#input_email").next().removeClass("icon-ok icon-green");
				//tips word
				$("#input_email").next().next().css({color: '#BA1F1F'});
				$("#input_email").next().next().text("邮箱格式不对");
				wrong = 1;
			}
			else {
				//icon
				$("#input_email").next().removeClass("icon-remove icon-red");
				$("#input_email").next().addClass("icon-ok icon-green");
				//tips word
				$("#input_email").next().next().text("");
			}*/
	});
	
	$("#input_province").blur(function() {
		if ($("#input_province").val() == ''){
		//icon
			$("#input_province").next().addClass("icon-remove icon-red");
			$("#input_province").next().removeClass("icon-ok icon-green");
			//tips word
			$("#input_province").next().next().css({color: '#BA1F1F'});
			$("#input_province").next().next().text("请填写省份");
		}
		else {
				//icon
				$("#input_province").next().removeClass("icon-remove icon-red");
				$("#input_province").next().addClass("icon-ok icon-green");
				//tips word
				$("#input_province").next().next().text("");
			}
	});
	
	$("#input_city").blur(function() {
		if ($("#input_city").val() == ''){
		//icon
			$("#input_city").next().addClass("icon-remove icon-red");
			$("#input_city").next().removeClass("icon-ok icon-green");
			//tips word
			$("#input_city").next().next().css({color: '#BA1F1F'});
			$("#input_city").next().next().text("请填写城市");
		}
		else {
				//icon
				$("#input_city").next().removeClass("icon-remove icon-red");
				$("#input_city").next().addClass("icon-ok icon-green");
				//tips word
				$("#input_city").next().next().text("");
			}
	});
	
	$("#input_address").blur(function() {
		if ($("#input_address").val() == ''){
		//icon
			$("#input_address").next().addClass("icon-remove icon-red");
			$("#input_address").next().removeClass("icon-ok icon-green");
			//tips word
			$("#input_address").next().next().css({color: '#BA1F1F'});
			$("#input_address").next().next().text("请填写地址");
		}
		else {
				//icon
				$("#input_address").next().removeClass("icon-remove icon-red");
				$("#input_address").next().addClass("icon-ok icon-green");
				//tips word
				$("#input_address").next().next().text("");
			}
	});
}


function submit_address() {
	var wrong = 0;
	var email_reg = /^([a-zA-Z0-9]+[\_|\.]?)*[a-zA-Z0-9]+@+[a-zA-Z0-9]+([a-zA-Z0-9]+[\_|\.]?)*[a-zA-Z0-9]+\.+[a-zA-Z]{2,4}$/;
	var cellphone_reg = /^[0-1][0-9]{10}$/;
	
	if ($("#input_address").val() == ''){
	//icon
		$("#input_address").next().addClass("icon-remove icon-red");
		$("#input_address").next().removeClass("icon-ok icon-green");
		//tips word
		$("#input_address").next().next().css({color: '#BA1F1F'});
		$("#input_address").next().next().text("请填写地址");
		//focus
		$("#input_address").focus();
		wrong = 1;
	}
	
	if ($("#input_city").val() == ''){
	//icon
		$("#input_city").next().addClass("icon-remove icon-red");
		$("#input_city").next().removeClass("icon-ok icon-green");
		//tips word
		$("#input_city").next().next().css({color: '#BA1F1F'});
		$("#input_city").next().next().text("请填写城市");
		//focus
		$("#input_city").focus();
		wrong = 1;
	}
	
	if ($("#input_province").val() == ''){
	//icon
		$("#input_province").next().addClass("icon-remove icon-red");
		$("#input_province").next().removeClass("icon-ok icon-green");
		//tips word
		$("#input_province").next().next().css({color: '#BA1F1F'});
		$("#input_province").next().next().text("请填写省份");
		//focus
		$("#input_province").focus();
		wrong = 1;
	}
	
		if ($("#input_phone").val() == ''){
	//icon
		$("#input_phone").next().addClass("icon-remove icon-red");
		$("#input_phone").next().removeClass("icon-ok icon-green");
		//tips word
		$("#input_phone").next().next().css({color: '#BA1F1F'});
		$("#input_phone").next().next().text("请填写联系电话");
		//focus
		$("#input_phone").focus();
		wrong = 1;
	}
	/*else
		if (! email_reg.test($("#input_email").val()) ){
			//icon
			$("#input_email").next().addClass("icon-remove icon-red");
			$("#input_email").next().removeClass("icon-ok icon-green");
			//tips word
			$("#input_email").next().next().css({color: '#BA1F1F'});
			$("#input_email").next().next().text("邮箱格式不对");
			wrong = 1;
		}
		else {
			//icon
			$("#input_email").next().removeClass("icon-remove icon-red");
			$("#input_email").next().addClass("icon-ok icon-green");
			//tips word
			$("#input_email").next().next().text("");
		}*/

	if ($("#input_name").val() == ''){
	//icon
		$("#input_name").next().addClass("icon-remove icon-red");
		$("#input_name").next().removeClass("icon-ok icon-green");
		//tips word
		$("#input_name").next().next().css({color: '#BA1F1F'});
		$("#input_name").next().next().text("请填写收件人名字");
		//focus
		$("#input_name").focus();
		wrong = 1;
	}
	
	if ($("#input_email").val() == ''){
	//icon
		$("#input_email").next().addClass("icon-remove icon-red");
		$("#input_email").next().removeClass("icon-ok icon-green");
		//tips word
		$("#input_email").next().next().css({color: '#BA1F1F'});
		$("#input_email").next().next().text("请填写邮箱");
		//focus
		$("#input_email").focus();
		wrong = 1;
	}
	else
		if (! email_reg.test($("#input_email").val()) ){
			//icon
			$("#input_email").next().addClass("icon-remove icon-red");
			$("#input_email").next().removeClass("icon-ok icon-green");
			//tips word
			$("#input_email").next().next().css({color: '#BA1F1F'});
			$("#input_email").next().next().text("邮箱格式不对");
			//focus
			$("#input_email").focus();
			wrong = 1;
		}
		else {
			//icon
			$("#input_email").next().removeClass("icon-remove icon-red");
			$("#input_email").next().addClass("icon-ok icon-green");
			//tips word
			$("#input_email").next().next().text("");
		}

	if (!wrong)
		return true;
	else
		return false;

}


function new_address() {
	$("#address_input_form").toggle("fast");
	$("#add_new_address").hide();
}

function cancel_new_address() {
	$("#address_input_form").hide("fast");
	$("#add_new_address").show();
}

function add_new_address() {
	var wrong = 0;
	var email_reg = /^([a-zA-Z0-9]+[\_|\.]?)*[a-zA-Z0-9]+@+[a-zA-Z0-9]+([a-zA-Z0-9]+[\_|\.]?)*[a-zA-Z0-9]+\.+[a-zA-Z]{2,4}$/;
	var cellphone_reg = /^[0-1][0-9]{10}$/;
	
	if ($("#input_address").val() == ''){
	//icon
		$("#input_address").next().addClass("icon-remove icon-red");
		$("#input_address").next().removeClass("icon-ok icon-green");
		//tips word
		$("#input_address").next().next().css({color: '#BA1F1F'});
		$("#input_address").next().next().text("请填写地址");
		//focus
		$("#input_address").focus();
		wrong = 1;
	}
	
	if ($("#input_city").val() == ''){
	//icon
		$("#input_city").next().addClass("icon-remove icon-red");
		$("#input_city").next().removeClass("icon-ok icon-green");
		//tips word
		$("#input_city").next().next().css({color: '#BA1F1F'});
		$("#input_city").next().next().text("请填写城市");
		//focus
		$("#input_city").focus();
		wrong = 1;
	}
	
	if ($("#input_province").val() == ''){
	//icon
		$("#input_province").next().addClass("icon-remove icon-red");
		$("#input_province").next().removeClass("icon-ok icon-green");
		//tips word
		$("#input_province").next().next().css({color: '#BA1F1F'});
		$("#input_province").next().next().text("请填写省份");
		//focus
		$("#input_province").focus();
		wrong = 1;
	}
	
		if ($("#input_phone").val() == ''){
	//icon
		$("#input_phone").next().addClass("icon-remove icon-red");
		$("#input_phone").next().removeClass("icon-ok icon-green");
		//tips word
		$("#input_phone").next().next().css({color: '#BA1F1F'});
		$("#input_phone").next().next().text("请填写联系电话");
		//focus
		$("#input_phone").focus();
		wrong = 1;
	}
	/*else
		if (! email_reg.test($("#input_email").val()) ){
			//icon
			$("#input_email").next().addClass("icon-remove icon-red");
			$("#input_email").next().removeClass("icon-ok icon-green");
			//tips word
			$("#input_email").next().next().css({color: '#BA1F1F'});
			$("#input_email").next().next().text("邮箱格式不对");
			wrong = 1;
		}
		else {
			//icon
			$("#input_email").next().removeClass("icon-remove icon-red");
			$("#input_email").next().addClass("icon-ok icon-green");
			//tips word
			$("#input_email").next().next().text("");
		}*/

	if ($("#input_name").val() == ''){
	//icon
		$("#input_name").next().addClass("icon-remove icon-red");
		$("#input_name").next().removeClass("icon-ok icon-green");
		//tips word
		$("#input_name").next().next().css({color: '#BA1F1F'});
		$("#input_name").next().next().text("请填写收件人名字");
		//focus
		$("#input_name").focus();
		wrong = 1;
	}
	
	if (!wrong) {
		/*$(".select-address").prepend(
			"<label><input type='radio' name='address_select' checked='checked'/>" + $("#input_province").val() + ", " + $("#input_city").val() + ", " + $("#input_address").val() + " | 收件人: " + $("#input_name").val() + " | 联系电话: " + $("#input_phone").val() +" <a class='set-default'>设为默认</a> <a class='delete'>删除</a></label>");
		$("#address_input_form").hide("fast");
		$("#add_new_address").show("fast");*/
	}	
	else {
		return false;
	}
}
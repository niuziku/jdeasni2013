$(document).ready(function() {
	checkMessage();
});

function checkMessage() {

	var email_reg = /^([a-zA-Z0-9]+[\_|\.]?)*[a-zA-Z0-9]+@+[a-zA-Z0-9]+([a-zA-Z0-9]+[\_|\.]?)*[a-zA-Z0-9]+\.+[a-zA-Z]{2,4}$/;
	var cellphone_reg = /^[0-1][0-9]{10}$/;

	$("#input_email").change(function() {
		if (! email_reg.test($("#input_email").val()) ){
			//icon
			$("#input_email").next().addClass("icon-remove icon-red");
			$("#input_email").next().removeClass("icon-ok icon-green");
			//tips word
			$("#input_email").next().next().css({color: '#BA1F1F'});
			$("#input_email").next().next().text("邮箱格式不对");
		}
		else {
			//icon
			$("#input_email").next().removeClass("icon-remove icon-red");
			$("#input_email").next().addClass("icon-ok icon-green");
			//tips word
			$("#input_email").next().next().text("");
		}
	});
	
	
	$("#input_phone").change(function() {
		if (! cellphone_reg.test($("#input_phone").val()) ){
			//icon
			$("#input_phone").next().addClass("icon-remove icon-red");
			$("#input_phone").next().removeClass("icon-ok icon-green");
			//tips word
			$("#input_phone").next().next().text("手机号码不对");
		}
		else {
			//icon
			$("#input_phone").next().removeClass("icon-remove icon-red");
			$("#input_phone").next().addClass("icon-ok icon-green");
			//tips word
			$("#input_phone").next().next().text("");
		}
	});
	
	$("#input_content").keyup(function() {
		checkContent();
	});
}

function checkContent() {
	var rest = 500 - $("#input_content").val().length;
	$("#content-tips2").hide();
	
	if (rest < 0 ){
		var over = -rest;
		$("#content-tips").show();
		$("#word_number").text( over );
		return false;
	}
	else {
		$("#content-tips").hide();
		return true;
	}
}


function submitMessage() {
	var wrong = 0;
	var email_reg = /^([a-zA-Z0-9]+[\_|\.]?)*[a-zA-Z0-9]+@+[a-zA-Z0-9]+([a-zA-Z0-9]+[\_|\.]?)*[a-zA-Z0-9]+\.+[a-zA-Z]{2,4}$/;
	var cellphone_reg = /^[0-1][0-9]{10}$/;

	if ($("#input_name").val() == ''){
		//icon
			$("#input_name").next().addClass("icon-remove icon-red");
			$("#input_name").next().removeClass("icon-ok icon-green");
			//tips word
			$("#input_name").next().next().css({color: '#BA1F1F'});
			$("#input_name").next().next().text("请填写名字");
			wrong = 1;
	}

	if ($("#input_email").val() == ''){
		//icon
			$("#input_email").next().addClass("icon-remove icon-red");
			$("#input_email").next().removeClass("icon-ok icon-green");
			//tips word
			$("#input_email").next().next().css({color: '#BA1F1F'});
			$("#input_email").next().next().text("请填写邮箱");
			wrong = 1;
	}
	else {
		if (! email_reg.test($("#input_email").val()) ){
			//icon
			$("#input_email").next().addClass("icon-remove icon-red");
			$("#input_email").next().removeClass("icon-ok icon-green");
			//tips word
			$("#input_email").next().next().css({color: '#BA1F1F'});
			$("#input_email").next().next().text("邮箱格式不对");
			wrong = 1;
		}
	}
	
	
	if ($("#input_phone").val() == ''){
		//icon
			$("#input_phone").next().addClass("icon-remove icon-red");
			$("#input_phone").next().removeClass("icon-ok icon-green");
			//tips word
			$("#input_phone").next().next().css({color: '#BA1F1F'});
			$("#input_phone").next().next().text("请填写手机");
			wrong = 1;
	}
	else {
		if (! cellphone_reg.test($("#input_phone").val()) ){
			//icon
			$("#input_phone").next().addClass("icon-remove icon-red");
			$("#input_phone").next().removeClass("icon-ok icon-green");
			//tips word
			$("#input_phone").next().next().css({color: '#BA1F1F'});
			$("#input_phone").next().next().text("手机号码不对");
			wrong = 1;
		}
	}
	
	
	if ($("#input_content").val() == ''){
		//content tips2 is 请填写留言内容
		$("#content-tips").hide();
		$("#content-tips2").show();
		wrong = 1;
	}
	else {
		wrong = ! checkContent();
	}
	
	
	if (!wrong)
		return true;
	else
		return false;
}
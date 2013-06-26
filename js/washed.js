$(document).ready(function() {
	//func. for select size
	
});

function init() {
	//show and hide block
	$("#standard-size").show();
	$("#custom-fit").hide();
	$("#sample-fit").hide();
	//change the button style
	$("#standard-size-button").addClass("active btn-primary");
	$("#custom-fit-button").removeClass("btn-primary active");
	$("#sample-fit-button").removeClass("btn-primary active");
	
	//hide more select
	$("#more-select").hide();
	
	//hide list
	//$("#list").hide();
	$("#select-list p").hide();
	$("#select-list").hide();
	$("#size-list").hide();
	$("#size-list p").hide();
}

function hideSize() {
	$("#standard-size-button").click(function(){
		//show and hide block
		$("#standard-size").show();
		$("#custom-fit").hide();
		$("#sample-fit").hide();
		//change the button style
		$("#standard-size-button").addClass("active btn-primary");
		$("#custom-fit-button").removeClass("btn-primary active");
		$("#sample-fit-button").removeClass("btn-primary active");
		
		//about size
		$("#size-list p").hide();
		getSize();
	});
	
	$("#custom-fit-button").click(function(){
		//show and hide block
		$("#standard-size").hide();
		$("#custom-fit").show();
		$("#sample-fit").hide();
		//change the button style
		$("#standard-size-button").removeClass("active btn-primary");
		$("#custom-fit-button").addClass("btn-primary active");
		$("#sample-fit-button").removeClass("btn-primary active");
		
		//about size
		$("#size-list p").hide();
		getCustomFit();
		hideList();
	});
	
	$("#sample-fit-button").click(function(){
		//show and hide block
		$("#standard-size").hide();
		$("#custom-fit").hide();
		$("#sample-fit").show();
		//change the button style
		$("#standard-size-button").removeClass("active btn-primary");
		$("#custom-fit-button").removeClass("btn-primary active");
		$("#sample-fit-button").addClass("btn-primary active");
		
		//about size
		$("#size-list p").hide();
		$("#sample").show();
		$("#list").show();
		$("#size-list").show();
	});
}



function showMoreSelect() {
	$("#more-select-button").click(function(){
		$("#more-select").toggle("fast");
		
	});
}


function hideBlock() {
	if ($("#select-list").css("display") == 'none' && $("#size-list").css("display") == 'none'){
		//$("#list").hide();
	}
}

function hideList() {
	  if ($("#select-list p").text() == '') {
		  $("#select-list").hide();
	  }
	  
	  if ($("#shengao").css("display") == 'none' && $("#tizhong").css("display") == 'none' && $("#yaowei").css("display") == 'none' && 
	  		$("#kuchang").css("display") == 'none' && $("#datui").css("display") == 'none' && $("#jiaowei").css("display") == 'none' && 
			$("#qiandang").css("display") == 'none' && $("#tunwei").css("display") == 'none' && $("#xigai").css("display") == 'none' && 
			$("#houdang").css("display") == 'none') {
			$("#size-list").hide();
	  }
  }


function getSelect() {
	var right_block = $("#list");
	
	/*$("input:radio").click(function() {
		var value = $("input:radio:checked").val();
		var name = $("input:radio:checked").attr("name");
		right_block.append("<p>"+name+":"+value+"</p>"); 
	});*/

	//banxing
	$("input:radio[name=plate]").click(function() {
		var value = $("input:radio[name=plate]:checked").val();
		if ( value == 'default'){
			$("#plate").text("") ;
			$("#plate").hide();
			hideList();
			hideBlock();
		}
		else {
			right_block.show();
			$("#select-list").show();
			$("#plate").show();
			$("#plate").text("板型："+value) ;
		}
	});
	
	//kuxing trousers type
	$("input:radio[name=trouserstype]").click(function() {
		var value = $("input:radio[name=trouserstype]:checked").val();
		if ( value == 'default'){
			$("#trouserstype").text("") ;
			$("#trouserstype").hide();
			hideList();
			hideBlock();
		}
		else {
			right_block.show();
			$("#select-list").show();
			$("#trouserstype").show();
			$("#trouserstype").text("裤型："+value) ;
		}
	});
	
	//thickness
	$("input:radio[name=thickness]").click(function() {
		var value = $("input:radio[name=thickness]:checked").val();
		if ( value == 'default'){
			$("#thickness").text("") ;
			$("#thickness").hide();
			hideList();
			hideBlock();
		}
		else {
			right_block.show();
			$("#select-list").show();
			$("#thickness").show();
			$("#thickness").text("厚度："+value);
		}
	});
	
	//color
	$("input:radio[name=color]").click(function() {
		var value = $("input:radio[name=color]:checked").val();
		if ( value == 'default'){
			$("#color").text("") ;
			$("#color").hide();
			hideList();
			hideBlock();
		}
		else {
			right_block.show();
			$("#select-list").show();
			$("#color").show();
			$("#color").text("颜色："+value) ;
		}
	});
	
	//placket
	$("input:radio[name=placket]").click(function() {
		var value = $("input:radio[name=placket]:checked").val();
		if ( value == 'default'){
			$("#placket").text("") ;
			$("#placket").hide();
			hideList();
			hideBlock();
		}
		else {
			right_block.show();
			$("#select-list").show();
			$("#placket").show();
			$("#placket").text("门襟："+value) ;
		}
	});
	
	//button
	$("input:radio[name=button]").click(function() {
		var value = $("input:radio[name=button]:checked").val();
		if ( value == 'default'){
			$("#embroidery").text("") ;
			$("#embroidery").hide();
			hideList();
			hideBlock();
		}
		else {
			right_block.show();
			$("#select-list").show();
			$("#embroidery").show();
			$("#embroidery").text("钮扣："+value + "号") ;
		}
	});
	
	//rivet
	$("input:radio[name=rivet]").click(function() {
		var value = $("input:radio[name=rivet]:checked").val();
		if ( value == 'default'){
			$("#metal").text("") ;
			$("#metal").hide();
			hideList();
			hideBlock();
		}
		else {
			right_block.show();
			$("#select-list").show();
			$("#metal").show();
			$("#metal").text("撞钉："+value + "号") ;
		}
	});
	
	//linecolor
	$("input:radio[name=linecolor]").click(function() {
		var value = $("input:radio[name=linecolor]:checked").val();
		if ( value == 'default'){
			$("#linecolor").text("");
			$("#linecolor").hide();
			hideList();
			hideBlock();
		}
		else {
			right_block.show();
			$("#select-list").show();
			$("#linecolor").show();
			$("#linecolor").text("线色："+value) ;
		} 
	});
}

function getSize() {
	var right_block = $("#list");
	
	//standard-size
	right_block.show();
	$("#size-list").show();
	
	var value = $("select[name=yaowei]").val();
	$("#yaowei").show();
	$("#yaowei").text("腰围：" + value);
	
	var value = $("select[name=kuchang]").val();
	$("#kuchang").show();
	$("#kuchang").text("裤长：" + value);
}









/* custom fit */


function getCustomFit() {
	
	/* get the size */
	if ($("#input-shengao").val() != ''){
		$("#list").show();
		$("#size-list").show();
		$("#shengao").show();
		$("#shengao").text("身高：" + $("#input-shengao").val() + "cm");
	}
	else {
		$("#shengao").hide();
		$("#shengao").text("");
	}
	
	if ($("#input-tizhong").val() != ''){
		$("#list").show();
		$("#size-list").show();
		$("#tizhong").show();
		$("#tizhong").text("体重：" + $("#input-tizhong").val() + "kg");
	}
	else {
		$("#tizhong").hide();
		$("#tizhong").text("");
	}
	
	if ($("#input-yaowei").val() != ''){
		$("#list").show();
		$("#size-list").show();
		$("#yaowei").show();
		$("#yaowei").text("腰围：" + $("#input-yaowei").val() + "cm");
	}
	else {
		$("#yaowei").hide();
		$("#yaowei").text("");
	}
	
	if ($("#input-kuchang").val() != ''){
		$("#list").show();
		$("#size-list").show();
		$("#kuchang").show();
		$("#kuchang").text("裤长：" + $("#input-kuchang").val() + "cm");
	}
	else {
		$("#kuchang").hide();
		$("#kuchang").text("");
	}
	
	if ($("#input-datui").val() != ''){
		$("#list").show();
		$("#size-list").show();
		$("#datui").show();
		$("#datui").text("大腿：" + $("#input-datui").val() + "cm");
	}
	else {
		$("#datui").hide();
		$("#datui").text("");
	}
	
	if ($("#input-jiaowei").val() != ''){
		$("#list").show();
		$("#size-list").show();
		$("#jiaowei").show();
		$("#jiaowei").text("脚围：" + $("#input-jiaowei").val() + "cm");
	}
	else {
		$("#jiaowei").hide();
		$("#jiaowei").text("");
	}
	
	if ($("#input-qiandang").val() != ''){
		$("#list").show();
		$("#size-list").show();
		$("#qiandang").show();
		$("#qiandang").text("前档：" + $("#input-qiandang").val() + "cm");
	}
	else {
		$("#qiandang").hide();
		$("#qiandang").text("");
	}
	
	if ($("#input-tunwei").val() != ''){
		$("#list").show();
		$("#size-list").show();
		$("#tunwei").show();
		$("#tunwei").text("臀围：" + $("#input-tunwei").val() + "cm");
	}
	else {
		$("#tunwei").hide();
		$("#tunwei").text("");
	}
	
	if ($("#input-xigai").val() != ''){
		$("#list").show();
		$("#size-list").show();
		$("#xigai").show();
		$("#xigai").text("膝盖：" + $("#input-xigai").val() + "cm");
	}
	else {
		$("#xigai").hide();
		$("#xigai").text("");
	}
	
	if ($("#input-houdang").val() != ''){
		$("#list").show();
		$("#size-list").show();
		$("#houdang").show();
		$("#houdang").text("后档：" + $("#input-houdang").val() + "cm");
	}
	else {
		$("#houdang").hide();
		$("#houdang").text("");
	}
	
	hideList();
	hideBlock();
}


function submitCustomFitCheck() {
	var wrong = 0;
	var num_reg = /^(([1-9][0-9])|([1-2][0-9]{2}))(\.[0-9]{1,2})?$/;

	
	/* check the input */
	if ($("#input-shengao").val() == '') {
		$("#input-shengao").parent(".input-append").next().addClass("icon-remove icon-red");
		$("#input-shengao").parent(".input-append").next().removeClass("icon-ok icon-green");
		wrong = 1;
	}
	else {
		if( ! num_reg.test($("#input-shengao").val()) ) {
			$("#input-shengao").parent(".input-append").next().addClass("icon-remove icon-red");
			$("#input-shengao").parent(".input-append").next().removeClass("icon-ok icon-green");
			wrong = 1;
		}
	}
	
	if ($("#input-tizhong").val() == '') {
		$("#input-tizhong").parent(".input-append").next().addClass("icon-remove icon-red");
		$("#input-tizhong").parent(".input-append").next().removeClass("icon-ok icon-green");
		wrong = 1;
	}
	else {
		if( ! num_reg.test($("#input-tizhong").val()) ) {
			$("#input-tizhong").parent(".input-append").next().addClass("icon-remove icon-red");
			$("#input-tizhong").parent(".input-append").next().removeClass("icon-ok icon-green");
			wrong = 1;
		}
	}

	if ($("#input-yaowei").val() == '') {
		$("#input-yaowei").parent(".input-append").next().addClass("icon-remove icon-red");
		$("#input-yaowei").parent(".input-append").next().removeClass("icon-ok icon-green");
		wrong = 1;
	}
	else {
		if(! num_reg.test($("#input-yaowei").val())) {
			$("#input-yaowei").parent(".input-append").next().addClass("icon-remove icon-red");
			$("#input-yaowei").parent(".input-append").next().removeClass("icon-ok icon-green");
			wrong = 1;
		}
	}

	if ($("#input-kuchang").val() == '') {
		$("#input-kuchang").parent(".input-append").next().addClass("icon-remove icon-red");
		$("#input-kuchang").parent(".input-append").next().removeClass("icon-ok icon-green");
		wrong = 1;
	}
	else {
		if(! num_reg.test($("#input-kuchang").val())) {
			$("#input-kuchang").parent(".input-append").next().addClass("icon-remove icon-red");
			$("#input-kuchang").parent(".input-append").next().removeClass("icon-ok icon-green");
			wrong = 1;
		}
	}
	
	if ($("#input-datui").val() != ''){
		if(! num_reg.test($("#input-datui").val())) {
			$("#input-datui").parent(".input-append").next().addClass("icon-remove icon-red");
			$("#input-datui").parent(".input-append").next().removeClass("icon-ok icon-green");
			wrong = 1;
		}
	}
	
	if ($("#input-jiaowei").val() != ''){
		if( ! num_reg.test($("#input-jiaowei").val()) ) {
			$("#input-jiaowei").parent(".input-append").next().addClass("icon-remove icon-red");
			$("#input-jiaowei").parent(".input-append").next().removeClass("icon-ok icon-green");
			wrong = 1;
		}
	}
	
	if ($("#input-qiandang").val() != ''){
		if( ! num_reg.test($("#input-qiandang").val()) ) {
			$("#input-qiandang").parent(".input-append").next().addClass("icon-remove icon-red");
			$("#input-qiandang").parent(".input-append").next().removeClass("icon-ok icon-green");
			wrong = 1;
		}
	}
	
	if ($("#input-tunwei").val() != ''){
		if( ! num_reg.test($("#input-tunwei").val()) ) {
			$("#input-tunwei").parent(".input-append").next().addClass("icon-remove icon-red");
			$("#input-tunwei").parent(".input-append").next().removeClass("icon-ok icon-green");
			wrong = 1;
		}
	}
	
	if ($("#input-xigai").val() != ''){
		if( ! num_reg.test($("#input-xigai").val()) ) {
			$("#input-xigai").parent(".input-append").next().addClass("icon-remove icon-red");
			$("#input-xigai").parent(".input-append").next().removeClass("icon-ok icon-green");
			wrong = 1;
		}
	}
	
	if ($("#input-houdang").val() != ''){
		if( ! num_reg.test($("#input-houdang").val()) ) {
			$("#input-houdang").parent(".input-append").next().addClass("icon-remove icon-red");
			$("#input-houdang").parent(".input-append").next().removeClass("icon-ok icon-green");
			wrong = 1;
		}
	}
	
	if (!wrong)
		return true;
	else
		return false;
}


function submitCustomFit() {
	
	var checked = submitCustomFitCheck();
	//submit
	if (checked){
		getCustomFit();
		$('#myModal').modal('hide');
	}
}



function checkCustomFit() {
	
	var wrong = 0;
	var num_reg =/^(([1-9][0-9])|([1-2][0-9]{2}))(\.[0-9]{1,2})?$/;
	
	$("#input-shengao").change(function(){
		if( !num_reg.test($("#input-shengao").val()) ) {
			$("#input-shengao").parent(".input-append").next().addClass("icon-remove icon-red");
			$("#input-shengao").parent(".input-append").next().removeClass("icon-ok icon-green");
			wrong = 1;
		}
		else{
				$("#input-shengao").parent(".input-append").next().removeClass("icon-remove icon-red");
				$("#input-shengao").parent(".input-append").next().addClass("icon-ok icon-green");
		}
	});
	
	$("#input-tizhong").change(function(){
		 
		if( ! num_reg.test($("#input-tizhong").val()) ) {
			$("#input-tizhong").parent(".input-append").next().addClass("icon-remove icon-red");
			$("#input-tizhong").parent(".input-append").next().removeClass("icon-ok icon-green");
			wrong = 1;
		}
		else{
				$("#input-tizhong").parent(".input-append").next().removeClass("icon-remove icon-red");
				$("#input-tizhong").parent(".input-append").next().addClass("icon-ok icon-green");
		}
	});
	
	$("#input-yaowei").change(function(){
		if( ! num_reg.test($("#input-yaowei").val()) ) {
			$("#input-yaowei").parent(".input-append").next().addClass("icon-remove icon-red");
			$("#input-yaowei").parent(".input-append").next().removeClass("icon-ok icon-green");
			wrong = 1;
		}
		else{
				$("#input-yaowei").parent(".input-append").next().removeClass("icon-remove icon-red");
				$("#input-yaowei").parent(".input-append").next().addClass("icon-ok icon-green");
		}
	});
	
	$("#input-kuchang").change(function(){
		if( ! num_reg.test($("#input-kuchang").val()) ) {
			$("#input-kuchang").parent(".input-append").next().addClass("icon-remove icon-red");
			$("#input-kuchang").parent(".input-append").next().removeClass("icon-ok icon-green");
			wrong = 1;
		}
		else{
				$("#input-kuchang").parent(".input-append").next().removeClass("icon-remove icon-red");
				$("#input-kuchang").parent(".input-append").next().addClass("icon-ok icon-green");
		}
	});
	
	$("#input-datui").change(function(){
		if( ! num_reg.test($("#input-datui").val()) ) {
			$("#input-datui").parent(".input-append").next().addClass("icon-remove icon-red");
			$("#input-datui").parent(".input-append").next().removeClass("icon-ok icon-green");
			wrong = 1;
		}
		else{
				$("#input-datui").parent(".input-append").next().removeClass("icon-remove icon-red");
				$("#input-datui").parent(".input-append").next().addClass("icon-ok icon-green");
		}
		
		if ($("#input-datui").val() == '') {
			$("#input-datui").parent(".input-append").next().removeClass("icon-remove icon-red icon-ok icon-green");
		}
	}) ;
	
	$("#input-jiaowei").change(function(){
		if( ! num_reg.test($("#input-jiaowei").val()) ) {
			$("#input-jiaowei").parent(".input-append").next().addClass("icon-remove icon-red");
			$("#input-jiaowei").parent(".input-append").next().removeClass("icon-ok icon-green");
			wrong = 1;
		}
		else{
				$("#input-jiaowei").parent(".input-append").next().removeClass("icon-remove icon-red");
				$("#input-jiaowei").parent(".input-append").next().addClass("icon-ok icon-green");
		}
		
		if ($("#input-jiaowei").val() == '') {
			$("#input-jiaowei").parent(".input-append").next().removeClass("icon-remove icon-red icon-ok icon-green");
		}
	}) ;
	
	$("#input-qiandang").change(function(){
		if( ! num_reg.test($("#input-qiandang").val()) ) {
			$("#input-qiandang").parent(".input-append").next().addClass("icon-remove icon-red");
			$("#input-qiandang").parent(".input-append").next().removeClass("icon-ok icon-green");
			wrong = 1;
		}
		else{
				$("#input-qiandang").parent(".input-append").next().removeClass("icon-remove icon-red");
				$("#input-qiandang").parent(".input-append").next().addClass("icon-ok icon-green");
		}
		
		if ($("#input-qiandang").val() == '') {
			$("#input-qiandang").parent(".input-append").next().removeClass("icon-remove icon-red icon-ok icon-green");
		}
	}) ;
	
	$("#input-tunwei").change(function(){
		if( ! num_reg.test($("#input-tunwei").val()) ) {
			$("#input-tunwei").parent(".input-append").next().addClass("icon-remove icon-red");
			$("#input-tunwei").parent(".input-append").next().removeClass("icon-ok icon-green");
			wrong = 1;
		}
		else{
				$("#input-tunwei").parent(".input-append").next().removeClass("icon-remove icon-red");
				$("#input-tunwei").parent(".input-append").next().addClass("icon-ok icon-green");
		}
		
		if ($("#input-tunwei").val() == '') {
			$("#input-tunwei").parent(".input-append").next().removeClass("icon-remove icon-red icon-ok icon-green");
		}
	}) ;
	
	$("#input-xigai").change(function(){
		if( ! num_reg.test($("#input-xigai").val()) ) {
			$("#input-xigai").parent(".input-append").next().addClass("icon-remove icon-red");
			$("#input-xigai").parent(".input-append").next().removeClass("icon-ok icon-green");
			wrong = 1;
		}
		else{
				$("#input-xigai").parent(".input-append").next().removeClass("icon-remove icon-red");
				$("#input-xigai").parent(".input-append").next().addClass("icon-ok icon-green");
		}
		
		if ($("#input-xigai").val() == '') {
			$("#input-xigai").parent(".input-append").next().removeClass("icon-remove icon-red icon-ok icon-green");
		}
	}) ;
	
	$("#input-houdang").change(function(){
		if( ! num_reg.test($("#input-houdang").val()) ) {
			$("#input-houdang").parent(".input-append").next().addClass("icon-remove icon-red");
			$("#input-houdang").parent(".input-append").next().removeClass("icon-ok icon-green");
			wrong = 1;
		}
		else{
				$("#input-houdang").parent(".input-append").next().removeClass("icon-remove icon-red");
				$("#input-houdang").parent(".input-append").next().addClass("icon-ok icon-green");
		}
		
		if ($("#input-houdang").val() == '') {
			$("#input-houdang").parent(".input-append").next().removeClass("icon-remove icon-red icon-ok icon-green");
		}
	}) ;
	
	if (!wrong)
		return true;
	else
		return false;
}


function buy_check() {
	$("#buy-button").popover({placement: 'bottom', trigger: 'manual'});

	$("#buy-button").mouseover(function(){
		if ($("#size-list").css("display") == 'none' )
		$("#buy-button").popover("show");
	});
	$("#buy-button").mouseout(function(){
		$("#buy-button").popover("hide");
	});
}


function radio_checked_style() {
	$("input:radio").click(function(){
		$(".select-block button").removeClass("active");
		$('input:radio:checked').next().addClass("active");
	});
}
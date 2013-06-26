    <div id="main">
    	<div id="nav">
        	<h3>添加商品</h3>
            <a class="other_link" href="<?php echo site_url('admin/item');?>">商品列表</a>
        </div>
        <div id="content">
        	<form id="item_form" name="item_form" method="post">
                
                <span>类型
                    <select onchange="selvedgeShow()" name="item_type">
                        <option value="0" selected="selected">请选择</option>
                        <option value="1">洗水牛仔</option>
                        <option value="2">赤耳单宁</option>
                        <option value="3">休闲裤</option>
                    </select>
                </span>
                <span>名称<input type="text" name="item_name" /></span>
                <span>价格<input type="text" name="item_price" /></span>
                <span class="item_provenance">产地<input id="item_provenance" type="text" name="item_provenance" /></span>
                <span class="item_weight">重量<input id="item_weight" type="text" name="item_weight" /></span>
                <input id="item_material_image" type="hidden" name="item_material_image" />
                <input id="item_photo" type="hidden" name="item_photo" />
                <input id="item_small_photo" type="hidden" name="item_small_photo" />
                
                <p><span>简介</span></p>
                <p><textarea name="item_intro"></textarea></p>
                <input type="submit" class="submit_button" name="submit" value="添加" />
                
            </form>
            
            <form enctype="multipart/form-data" name="material_form" id="material_form" method="post">
            	<span>布料图片：</span><input onchange="upload_material_image()" id="material_image" type="file" name="material_image" /><span class='success_hint'>上传成功</span>
            </form>
            
            <div id="image_area">
            	<p><span>商品图片：(可同时选择多张)</span></p>
               	<input id="uploadify" name="item_image">
                <div id="item_queue"></div>
            </div>
        </div>
    </div>
    <script charset="utf-8" src="<?php echo base_url('js/uploadify/jquery.uploadify.js'); ?>"></script>
	<script charset="utf-8" src="<?php echo base_url('js/uploadify/jquery.uploadify.min.js'); ?>"></script>
    <script charset="utf-8" src="<?php echo base_url('js/jquery.form.js'); ?>"></script>
    
    <script type="text/javascript">
		var image_amount = 1;
		var form_id = null;
		var image_id = null;
		var images_str = null;
		var small_images_str = null;
		
		$(document).ready(function() {
        	$("#uploadify").uploadify({
				'uploader': '<?php echo site_url(); ?>/admin/item/upload_image',
				'swf': '<?php echo base_url(); ?>js/uploadify/uploadify.swf',
				'multi': true,
				'buttonImage': '<?php echo base_url(); ?>js/uploadify/button.png',
				'width': 100,
				'height': 35,
				'fileTypeExts': '*.gif; *.jpg; *.png; *.jpeg; *.bmp',
				'fileObjName': 'item_image',
				'removeCompleted': false,
				'queueID': "item_queue",
				'fileSizeLimit': '2048KB',
				'onUploadSuccess': function(file, data, response) {
					//alert("The file " + JSON.stringify(file) + "was successfully upload with a response of " + response + ": " + data);
					data = eval('(' + data + ')');
					if(data.code == 0) {
						$("#" + file.id).append("<span class='return_name'>" + data.data + "</span>");
					}
					else {
						alert(file.name + "上传图片失败！");
					}
				}
			});
        });
		
		$("#item_form").submit(function() {
			var tpye_index = document.getElementsByName('item_type').item(0).options.selectedIndex;
			var image_prefix = null;
			var image_suffix = null;
			var dot_pos = null;
			var images_str = null;
			var small_images_str = null;
			var images_arr = new Array();
			var small_images_arr = new Array();
			if(tpye_index == 0) {
				alert("请选择类型！");
				return false;
			}
			
			if(item_form.item_name.value=="") {
					alert("请填入名称！");
					return false;
			}
			
			if(item_form.item_price.value=="") {
					alert("请填入价格！");
					return false;
			}
			
			if(!(/^[0-9]*[1-9][0-9]*$/.test(item_form.item_price.value))) {
				alert("价格需为正整数！");
				return false;
			}
			
			if(tpye_index == 2) {
				if(item_form.item_provenance.value=="") {
					alert("请填入产地！");
					return false;
				}
				
				if(item_form.item_weight.value=="") {
					alert("请填入重量！");
					return false;
				}
				
				if(isNaN(item_form.item_weight.value)) {
					alert("重量须为数字！");
					return false;
				}
				
				if(material_form.material_image.value=="") {
					alert("请选择布料图片！");
					return false;
				}
			}
			$(".uploadify-queue-item .return_name").each(function(index, element) {
				
                images_arr.push($(this).text());
				dot_pos = $(this).text().lastIndexOf('.');
				image_prefix = $(this).text().substr(0, dot_pos);
				image_suffix = $(this).text().substr(dot_pos, $(this).text().length - dot_pos);
				small_images_arr.push(image_prefix + "_thumb" + image_suffix);
            });
			images_str = images_arr.join('|');
			small_images_str = small_images_arr.join('|');
			if(images_str == null || images_str == '') {
				alert("请选择商品图片");
				return false;
			}
			
			$("#item_photo").val(images_str);
			$("#item_small_photo").val(small_images_str);
			$.ajax({
					url : admin_url + "item/add_item",
					data : $("#item_form").serialize(),
					type: "post",
					dataType : "json",
					success : function(data, status) {
						if(data.code == 0) {
							window.location.href = admin_url + "item";
						}
						else {
						}
					},
					error : function() {
						
					}
				});
			return false;
		});
		
		function selvedgeShow() {
			var tpye_index = document.getElementsByName('item_type').item(0).options.selectedIndex;
			if(tpye_index == 2) {
				$("#item_form .item_provenance").css({"display":"inline"});
				$("#item_form .item_weight").css({"display":"inline"});
				$("#material_form").css({"display":"inline"});
			}
			else {
				$("#item_form .item_provenance").css({"display":"none"});
				$("#item_form .item_weight").css({"display":"none"});
				$("#material_form").css({"display":"none"});
			}
		}
		
		function upload_material_image() {
			if($("#material_image").val() != "") {
				$("#material_form").ajaxSubmit({
					dataType: "json",
					url: admin_url + "item/upload_material_image",
					type: "post",
					success: function(data) {
						if(data.code == 0) {
							$("#item_material_image").val(data.data);
							document.getElementById("material_form").getElementsByClassName('success_hint').item(0).style.display = 'inline';
						}
						else if(data.code == 666) {
							document.getElementById("material_form").getElementsByClassName('success_hint').item(0).style.display = 'none';
							alert("上传布料图片失败");
							return false;
						}
						else {
							return false;
						}
						return true;
					}
				});
			}
			else {
				document.getElementById("material_form").getElementsByClassName('success_hint').item(0).style.display = 'none';
			}
		}
    </script>
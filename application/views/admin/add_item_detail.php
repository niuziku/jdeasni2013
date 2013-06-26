	<div id="main">
    	<div id="nav">
        	<h3>添加商品细节</h3>
            <a class="other_link" href="<?php echo site_url('admin/item_detail');?>">商品细节列表</a>
        </div>
        
        <div id="content">
            
        	<form enctype="multipart/form-data" id="item_detail_form" name="item_detail_form" method="post">
            	<span>商品类型：
                	<select onchange="setDetailType()" name="item_type">
                    	<option value="0" selected="selected">请选择</option>
                    	<option value="1">洗水牛仔</option>
                        <option value="2">赤耳单宁</option>
                        <option value="3">休闲裤</option>
                    </select>
                </span>
                <span >细节类型：
                	<select name="detail_type">
                    	<option value="0" selected="selected">请选择</option>
                    </select>
                </span>
                <div class="detail_image">细节图片（必选）：<input id="detail_image" class="image_button" type="file" name="detail_image" /></div>
                <span class="detail_name">细节名称：<input type="text" name="detail_name" /></span>
                <span class="detail_attach_price">额外价格：<input type="text" name="detail_attach_price" />&nbsp;元（若无，则填0）</span>
                <div class="detail_description">细节说明：<textarea name="detail_description"></textarea></div>
                <input type="hidden" name="detail_incart_image" id="detail_incart_image" />
                <input type="submit" class="submit_button" name="submit" value="添加" />
            </form>
            
            <form enctype="multipart/form-data" id="incart_image_form" class="incart_image_form" name="incart_image_form" method="post">
                <span class='upload_area'>购物车图片（可选，需单独上传）：<input onchange="upload_incart_image()" id="incart_image" type="file" name="incart_image" /></span>
            </form>
        </div>
    </div>
    <script charset="utf-8" src="<?php echo base_url('js/jquery.form.js'); ?>"></script>
    <script type="text/javascript">
		$("#item_detail_form").ajaxForm({
			dataType: "json",
			url: admin_url + "item_detail/add_item_detail",
			type: "post",
			beforeSubmit: checkPost,
			success: successReturn,
			error:function() {
				
			}
		});
		
		function upload_incart_image() {
			if($("#incart_image").val() != '') {
				$("#incart_image_form").ajaxSubmit({
					dataType: "json",
					forceSync: true,
					url: admin_url + "item_detail/upload_incart_image",
					type: "post",
					beforeSubmit: checkIncartImage,
					success: setIncartImage,
					error:function() {
						
					}
				});
			}
			else {
				$("#detail_incart_image").val(null);
			}
		}
		
		function checkIncartImage() {			
			if(incart_image_form.incart_image.value=="") {
				alert("请选择购物车缩略图！");
				return false;
			}
			return true;
		}
		
		function setIncartImage(data) {
			if(data.code == 0) {
				$("#detail_incart_image").val(data.data);
			}
			else if(data.code == 666) {
			}
			else {
			}
		}
		
		function checkPost() {
			
			var item_index = document.getElementsByName('item_type').item(0).options.selectedIndex;
			if(item_index == 0) {
				alert("请选择商品类型！");
				return false;
			}
			
			var detail_index = document.getElementsByName('detail_type').item(0).options.selectedIndex;
			if(detail_index == 0) {
				alert("请选择细节类型！");
				return false;
			}
			
			if(item_detail_form.detail_name.value=="") {
				alert("请填入细节名称！");
				return false;
			}
			
			if(item_detail_form.detail_attach_price.value=="") {
				alert("请填入额外价格！");
				return false;
			}
			
			if(item_detail_form.detail_description.value=="") {
				alert("请填入细节描述！");
				return false;
			}
			
			if(item_detail_form.detail_image.value=="") {
				alert("请选择图片！");
				return false;
			}
			
			return true;
		}
		
		function successReturn(data) {
			if(data.code == 0) {
				window.location.href = admin_url + "item_detail";
			}
			else if(data.code == 666) {
			}
			else {
			}
		}
		
		function setDetailType() {
			var item_index = document.getElementsByName('item_type').item(0).options.selectedIndex;
			var detail_obj = document.getElementsByName('detail_type').item(0);
			detail_obj.options.length = 1;
			switch(item_index) {
				case 0 : break;
				case 1 : detail_obj.options.add(new Option("厚度", "1"));
						 detail_obj.options.add(new Option("颜色", "2"));
						 detail_obj.options.add(new Option("板型", "3"));
						 detail_obj.options.add(new Option("门襟", "4"));
						 detail_obj.options.add(new Option("纽扣", "5"));
						 detail_obj.options.add(new Option("撞钉", "6"));
						 detail_obj.options.add(new Option("线色", "7"));
						 detail_obj.options.add(new Option("后袋", "9"));
						 break;
				case 2 : detail_obj.options.add(new Option("门襟", "4"));
						 detail_obj.options.add(new Option("纽扣", "5"));
						 detail_obj.options.add(new Option("撞钉", "6"));
						 detail_obj.options.add(new Option("线色", "7")); 
						 detail_obj.options.add(new Option("裤型", "8"));
						 detail_obj.options.add(new Option("后袋", "9"));
						 break;
				case 3 : detail_obj.options.add(new Option("厚度", "1"));
						 detail_obj.options.add(new Option("颜色", "2"));
						 detail_obj.options.add(new Option("板型", "3"));
						 detail_obj.options.add(new Option("门襟", "4"));
						 detail_obj.options.add(new Option("纽扣", "5"));
						 detail_obj.options.add(new Option("撞钉", "6"));
						 detail_obj.options.add(new Option("线色", "7"));
						 break;
				default : break;
			}
		}
		
	</script>
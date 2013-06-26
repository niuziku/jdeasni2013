
	<div id="main">
    	<div id="nav">
        	<h3>添加新闻</h3>
            <a class="other_link" href="<?php echo site_url('admin/news');?>">新闻列表</a>
        </div>
        <div id="content">
        	<form id="news_form" name="news_form" method="post">
            	<p><span>标题</span><input type="text" name="news_title" /></p>
                <span>内容</span><textarea class="news_content" id="news_content" name="news_content" style="margin:5px 0;width:953px;height:300px;visibility:hidden;"></textarea>
                <span>类型</span>
                <select name="news_type">
                	<option value="1" selected="selected">I.D企划预告</option>
                    <option value="2">I.D新品展示</option>
                    <option value="3">实用教程</option>
                </select>
                <input class="submit_button" type="submit" name="submit" value="提交" />
            </form>
        </div>
    </div>
	
    <script charset="utf-8" src="<?php echo base_url('kindeditor/kindeditor-min.js'); ?>"></script>
	<script charset="utf-8" src="<?php echo base_url('kindeditor/lang/zh_CN.js'); ?>"></script>
	<script type="text/javascript">
        KindEditor.ready(function(K) {
            K.create('#news_content', {
				resizeType : 1,
                filterMode : false,uploadJson : '../../../kindeditor/php/upload_json.php',
				fileManagerJson : '../../../kindeditor/php/file_manager_json.php',
				allowFileManager : true,
                items : [
                    'source','bold','italic','underline','fontsize','forecolor','link','image','media'
                ],
				afterBlur: function(){this.sync();}
            });
        });
		
		$("#news_form").submit(function() {
			
			if(news_form.news_title.value=="") {
				alert("标题不能为空！");
				document.news_form.elements[0].focus();
				return false;
			}
			$.ajax({
				url : admin_url + "news/add_news",
				data : $("#news_form").serialize(),
				type: "post",
				dataType : "json",
				success : function(data, status) {
					if(data.code == 0) {
						window.location.href = admin_url + "news";
					}
					else {
						document.news_form.elements[0].focus();
						return false;
					}
				},
				error : function() {
					
				}
			});
			return false;
		});
    </script>
    
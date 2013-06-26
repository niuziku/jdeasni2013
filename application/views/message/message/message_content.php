 
    <div class="container row-fluid">
    
    	<div id="website-nav">
        	<ul class="inline">
               <li><a href="../index.php"><i class="icon-home"></i></a></li>
               <li>&gt;</li>
               <li><p class="text">个人服务</p></li>
            </ul>
        </div>
      
        
        <div class="message-block">
        	<form class="form-horizontal" id="message_form"> 
                <legend>有特殊的定制需求?</legend>
                <div class="control-group">
                	<label class="control-label" for="input_name">你的名字</label>
               		<div class="controls">
                    <input type="text" placeholder="怎么称呼你呢？" id="input_name" name="name"/>
                    </div>
                </div>
                
                <div class="control-group">
                	<label class="control-label" for="input_email">邮箱</label>
                	<div class="controls">
                    <input type="text" placeholder="邮箱/电话可以选填一个" id="input_email" name="email"/>
                    <span class=""></span><span class="tips"></span>
                    </div>
                </div>
                
                <div class="control-group">
                	<label class="control-label" for="input_phone">手机</label>
                	<div class="controls">
                    <input type="text" placeholder="邮箱/电话可以选填一个" id="input_phone" name="phone"/>
                    <span class=""></span><span class="tips"></span>
                    </div>
                </div>
                
                <div class="control-group">
                	<label class="control-label" for="input_phone">留言内容</label>
                	<div class="controls" style="position:relative;">
                    <textarea placeholder="关于网站, 定制等等..." name="content" id="input_content"></textarea>
                    <span id="content-tips"><span class="icon-remove icon-red" style="position:relative; top:-1px;right:3px;"></span>超过限制<span id="word_number"></span>字</span>
                        <span id="content-tips2"><span class="icon-remove icon-red" style="position:relative; top:-1px;right:3px;"></span>请填写留言内容</span>
                    </div>
                </div>
                
                <a id="add-picture" href="javascript:void(0)"><i class="icon-picture"></i>添加图片</a>
                
                
                <input type="hidden" name="photo" class="photo"/>
                
                <button type="submit" class="btn btn-primary btn-large" style="float:right;" form="message_form" onClick=" return submitMessage()">留言</button>
                
                <div id="public-group" style="float:right;">
                	<ul class="inline">
                        <li>
                        <label class="radio">
                          	<input type="radio" name="isPublic" id="public" value="1" checked="checked"/>
                          	<p>公开留言</p>
                        </label>
                        </li>
                        
                        <li>
                        <label class="radio">
                          	<input type="radio" name="isPublic" id="private" value="0"/>
                          	<p>私人留言</p>
                        </label>
                        </li>
                    </ul>
                </div>
            </form>
            
            <!-- CG -->
            <form class="desc-picture" method="post" enctype="multipart/form-data" action="<?php echo site_url('comment/upload_image');?>" style="display:none;">
				<input class="image-upload" name="c_image" type="file" accept="image/*"/>
			</form>
            
            <div id="leave-message">
            	<legend>最新留言</legend>
                
            </div><!-- leave message -->
            
            <div class="pagination page-change">
            <ul>
            <!-- 
                <li class="disabled"><a href="#">&laquo;</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&raquo;</a></li>
                 -->
            </ul>
        	</div>
            
        </div>
        
        <!--<div id="message-right">
            	<p>有想不完的定制想法?</p>
                <p>把你的想法发给我们(可提供图片)</p>
                <p><i class="icon-envelope"></i>&nbsp;hello@idjeans.cn</p>
                <p>或者 <a href="#">联系客服</a></p>
                <p>我们将第一时间为你处理</p>
        </div>-->
            
    </div><!-- div container -->

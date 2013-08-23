    <div class="container row-fluid">
    
    	<div id="website-nav">
        	<ul class="inline">
               <li><a href="../index.php"><i class="icon-home"></i></a></li>
               <li>&gt;</li>
               <li><p class="text">我的账户</p></li>
               <li>&gt;</li>
               <li><p class="text">修改密码</p></li>
            </ul>
        </div>
		<h3>修改您的密码</h3>
        
        <div class="row-fluid">
        
            <div id="left-block" class="span3">
            	<ul id="account-list">
                	<h4>我的账户</h4>
                	<li><a href="<?php echo site_url('order');?>">订单</a></li>
                    <li><a href="#">修改密码</a></li>
                    <li><a href="<?php echo site_url('size');?>">尺码库</a></li>
                    <li><a href="<?php echo site_url('address');?>">地址库</a></li>
                </ul>
            </div><!-- left block -->
            
            <div id="right-block" class="span9">
            	<form class="form-horizontal">
                   <div class="control-group">
                       <label class="control-label" for="inputOldPassword">旧密码</label>
                       <div class="controls">
                          <input type="text" name="password_original" id="inputOldPassword" placeholder="旧密码">
                       </div>
                   </div>
                   <div class="control-group">
                       <label class="control-label" for="inputNewPassword">新密码</label>
                       <div class="controls">
                          <input type="text" name="password_new" id="inputNewPassword" placeholder="新密码">
                       </div>
                   </div>
                   <div class="control-group">
                       <label class="control-label" for="confirmNewPassword">确认新密码</label>
                       <div class="controls">
                          <input type="text" name="password_conf" id="confirmNewPassword" placeholder="确认新密码">
                       </div>
                   </div>
                   
                  
                </form>
                <div class="control-group" style="position:relative; left:180px;">
                     <div class="controls">
                        <button type="submit" class="btn" id="change-psd-btn">确认修改</button>
                     </div>
                </div>
            </div><!-- right block -->
        
        </div><!--content-->
    </div><!-- container -->
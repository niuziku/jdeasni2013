	<div class="container row-fluid">
    
    	<div id="website-nav">
        	<ul class="inline">
               <li><a href="../index.php"><i class="icon-home"></i></a></li>
               <li>&gt;</li>
               <li><p class="text">我的账户</p></li>
               <li>&gt;</li>
               <li><p class="text">尺码库</p></li>
            </ul>
        </div>
        
        <div class="row-fluid">
        
            <div id="left-block" class="span3">
            	<ul id="account-list">
                	<h4>我的账户</h4>
                	<li><a href="<?php echo site_url('order');?>">订单</a></li>
                    <li><a href="<?php echo site_url('customer/password');?>">修改密码</a></li>
                    <li><a href="#">尺码库</a></li>
                    <li><a href="<?php echo site_url('address');?>">地址库</a></li>
                </ul>
            </div><!-- left block -->
            
            <div id="right-block" class="span9">
            	<h3>尺码库</h3>
                    <table class="table table-striped">
                        <tr>
                            <th class="size_detail">尺码</th>
                            <th>操作</th>
                            <th class="address_default">默认</th>
                        </tr>
                    </table>
            </div><!-- right block -->
        
        </div><!--content-->
    </div><!-- container -->
	 
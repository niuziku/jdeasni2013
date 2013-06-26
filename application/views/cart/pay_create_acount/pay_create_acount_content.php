<div class="container row-fluid">
    	
        <div id="website-nav">
        	<ul class="inline">
               <li><a href="../index.php"><i class="icon-home"></i></a></li>
               <li>&gt;</li>
               <li><p class="text">付款完毕</p></li>
            </ul>
        </div>
        
		<h3>感谢您的定制</h3>
        
        <div class="pay">
        	<p style="font-size:18px; margin-left:20px; margin-top:20px;"><i class="icon-ok icon-green"></i>我们稍后将会收到你的付款，并有专人向你确认订单</p>
            
            <div class="list_block">
            	<p style="font-size:18px;"><i class="icon-user"></i>我们还为你创建了个人账户</p>
                <ul>
                    <li class="username"><?php echo $email;?></li>
                    <li>密码为你填写的手机号码</li>
                </ul>
                <p style="margin-left:8px; color:#777;">使用个人账户可以方便地管理你的订单、地址和尺码信息</p>
            </div>
            
            <div class="list_block">
                <h4>现在您可以：</h4>
                <ul> 
                    <li>到<a href="<?php echo site_url('order');?>">我的账户</a>里查看订单的最新情况</li>
                    <li><a href="<?php echo site_url('item/washed_item_list');?>">继续定制</a></li>
                    <li><a href="<?php echo site_url('');?>">返回首页</a></li>
                </ul>
            </div>
        </div>

		
        
    </div><!-- container -->
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
        
        <div class="row-fluid">
        
            <div id="left-block" class="span3">
            	<ul id="account-list">
                	<h4>我的账户</h4>
                	<li><a href="#">订单</a></li>
                    <li><a href="<?php echo site_url('customer/password');?>">修改密码</a></li>
                    <li><a href="<?php echo site_url('size');?>">尺码库</a></li>
                    <li><a href="<?php echo site_url('address');?>">地址库</a></li>
                </ul>
            </div><!-- left block -->
            
            <div id="right-block" class="span9">
            	<img src="<?php echo base_url('images/others/order_process.png')?>" style="position:absolute; right:10px;" />
            	<legend>我的定制订单</legend>
            	
            </div><!-- right block -->
            <div id="payModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		        <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		            <h3 id="myModalLabel">选择付款方式</h3>
		        </div>
		        <div class="modal-body">
		            <form>
		            	<ul class="inline">
		                    <li>
		                        <label>
		                            <input type="radio" checked="checked" name="payment" value="0"/><img src="<?php echo base_url('images/others/alipay.png');?>" alt="支付宝" style="margin-left:20px;"/>
		                        </label>
		                    </li>
		                    <li>
		                        <label>
		                            <input type="radio" name="payment" value="1"/><img src="<?php echo base_url('images/others/paypal.gif');?>" alt="paypal" style="margin-left:20px;"/>
		                        </label>
		                    </li>
		                </ul>
		            </form>  
		        </div>
		        <div class="modal-footer">
		            <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
		            <button class="btn btn-success topay">去付款</button>
		        </div>
		    </div>
        	<div id="alipay-jump"></div>
        </div><!--content-->
    </div><!-- container -->
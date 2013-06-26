<div class="container row-fluid">
    	
        <div id="website-nav">
        	<ul class="inline">
               <li><a href="../index.php"><i class="icon-home"></i></a></li>
               <li>&gt;</li>
               <li><a href="cart.php" class="text">购物车</a></li>
               <li>&gt;</li>
               <li><p class="text">订单详情</p></li>
            </ul>
        </div>
        
		<h3>请填写你的订单详情</h3>
        
        <div id="address-block">
        	<legend>收货地址</legend>
            
            <form class="select-address">
                <button class="btn" type="button" onClick="new_address()" id="add_new_address" style="margin-top:10px;">使用新地址</button>
            </form>
            
        	<form class="form-horizontal" id="address_input_form" style="display:none;"> 
                
                <div class="control-group">
                	<label class="control-label" for="input_name">收货人姓名</label>
               		<div class="controls">
                    <input type="text" id="input_name" placeholder="" />
                    <span class=""></span><span class="tips"></span>
                    </div>
                </div>
                
                <div class="control-group">
                	<label class="control-label" for="input_phone">联系电话</label>
               		<div class="controls">
                    <input type="text" placeholder="" id="input_phone" />
                    <span class=""></span><span class="tips"></span>
                    </div>
                </div>

                <div class="control-group">
                	<label class="control-label" for="input_province">省份</label>
               		<div class="controls">
                    <input type="text" placeholder="" id="input_province" />
                    <span class=""></span><span class="tips"></span>
                    </div>
                </div>
                
                <div class="control-group">
                	<label class="control-label" for="input_city">城市</label>
               		<div class="controls">
                    <input type="text" placeholder="" id="input_city" />
                    <span class=""></span><span class="tips"></span>
                    </div>
                </div>
                
                <div class="control-group">
                	<label class="control-label" for="input_address">地址</label>
               		<div class="controls">
                    <textarea rows="3" placeholder="你的详细街道地址..." id="input_address"></textarea>
                    <span class=""></span><span class="tips"></span>
                    </div>
                </div>
                
                <div class="control-group">
               		<div class="controls">
                    	<button type="button" class="btn" onClick="cancel_new_address(),delReceiverMsg()">取消</button> 
                        <button type="button" class="btn btn-primary" onClick="if(add_new_address() != false){add_receiver();addReceiverMsg();}">确认保存</button>                   
                    </div>
                </div>
                
         	</form>
            <!--<p>运费: RMB 0</p>-->
        </div>
        
        <div id="pay-block">
        	<legend>支付方式</legend>
            <p class="description">第三方支付，安全有保障</p>
        	<form>
            	<ul class="inline">
                    <li>
                        <label>
                            <input type="radio" checked="checked" name="payment" value="0"/><img src="<?php echo base_url('images/others/alipay.png');?>" alt="支付宝"/>
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="radio" name="payment" value="1"/><img src="<?php echo base_url('images/others/paypal.gif');?>" alt="paypal" />
                        </label>
                    </li>
                </ul>
            </form>
            
            <!--<div id="discut">
                <label class="control-label" for="discount">有优惠号码?</label>
                <input type="text" id="discount" />
                <button type="button" class="btn">马上优惠</button>
                
                <p  class="price-large"><span>优惠: -RMB</span>20</p>
            </div>-->
        </div>

		<div id="order-block">
            <legend>商品清单</legend>
              
                <div id="discut">
                
                <ul class="inline">
                    <li>
                        <label>
                            留言：
                            <input type="text" placeholder="选填，可以告诉我们对裤子的特殊要求~" style="width:320px; margin-right:100px;"/>
                        </label>
                    </li>
                    
                    <li>
                        <label>
                            优惠码：
                            <input type="text" id="discount" name="discount" placeholder="输入优惠码" style="width:150px;"/>
                            <button type="button" class="btn" id="discount-btn">马上优惠</button>
                        </label>
                    </li>
                    
                    <li>
                    	<p  class="price-large total-price"><span>优惠: RMB</span>-0</p>
                    </li>
                </ul>
                
            </div>
        </div>

        <div id="submit-block">
            <p class="price-verylarge"><span>实付款: RMB</span>330</p>
            <ul>
                <li>地址：<span id="province"></span>，<span id="city"></span>，<span id="address"></span></li>
                <li>收件人：<span id="name"></span></li>
                <li>联系电话：<span id="phone"></span></li>
            </ul>
            
            <ul>
                <li>
                <!--<img id="pay-method" src="../images/paypal.gif" alt="paypal" />-->
                <img id="pay-method" src="<?php echo base_url('images/others/alipay.png');?>" alt="支付宝" />
                <button type="submit" class="btn btn-large btn-success" onclick="submit_address()">去付款</button>
                </li>
            </ul>
        </div><!-- submit -->
        
        <a href="<?php echo site_url('cart');?>" style="position:absolute; bottom:0; left:10px;">返回购物车</a>
        <div id="alipay-jump"></div>
    </div><!-- container -->
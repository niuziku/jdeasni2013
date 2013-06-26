   <div class="container row-fluid">
    
    	<div id="website-nav">
        	<ul class="inline">
               <li><a href="../index.php"><i class="icon-home"></i></a></li>
               <li>&gt;</li>
               <li><p class="text">购物车</p></li>
            </ul>
        </div>
		<h3 class="item-title">你的购物车里的商品</h3>
        
        
        
        <div class="cart-operation">
            <a href="<?php echo site_url('item/washed_item_list');?>"><button type="button" class="btn btn-large" id="continue-shopping">继续购物</button></a>

            <p class="price-large" id="total-price"><span>合计: RMB</span></p>
            <a href="customer/address"><button type="button" class="btn btn-large btn-success" id="buynow">立即购买</button></a>
    	</div><!-- container -->
    </div>

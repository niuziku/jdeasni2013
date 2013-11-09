<div class="header">	
        <div class="header-nav">
            <div class="container">
            	<a href="../index.php" style="float:left;"><img src="<?php echo base_url('images/logo.png');?>"/></a>
                <ul class="inline left">
                  
                    <li style="padding-left:30px;"><a href="<?php echo base_url('index.php')?>">首页</a></li>  
                    <li>
                    <div class="dropdown" id="custom">
                        <a href="javascript:void(0)">
                        <span>定制&nbsp;</span><i class="icon-chevron-down icon-white"></i>
                        </a>
                        <ul class="dropdown-menu" id="custom-menu">
                        	<li><a href="<?php echo site_url('item/washed_item_list');?>">洗水牛仔</a></li>
                            <li><a href="<?php echo site_url('item/advanced_washed_item_list');?>">高端洗水</a></li>
                            <li><a href="<?php echo site_url('item/selvedge_item_list');?>">赤耳单宁</a></li>
                            <li><a href="<?php echo site_url('item/casual_item_list');?>">休闲裤</a></li>
                        </ul>
                    </div>
                    </li>
                    <li><a href="<?php echo site_url('comment')?>">个人服务</a></li> 
                    <li><a href="<?php echo site_url('news');?>">资讯</a></li> 
                    <li><a href="<?php echo site_url('about')?>">关于</a></li>  
                    
                    <li><a href="<?php echo site_url('quality')?>">品质保证</a></li>
                    
                    <li>
                    <div class="dropdown" id="custom">
                        <a href="javascript:void(0)">
                        <span>定制指南</span><i class="icon-chevron-down icon-white"></i>
                        </a>
                        <ul class="dropdown-menu" id="custom-menu">
                        	<li><a href="<?php echo site_url('faq');?>">常见问题</a></li>
                            <li><a href="<?php echo site_url('guide');?>">定制流程</a></li>
                            <li><a href="<?php echo site_url('deliver');?>">配送方式</a></li>
                            <li><a href="<?php echo site_url('shortrun');?>">Short Run Production</a></li>
                        </ul>
                    </div>  
                    </li>     
                </ul>
                
                 <ul class="inline right">
                    <li>
                    <div class="dropdown">
                        <a class="dropdown-toggle" id="currency" role="button" data-toggle="dropdown" data-target="#" href="#">
                        <strong>&yen; RMB</strong>
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="currency">
                        	<li><a href="#">&euro; EUR</a></li>
                    		<li><a href="#">&pound; GBP</a></li>
                            <li><a href="#">$ USD</a></li>
                        </ul>
                    </div>
                    </li>
                    
                    <li>
                    	<div class="dropdown">
                        <a class="dropdown-toggle" id="language" role="button" data-toggle="dropdown" data-target="#" href="#">
                        <img src="<?php echo base_url('images/others/nation/001.png');?>"/>
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="language">
                        	<li><a href="#"><img src="<?php echo base_url('images/others//nation/081.png');?>"/></a></li>
                    		<li><a href="#"><img src="<?php echo base_url('images/others/nation/219.png');?>"/></a></li>
                        </ul>
                    </div>
                    </li>
                   
                    <li><a href="http://www.taobao.com/webww/ww.php?ver=3&touid=josen2257&siteid=cntaobao&status=1&charset=utf-8" class="wangwang"><img src="<?php echo base_url('images/others/wangwang2.png');?>"/></a></li>
                </ul>      
            </div>
		</div>
        
        <div class="header-website-nav">
            <div class="container">

                <ul class="inline right">
                    <li><a href="<?php echo site_url('cart');?>">购物车</a></li>
                    <li><a href="javascript:void(0)" id="my-account">我的账户</a></li>
                </ul> 
            </div>
        </div>
        
    </div><!-- header -->
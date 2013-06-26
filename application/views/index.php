<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<!-- Bootstrap -->
	<link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet" media="screen" /> 
    <link href="<?php echo base_url('css/idjeans.css');?>" rel="stylesheet" media="screen" />
    <!--css only for index page -->
	<link href="<?php echo base_url('css/home.css');?>" rel="stylesheet" media="screen" />
    
    <!-- slider -->
    <link href="<?php echo base_url('css/flexslider.css');?>" rel="stylesheet" />
    
    <!-- JQuery -->
    <script src="<?php echo base_url('js/jquery-1.9.1.min.js');?>"></script>
	<!-- Bootstrap -->
	<script src="<?php echo base_url('js/bootstrap.js');?>"></script>
    
    <!-- slider -->
    <script src="<?php echo base_url('js/jquery.flexslider.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('js/global.js');?>"></script>
	<title>Home - idjeans</title>
</head>

<body>	
    <div class="header">	
        <div class="header-nav">
            <div class="container">
            	<a href="index.php" style="float:left;"><img src="<?php echo base_url('images/logo.png');?>"/></a>
                <ul class="inline left">
                    <li style="padding-left:30px;"><a href="#">首页</a></li>  

                    <li>
                    <div class="dropdown" id="custom">
                        <a href="javascript:void(0)">
                        <span>定制&nbsp;</span><i class="icon-chevron-down icon-white"></i>
                        </a>
                        <ul class="dropdown-menu" id="custom-menu">
                        	<li><a href="<?php echo site_url('item/washed_item_list');?>">洗水牛仔</a></li>
                            <li><a href="<?php echo site_url('item/selvedge_item_list');?>">赤耳单宁</a></li>
                            <li><a href="<?php echo site_url('item/casual_item_list');?>">休闲裤</a></li>
                        </ul>
                    </div>
                    </li>
                    
                    <li><a href="<?php echo site_url('comment')?>">个人服务</a></li> 
                    <li><a href="<?php echo site_url('news');?>">资讯</a></li> 
                    <li><a href="<?php echo site_url('about')?>">关于</a></li>    
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
            	<ul class="inline">
                	<li><a href="#"><i class="icon-home"></i></a></li>
                    <li>欢迎光临idjeans个人牛仔定制</li>
                </ul>
                
                <ul class="inline right">
                    <li><a href="<?php echo site_url('cart');?>">购物车</a></li>
                    <li><a href="javascript:void(0)" id="my-account">我的账户</a></li>
                </ul> 
            </div>
        </div>
        
    </div><!-- header -->
    
    <div class="container row-fluid">
    
        <!-- Place somewhere in the <body> of your page -->
        <div class="flexslider">
          <ul class="slides">
            <li>
              <img src="<?php echo base_url('images/slider/01.jpg');?>" />
            </li>
            <li>
              <img src="<?php echo base_url('images/slider/02.jpg');?>" />
            </li>
            <li>
              <img src="<?php echo base_url('images/slider/03.jpg');?>" />
            </li>
            <li>
              <img src="<?php echo base_url('images/slider/04.jpg');?>" />
            </li>
          </ul>
        </div>
        
        <div class="shopping-item">
        	<legend>推荐定制</legend>
            <a href="index.php/item/washed_item_list" class="more">更多</a>

            <ul class="thumbnails">
            </ul>  
            <ul class="thumbnails">
            </ul> 
        </div>
        
        <div class="home-info">
        	<div id="contact" class="span4">
            	<h2>联系我们</h2>
                <p style="color:#888;">工作时间：周一至周五 9:00-18:00</p>
            	<ul>
                	<li><i class="icon-bell"></i>电话: 159-3254-0000</li>
                    <li><i class="icon-envelope"></i>邮箱: contact@idjeans.cn</li>
                </ul>
            </div>
            
            <div id="taobao" class="span4">
            	<img src="<?php echo base_url('images/others/taobao_logo.png');?>" alt="淘宝店" />
            </div>
            
            <div id="follow" class="span4">
            	<img src="<?php echo base_url('images/others/wechat_code.jpg');?>" alt="微信二维码"/>
            	<img id="wechat_logo" src="<?php echo base_url('images/others/wechat.png')?>" alt="微信"/>
            </div>
      </div>
        
    </div><!-- body container -->
    
    <div class="footer">
    	<div class="container">
            <ul id="footer-link" class="inline">
                <li><a href="#">如何定制</a></li> | 
                <li><a href="#">服务条款</a></li> | 
                <li><a href="#">退换货物</a></li> | 
                <li><a href="#">商业合作</a></li> | 
                <li><a href="#">关于我们</a></li>
            </ul>
                    
            <img id="footer-logo" src="<?php echo base_url('images/logo.png');?>" />
            <p id="description">I.D牛仔定制中心主营优质洗水丹宁，赤耳丹宁及休闲裤定制服务，<br>
并承诺使用高质素材料及技术进行制作，一切出售产品均享受《I.D定制售后协议》保护。<p>
          <p id="copyright">2010-2013 <span style="font-size:20px;">&copy;</span> idjeans.cn All rights reserved. 粤ICP备1234513号</p>
            
           
        </div>
    </div><!-- footer -->
    
    
    
    <script charset="utf-8" src="<?php echo base_url('js/global.js'); ?>"></script>
    <script type="application/javascript">
    
	$(window).load(function() {
		$('.flexslider').flexslider({
			animation: "slide"
		});
	});

	//后台交互
	$(document).ready(function(){
		get_items();
	});

	function get_items(){
		$.ajax({
			url : site_url + 'item/get_popular_items',
			data : {
				start: 0,
				length: 8
			},
			type : 'get',
			dataType : 'json',
			success : function(data){
				if(data.code == 0){
					var items = data.data.items;
					if(items.length > 0){
						for(var i = 0; i < items.length && i < 4; i++){
							var item_page = '';
							if(items[i].item_type == 1)
								item_page = 'item/washed_item/';
							if(items[i].item_type == 2)
								item_page = 'item/selvedge_item/';
							if(items[i].item_type == 3)
								item_page = 'item/casual_item/'; 
							$('.thumbnails').eq(0).append('\
								<li class="span3">' + 
									'<a href="' + site_url + item_page + items[i].item_id + '" class="thumbnail">' + 
										'<img src="' + images_url + 'item/' + items[i].item_photos[0] + '" />' +
										'<div class="detail">' + 
											'<p class="name">' + items[i].item_name + '</p>' + 
											'<p class="price-large right"><span>RMB</span>' + items[i].item_price + '</p>' +
										'</div>' +
									'</a>' + 
								'</li>'
							);
						}
					}
					if(items.length > 4){
						for(var i = 4; i < items.length && i < 8; i++){
							var item_page = '';
							if(items[i].item_type == 1)
								item_page = 'item/washed_item/';
							if(items[i].item_type == 2)
								item_page = 'item/selvedge_item/';
							if(items[i].item_type == 3)
								item_page = 'item/casual_item/'; 
							$('.thumbnails').eq(1).append('\
								<li class="span3">' + 
									'<a href="' + site_url + item_page + items[i].item_id + '" class="thumbnail">' + 
										'<img src="' + images_url + 'item/' + items[i].item_photos[0] + '" />' +
										'<div class="detail">' + 
											'<p class="name">' + items[i].item_name + '</p>' + 
											'<p class="price-large right"><span>RMB</span>' + items[i].item_price + '</p>' +
										'</div>' +
									'</a>' + 
								'</li>'
							);
						}
					}
				}
			},
			error : function(){
			}
		});
	}
	</script>
    
    
</body>


</html>

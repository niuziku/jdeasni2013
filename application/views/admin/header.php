<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('css/admin.css'); ?>" />
	<title>IDJEANS</title>
    <script type="text/javascript" src="<?php echo base_url('js/jquery-1.9.1.min.js'); ?>"></script>
</head>

<body>
<div id="wrap">
	<div id="header">
    	<div id="menu">
        	<ul>
            	<li><a href="<?php echo site_url('admin/order');?>">订单</a></li>
                <li><a href="<?php echo site_url('admin/item');?>">商品</a></li>
                <li><a href="<?php echo site_url('admin/item_detail');?>">商品细节</a></li>
                <li><a href="<?php echo site_url('admin/customer');?>">用户</a></li>
                <li><a href="<?php echo site_url('admin/news');?>">资讯</a></li>
                <li><a href="<?php echo site_url('admin/comment');?>">评论</a></li>
                <li><a href="<?php echo site_url('admin/discount');?>">优惠券</a></li>
            </ul>
        </div>
    	<div id="admin_menu">
            <ul>
                <li><?php echo $admin_name; ?></li>
                <li><a href="<?php echo site_url('admin/admin/edit_password');?>">修改密码</a></li>
                <li><a href="javascript:void(0)" onClick="logout()">退出</a></li>
            </ul>
		</div>
    </div>
    
    <script type="text/javascript">
	admin_url = "<?php echo site_url('admin');?>" + '/';
		//admin_url = "http://www.idjeans.cn/index.php/admin/";
    </script>
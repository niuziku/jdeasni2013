<!DOCTYPE html>
<html lang="cn">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<!-- Bootstrap -->
	<link href="<?php echo base_url('css/bootstrap.css'); ?>" rel="stylesheet" media="screen" /> 
    <link href="<?php echo base_url('css/idjeans.css');?>" rel="stylesheet" media="screen" />
    
    <link href="<?php echo base_url('css/account.css')?>" rel="stylesheet" media="screen" />
    
    <!-- JQuery -->
    <script src="<?php echo base_url('js/jquery-1.9.1.min.js');?>"></script>
	<!-- Bootstrap -->
	<script src="<?php echo base_url('js/bootstrap.js');?>"></script>
    
    
    
	<title>Account - idjeans</title>
    
    <style>
		body {
			background:url(<?php echo base_url('images/others/bg_login.jpg');?>) no-repeat center top;
		}
		
		.header-nav {
			height: 50px;
			font-size:16px;
			color:#FFF;
			background-color:#002878;
			border-bottom:0;
		}
		
		.login {
			position:absolute;
			left:50%;
			margin-left:-220px;
			top:50%;
			margin-top:-165px;
			width:400px;
			
			background:#fff;
			background:rgba(255,255,255,0.9);
			-webkit-border-radius:4px;
			-moz-border-radius:4px;
			border-radius:4px;
			
			-webkit-box-shadow:1px 3px 10px #222222;
			-moz-box-shadow:1px 3px 10px #222222;
			box-shadow:1px 3px 10px #222222;
		}
		
		.login {
			padding:14px;
		}
		
		.login h3 {
			font-weight:100;
			margin-bottom:20px;
			line-height:20px;
		}
	
		.login .control-label {
			width:90px;
		}
		
		.login .controls {
			margin-left:110px;
		}
		
		.login .controls .btn {
			width:190px;
		}
		
		.login hr {
			border-bottom:1px solid #ccc;
			margin:30px 40px 10px 40px;
		}
		
		.login .tips {
			text-align:center;
			padding:0;
		}
		
		.login .remember {
			position:relative;
			left:110px;
			top:-10px;
		}
		
		.login input[type="checkbox"] {
			position:relative;
			top:-3px;
			margin-right:2px;
		}
		
	</style>
</head>


<body>
<?php

//↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
//合作身份者id，以2088开头的16位纯数字
$config['alipay_config']['partner']		= '2088002830395895';

//安全检验码，以数字和字母组成的32位字符
$config['alipay_config']['key']			= '9ap34e3n28xt262cqx4gqlr9pmjc6x7g';


//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑

//卖家支付宝帐户
$config['alipay_config']['seller_email'] = 'josen2257@126.com';

//签名方式 不需修改
$config['alipay_config']['sign_type']    = strtoupper('MD5');

//字符编码格式 目前支持 gbk 或 utf-8
$config['alipay_config']['input_charset']= strtolower('utf-8');

//ca证书路径地址，用于curl中ssl校验
//请保证cacert.pem文件在当前文件夹目录中
$config['alipay_config']['cacert']    = getcwd().'\\cacert.pem';

//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
$config['alipay_config']['transport']    = 'http';
?>
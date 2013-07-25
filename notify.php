<?php
	$fp = fopen("log.txt","a");
	flock($fp, LOCK_EX) ;
	fwrite($fp,"执行日期：".date("Y-m-d H:i:s")."\n".$word."\n");
	flock($fp, LOCK_UN);
	fclose($fp);
	echo "ok";
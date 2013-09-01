<script charset="utf-8" src="<?php echo base_url('js/global.js'); ?>"></script>
<script type="text/javascript">

function setCookie(name,value)
{
    var Days = 30;
    var exp = new Date();
    exp.setTime(exp.getTime() + Days*24*60*60*1000);
    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString() + ";path=/";

}

//读取cookies
function getCookie(name)
{
    var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
 
    if(arr=document.cookie.match(reg))
 
        return unescape(arr[2]);
    else
        return null;
}

//删除cookies
function delCookie(name)
{
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval=getCookie(name);
    if(cval!=null)
        document.cookie= name + "="+cval+";expires="+exp.toGMTString();
}
	
//var local_url = document.location.href; 
var html = getCookie("html");
delCookie("html");
html += "<script>document.forms['paysubmit'].submit();<\/script>";
$("#alipay-jump").append(html);
</script>

</body>
</html>
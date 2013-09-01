<script charset="utf-8" src="<?php echo base_url('js/global.js'); ?>"></script>
<script type="text/javascript">
var local_url = document.location.href;
var bindex = local_url.indexOf("{");
var eindex = local_url.indexOf("}");
var html = local_url.substring(bindex+1, eindex);
html = decodeURI(html);
$("#alipay-jump").append(html);
</script>

</body>
</html>
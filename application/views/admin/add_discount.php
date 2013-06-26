	<div id="main">
    	<div id="nav">
        	<h3>添加优惠券</h3>
            <a class="other_link" href="<?php echo site_url('admin/discount');?>">优惠券列表</a>
        </div>
        <div id="content">
        	<form id="discount_form" name="discount_form" method="post">
            	<?php 
					$discount_code = sha1(time()); 
					$discount_code = substr($discount_code, 0, 8);
					$discount_code = strtoupper($discount_code);
				?>
            	<span>优惠码：<input type="hidden" name="discount_code" value="<?php echo $discount_code; ?>" /><?php echo $discount_code; ?></span>
                <span>优惠类型：
                <select name="discount_type">
                	<option value="1" selected="selected">一次性优惠券</option>
                    <option value="2">可复用优惠券</option>
                </select>
                </span>
                <span>优惠额度：<input type="text" name="minus_price" />元</span>
                <input class="submit_button" type="submit" name="submit" value="添加" />
            </form>
        </div>
    </div>
    <script type="text/javascript">
		$(document).ready(function() {
			$("#discount_form").submit(function() {
				
				if(discount_form.minus_price.value=="") {
					alert("请填入优惠额度！");
					return false;
				}
				if(!(/^[1-9][0-9]*$/.test(discount_form.minus_price.value))) {
					alert("请输入一个正整数！");
					return false;
				}
				
				$.ajax({
					url : admin_url + "discount/add_discount",
					data : $("#discount_form").serialize(),
					type: "post",
					dataType : "json",
					success : function(data, status) {
						if(data.code == 0) {
							window.location.href = admin_url + "discount";
						}
						else if(data.code == 666) {
							alert("添加失败，请重新进入本页面！");
						}
						else {
						}
					},
					error : function() {
						
					}
				});
				return false;
			});
		});
		</script>
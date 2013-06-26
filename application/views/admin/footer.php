	<div id="footer">
    	<p>Copyright&copy; 2013 Idjeans</p>
	</div>
</div>
<script type="text/javascript">
function logout() {
	$.ajax({
			url : admin_url + "login/logout_operation",
			type: "get",
			dataType : "json",
			success : function(data, status) {
				if(data.code == 0) {
					window.location.href = admin_url + "login";
				}
				else {
				}
			},
			error : function() {
				
			}
		});
}
</script>
</body>
</html>
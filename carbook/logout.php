<script language="javascript">
var logout = confirm("Are you sure to logout?");
//alert(logout);
if(logout){
	location.href = "index.php";
}else{
     history.go(-1);
}

</script>
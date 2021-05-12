<?php
	include("link.php");
	include("header.php");
include("nav.php");
$query = "SELECT `Product_name` FROM `payment_logs` WHERE ORDERID = '".mysqli_real_escape_string($link,$_GET['ORDERID'])."'";
$row = mysqli_fetch_array(mysqli_query($link, $query));

?>
<div class="container">
		<center>
		<h1>The download should start shortly. If it doesn't, click below Button</h1>
	
		<button type="download" name="dnld" class="btn btn-light text-white"><a href='solved_Papers/<?php echo $row['Product_name']; ?>' download>Download file</a></button>
		</center>
		<script type="text/javascript">
			window.onload = function(){
    var button = document.getElementById('dnld');
    button.form.submit();
}
		</script>
	
</div>
<?php include("footer.php"); ?>
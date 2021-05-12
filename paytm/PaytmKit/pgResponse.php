<?php
$link = mysqli_connect("localhost","id4078310_developer","#letsDevelop","id4078310_multiprogrammers");
if(mysqli_connect_error()) {
  die ("Database Connection Error");
}
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");



// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


if($isValidChecksum == "TRUE") {
	echo "<b>Checksum matched and following are the transaction details:</b>" . " <br/>";
	
	$query = "SELECT *
          FROM `payment_logs`
          WHERE payment_logs.ORDERID='".mysqli_real_escape_string($link,$_POST['ORDERID'])."'";
$row = mysqli_fetch_array(mysqli_query($link, $query));
	/*
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		echo "<b>Transaction status is success</b> " . "<br/>";
	
		 $query = "INSERT INTO `payment_logs`(`ORDERID`,`TXNAMOUNT`,`STATUS`, `PAYMENTMODE`, `GATEWAYNAME`, `RESPMSG`)
                    VALUES(
                      '".mysqli_real_escape_string($link,$_POST['ORDERID'])."',
                      '".mysqli_real_escape_string($link,$_POST['TXNAMOUNT'])."',
		      '".mysqli_real_escape_string($link,$_POST['STATUS'])."',
		      '".mysqli_real_escape_string($link,$_POST['PAYMENTMODE'])."',
		      '".mysqli_real_escape_string($link,$_POST['GATEWAYNAME'])."',
		      '".mysqli_real_escape_string($link,$_POST['RESPMSG'])."'
                    )";
*/
		if($_POST['ORDERID'] == $row['ORDERID']) {
			if ($_POST["STATUS"] == "TXN_SUCCESS") {
				echo "<b>Transaction status is success</b> " . "<br/>";
					$query = "UPDATE `payment_logs`
						  SET
						  `TXNAMOUNT` = '".mysqli_real_escape_string($link,$_POST['TXNAMOUNT'])."',
						  `STATUS` = '".mysqli_real_escape_string($link,$_POST['STATUS'])."',
						  `PAYMENTMODE` = '".mysqli_real_escape_string($link,$_POST['PAYMENTMODE'])."',
						  `GATEWAYNAME` = '".mysqli_real_escape_string($link,$_POST['GATEWAYNAME'])."',
						  `RESPMSG` = '".mysqli_real_escape_string($link,$_POST['RESPMSG'])."'
							WHERE `LOG_NO` = $row[LOG_NO]";
					if(mysqli_query($link,$query)) {
						  echo "<h2>Success! SAVED TO LOGS</h2>";
						  echo "Click here to <a class='btn btn-warning btn-lg' href='http://multiprogrammer.online/feedbackpg.php?ORDERID=".urlencode($row['ORDERID'])."' role='button'>Download</a> your file.";			
						} else {
						  echo "<h2>Oh! LOGS DIDN'T GOT DATA</h2>";
				  
						}
			} else {
				echo "<b>Transaction status is failure</b>" . "<br/>";
				$query = "UPDATE `payment_logs`
						  SET
						  `TXNAMOUNT` = '".mysqli_real_escape_string($link,$_POST['TXNAMOUNT'])."',
						  `STATUS` = '".mysqli_real_escape_string($link,$_POST['STATUS'])."',
						  `PAYMENTMODE` = '".mysqli_real_escape_string($link,$_POST['PAYMENTMODE'])."',
						  `GATEWAYNAME` = '".mysqli_real_escape_string($link,$_POST['GATEWAYNAME'])."',
						  `RESPMSG` = '".mysqli_real_escape_string($link,$_POST['RESPMSG'])."'
						  WHERE `LOG_NO` = $row[LOG_NO]";
					if(mysqli_query($link,$query)) {
						  echo "<h2>Success! SAVED TO LOGS</h2>";
						} else {
						  echo "<h2>Oh! LOGS DIDN'T GOT DATA</h2>";
				  
						}
			}
	} else {
		echo "Order is tempered, sorry but we cant proceed.";
	}
		

	if (isset($_POST) && count($_POST)>0 )
	{ 
		foreach($_POST as $paramName => $paramValue) {
				echo "<br/>" . $paramName . " = " . $paramValue;
		}
	}
	

}
else {
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}

?>

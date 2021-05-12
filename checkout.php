<?php
session_start();
include("link.php");



$query = "SELECT `ppr_price`,`solved_ppr`
          FROM `solvedPapers`
          WHERE solvedPapers.solved_paperId='".mysqli_real_escape_string($link,$_GET['solved_paperId'])."'";
$row = mysqli_fetch_array(mysqli_query($link, $query));

$amount = $row['ppr_price'];
$paper = $row['solved_ppr'];
$pprId = $_GET['solved_paperId'];
$orderId = "ORD".rand(1000,99999);
include("header.php");
include("nav.php");

$comment_error = "";
$comment_success = "";

	if (isset($_GET["solved_paperId"]))
	{ 
		$query = "INSERT INTO `payment_logs`(`ORDERID`,`Product_name`)
                    VALUES(
                      '".mysqli_real_escape_string($link,$orderId)."',
                      '".mysqli_real_escape_string($link,$paper)."'
                    )";
	if(mysqli_query($link,$query)) {
                  echo "<h2>Success! SAVED TO LOGS</h2>";
		
                } else {
                  echo "<h2>Oh! LOGS DIDN'T GOT DATA</h2>";
			
                }
	}

?>

<div class="container-fluid">

  

      <div class="container bg-light rounded text-info" style="padding:10px;">

       <form method="post" action="paytm/PaytmKit/pgRedirect.php">
		<table border="1">
			<tbody>
				<tr>
					<th>S.No</th>
					<th>Label</th>
					<th>Value</th>
				</tr>
				<tr>
					<td>1</td>
					<td><label>ORDER_ID::*</label></td>
					<td><input id="ORDER_ID" tabindex="1" maxlength="20" size="10"
						name="ORDER_ID" autocomplete="off"
						value="<?php echo $orderId; ?>" readonly>
					</td>
				</tr>
				<tr>
					<td>2</td>
					<td><label>CUSTID ::*</label></td>
					<td><input id="CUST_ID" tabindex="2" maxlength="12" size="10" name="CUST_ID" autocomplete="off" value="<?php echo  "guest" . rand(1000,99999)?>" readonly> </td>
				</tr>
				<tr>
					<td>3</td>
					<td><label>INDUSTRY_TYPE_ID ::*</label></td>
					<td><input id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="10" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail" readonly></td>
				</tr>
				<tr>
					<td>4</td>
					<td><label>Channel ::*</label></td>
					<td><input id="CHANNEL_ID" tabindex="4" maxlength="12"
						size="10" name="CHANNEL_ID" autocomplete="off" value="WEB" readonly>
					</td>
				</tr>
				<tr>
					<td>5</td>
					<td><label>File Name</label></td>
					<td><input id="PPR" tabindex="4" maxlength="20" size="10"
						name="PPR" autocomplete="off"
						value="<?php echo $paper;?>" readonly>
					</td>
				</tr>
				<tr>
					<td>5</td>
					<td><label>txnAmount*</label></td>
					<td><input title="TXN_AMOUNT" tabindex="2" size="10"
						type="text" name="TXN_AMOUNT"
						value="<?php echo $amount;?>" readonly>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td><input value="CheckOut" type="submit" name="go"	onclick=""></td>
				</tr>
			</tbody>
		</table>
	
	</form>

    </div>


</div>

<?php include("footer.php"); ?>

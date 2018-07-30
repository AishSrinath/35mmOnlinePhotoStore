<?php 
include_once ("storescripts/connect_to_mysql.php");
//return to uRL
$st = $_REQUEST['st'];
if($st=="Completed") {
//Transaction Succeeded
    $status = 1;
} else {
    $status = 0;
//Transaction failed
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<input type="submit" value="" />
<title>Order Summary</title>
</head>
<body>    
<?php
if($status==1) {
    echo "Payment was successfull!";
} else {
    echo "Payment failed please try again!";
?>
<p><a href="basket.php">Continue Shopping </a></p>
<?php } ?>
</body>
</html>

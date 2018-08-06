<?php 
ob_start();
session_start();
include_once ("storescripts/connect_to_mysql.php");
ini_set('display_errors', '1');
$user_id      = $_SESSION['login_id']; 
$_SESSION['uid'] = $user_id;
  if (strlen($_SESSION['uid'])<=0)
  {
 	 header("location:login.php?action=checkout");
 	 exit;
  }
  if (isset($_POST['placeorder']))
  {
  
        $order_no = "ORDN".mt_rand(100, 999);      
        $product_name        = $_POST['product_name'];
        $product_qty         = $_POST['product_qty'];
        $product_price       = $_POST['product_price'];
        $total              = $_POST['total'];      
	$name=str_replace("'", "''", $_POST['name']);
	$adr1=str_replace("'", "''", $_POST['adr1']);
	$city=str_replace("'", "''", $_POST['city']);
        $state=str_replace("'", "''", $_POST['state']);	
	$pcode=str_replace("'", "''", $_POST['pcode']);
	$phone=str_replace("'", "''", $_POST['phone']);
	$country=str_replace("'", "''", $_POST['country']);
	$email=str_replace("'", "''", $_POST['email']);
        
   $sql = "INSERT INTO  tbl_order(`order_num`,`product_name`,`product_price`,`product_qty`,`total`,`payment_status`,`ship_name`,`ship_address`,`ship_city`,`ship_state`,`ship_country`,`ship_postcode`,`ship_phone`,`ship_email`)
          values('$order_no','$product_name','$product_price','$product_qty','$total','0','$name','$adr1','$city','$state','$country','$pcode','$phone','$email')";    
       
	mysqli_query($db_connect,$sql) or die(mysqli_error($db_connect));

     
}

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<!--<input type="submit" value="" />-->
<title>paypal</title>
</head>
<body>    
<form class="form-horizontal" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="POST">
<input type='hidden' name='business' value='aiswarya.g2008@gmail.com'>
<input type='hidden' name='item_name' value='<?php echo $product_name;?>'>
<input type='hidden' name='item_number' value="<?php echo $order_no;?>">
<input type='hidden' name='amount' value='<?php echo $total;?>'>
<input type='hidden' name='currency_code' value='USD'>
<input type='hidden' name='notify_url' value='http://35.234.111.99/notify.php'>
<input type='hidden' name='return' value='http://35.234.111.99/success.php'>
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="order" value="<?php echo $order_no;?>">
<br>
<div class="form-group">
<div class="col-sm-2">
    <img src="images/paypal.jpg" height="400" width="400"/>
<input type="submit" class="btn btn-lg btn-block btn-danger" name="continue_payment" value="Pay Now">
</div>
</div>
</form>

</body>
</html>
<?php
ob_start();
session_start();
include_once ("storescripts/connect_to_mysql.php");
include_once ("mail.php");
//return to uRL

$sid=session_id();

$st = $_REQUEST['st'];
if($st=="Completed")
{
    $status = 1;
  //Transaction completed  
$order_no = $_REQUEST["item_number"];          
$sql = "UPDATE tbl_order SET payment_status='1' WHERE order_num='$order_no'";    
mysqli_query($db_connect,$sql) or die(mysql_error());
$sql = "INSERT INTO  tbl_order(`order_num`,`product_name`,`product_price`,`product_qty`,`total`,`payment_status`,`ship_name`,`ship_address`,`ship_city`,`ship_state`,`ship_country`,`ship_postcode`,`ship_phone`,`ship_email`)
          values('$order_no','$product_name','$product_price','$product_qty','$total','0','$name','$adr1','$city','$state','$county','$pcode','$phone','$email')";    
   
//Send mail
   
 $sqlcat1 = "SELECT * FROM tbl_order WHERE order_num='$order_no'";
 $res= mysqli_query($db_connect,$sqlcat1) or die("error");
if(mysqli_affected_rows($db_connect)) 
{ 
  while($row1 = mysqli_fetch_assoc($res))
              {
                 $order_num         = $row1['order_num'];
                 $product_name      = $row1['product_name'];
                 $product_price     = $row1['product_price'];
                 $product_qty       = $row1['product_qty'];
                 $total             = $row1['total'];
                 $ship_name         = $row1['ship_name'];
                 $ship_address      = $row1['ship_address'];
                 $ship_city         = $row1['ship_city'];
                 $ship_state        = $row1['ship_state'];
                 $ship_country      = $row1['ship_country'];                 
                 $ship_postcode     = $row1['ship_postcode'];
                 $ship_phone        = $row1['ship_phone'];
                 $ship_email        = $row1['ship_email'];                 
                 // for sending mail//                 
                 $subject = "Purchase Deatils";
                 $body =$message = "
<html>
<head>
<title>Payment Information </title>
</head>
<body>
<p>Your  Payment was successfull order details are shown below</p>
<table>
<tr>
<td>Thank you ".$ship_name." for shopping with 35mm ! You will recieve your order in 2-6 working days. </td>
</tr>
<tr>
<td>-----------Your purchase details---------------- </td>
</tr>
<tr>
<td>Total Purchase amount </td>
<td>".$total."</td>
</tr>
<tr>
<td>Shipping Name </td>
<td>".$ship_name."</td>
</tr>
<tr>
<td>Shipping Address </td>
<td>".$ship_address."</td>
</tr>
<tr>
<td>Shipping City </td>
<td>".$ship_city."</td>
</tr>

<tr>
<td>Shipping State </td>
<td>".$ship_state."</td>
</tr>
<tr>
<td>Shipping Phone </td>
<td>".$ship_phone."</td>
</tr>

</table>
</body>
</html>
";
                         
     sendmail ($ship_name,$ship_email,$subject,$body);            
                 
           
            
              }
}
//For send sms

//	$cxname="buyer";
	$cxemail="00353".$ship_phone."@echoemail.net";
	sendmail ($ship_name,$cxemail,$order_num,"Your order no:'$order_num' is processed");

//end 

//For empty cart
  $sqlcat_del = "DELETE FROM tbl_cart WHERE cart_sessionid='$sid'";
 $res_del= mysqli_query($db_connect,$sqlcat_del) or die("error");     
//      
}
 else {
      $status = 0;
      
      
    //transaction failde  
}

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>success</title>
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
<style>
/* Style the tab */
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
.responsive {
    width: 100%;
    max-width: 400px;
    height: auto;
}

</style>
</head>
<body>
<div align="center" id="mainWrapper" >
<?php include_once("template_header.php");?>
    <div style=" height: 500">
    <span style="color:green;height: 500px;">
<?php
if($status==1)
{
    echo "Payment was successfull!";
}
 else {
    echo "Payment failed please try again!";
    ?>
    </span>
    <p><a href="basket.php">Continue Shopping </a></p>
    <?php
 }
?>
 
    </div>
<?php include_once("template_footer.php"); ?>
</div>
</body>
</html>


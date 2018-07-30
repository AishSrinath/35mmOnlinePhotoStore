<?php
ob_start();
session_start();
$sid=session_id();
include_once ("storescripts/connect_to_mysql.php");
$pid=$_POST['pid'];
$pname=$_POST['pname'];
$product = "SELECT * FROM products where id='$pid'";
$result_product = mysqli_query($db_connect,$product);
$row = mysqli_fetch_assoc($result_product);
$pqty=$_POST['pqty'];
$pcode=$_POST['pcode'];
$image_type=$_POST['image_type'];
if($image_type=='large') {
    $pprice=$row['price']; 
    $pimage = $row['image'];
} else {
    $pprice=$row['price_small'];
    $pimage = $row['image_small'];  
}
/*if (strlen(trim($pimage))==0)
	$pimage='NULL';*/
$sql="select * from tbl_cart where cart_sessionid='$sid' and cart_pid=$pid and cart_pname='$pname'";
$result_cart=mysqli_query($db_connect,$sql) or die (mysqli_error($db_connect));
if(mysqli_affected_rows($db_connect)) {
    $sql="update tbl_cart set cart_qty=cart_qty+1 where cart_sessionid='$sid' and cart_pid=$pid and cart_pname='$pname'";
} else {
    $sql="insert into tbl_cart(cart_sessionid,cart_pid,cart_pname,cart_qty,cart_price,cart_pimage) values ('$sid',$pid,'$pname',$pqty,$pprice,'$pimage')";
}
mysqli_query($db_connect,$sql) or die(mysqli_error($db_connect));
header('Location:basket.php');
?>
  
   

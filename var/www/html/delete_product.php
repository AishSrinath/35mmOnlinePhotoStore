<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>delete product</title>
</head>

<body>   
<?php 

include_once ("template_header.php");
?>

<?php
 ob_start();
 include_once('storescripts/connect_to_mysql.php');
 echo "outside the if";
 echo $_SESSION;
 
 if (isset($_GET['id']))

 {
 echo "inside the if loop";
 	$id=strip_tags(mysqli_real_escape_string($db_connect,trim($_GET['id'])));
        echo $id;
	echo $sql="delete from products where id=$id";
	mysqli_query($db_connect,$sql) or die(mysql_error());
		
 }	
 header('location:product.php');
 ?>
    <table width="500" border="0" cellpadding="5">

<tr>

<td align="center" valign="center">
<img src="images/cart.jpg" height="40" width="40"/>
<br />
<a href="discover.php" class="btn-grey btn-bas-contshopping"> Continue Shopping</a>
</td>
</tr>
    </table>
</body>
</html>
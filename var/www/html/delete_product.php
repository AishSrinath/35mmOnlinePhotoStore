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

<? 
 ob_start();
 include_once('storescripts/connect_to_mysql.php');
 
 if (isset($_GET['id']))

 {
 echo "inside teh if loop";
 	$id=strip_tags(mysqli_real_escape_string($db_connect,trim($_GET['id'])));
        echo $id;
	echo $sql="delete from products where id=$id";
	mysqli_query($db_connect,$sql) or die(mysql_error());
		
 }	
 header('location:product.php');
 ?>
</body>
</html>
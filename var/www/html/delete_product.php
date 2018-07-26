<? 
 ob_start();
 include_once('storescripts/connect_to_mysql.php');
 if (isset($_GET['id']))
 {
 	$id=strip_tags(mysqli_real_escape_string($db_connect,trim($_GET['id'])));
	$sql="delete from products where id=$id";
	mysqli_query($db_connect,$sql) or die(mysql_error());
		
 }	
 header('location:product.php');
 ?>
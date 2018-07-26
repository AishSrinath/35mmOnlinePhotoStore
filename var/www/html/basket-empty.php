<?php 
ob_start();
session_start();
include_once ("storescripts/connect_to_mysql.php");
if(!isset($_SESSION['login_id']))
{
    header("Location:login.php");
}
 $user_id      = $_SESSION['login_id']; 
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Product</title>
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
</head>

<body>
<div align="center" id="mainWrapper">
	<?php include_once("template_header.php"); ?>
    
    
<div id="tbl_container_demo_grid1" class="table-responsive">
    <p><h1 style="color: red;">Your Shopping cart is empty</h1>
</div>    
	<?php include_once("template_footer.php"); ?>
</div>
</body>
</html>

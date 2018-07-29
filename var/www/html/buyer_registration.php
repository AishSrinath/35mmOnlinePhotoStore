
<?php 
ob_start();
session_start();
include_once ("storescripts/header.php");
$id=$_SESSION['login_id'];
$sql_admin="select * from user where id='$id'";
$sql_admin_query=mysqli_query($db_connect, $sql_admin);
$fetch=  mysqli_fetch_assoc($sql_admin_query);?>
<html>
<head>
<meta charset="UTF-8">
<title>Buyer home</title>
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
</head>

<body background="images/pup.png">
<div class="navbar">
  <a href="index.php">Home</a>
  <a href="about_us.php">About Us</a>
  <a href="discover.php">Discover</a>
 
  <div style="float: right;">
  <a href="#"><?php echo "Welcome  ".$fetch['firstname']; ?></a>
  <a href="logout.php">Logout</a>
  </div>
      
    </div>
    <div>
    <p style="font-size:20px;" style="text-align:center;" style="font-family:TimesNewRoman;"><i>Welcome to 35mmPhotoStore.Please select discover to browse through our exclusive photo collection.</i></p>
	
</div>
</div>    
	<?php include_once("template_footer.php"); ?>
</div>
</body>
</html>
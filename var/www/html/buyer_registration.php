
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
<div align="center" id="mainWrapper">
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="about_us.php">About Us</a>
        <a href="discover.php">Discover</a>
        <div style="float: right;">
        <a href="#"><?php echo "Welcome  ".$fetch['firstname']; ?></a>
        <a href="logout.php">Logout</a>
        </div>  </div>
    <div>
        <p style="font-size:40px;font-family:Algerian;color:orange;"><i><?php echo "Welcome  ".$fetch['firstname']; ?></i></p>
  <p style="font-size:30px;font-family:Imprint MT Shadow;color:red;"><i><b>Thank you for registering with us</b></i></p><p style="font-size:25px;font-family:Imprint MT Shadow;"><i>To browse through our exclusive photo collection click on the above <b>Discover Tab</b></i></p><p style="font-size:35px;font-family:Algerian;color:indigo;"><i><b>Happy Shopping....!!!</b></i></p>	
    </div>    
    </div>
    <?php include_once("template_footer.php"); ?>
</body>
</html>


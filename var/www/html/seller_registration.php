<?php 
ob_start();
session_start();
include_once ("storescripts/header.php");
$id=$_SESSION['login_id'];
$sql_admin="select * from user where id='$id'";
$sql_admin_query=mysqli_query($db_connect, $sql_admin);
$fetch=  mysqli_fetch_assoc($sql_admin_query);?>
<div class="navbar">
  <a href="index.php">Home</a>
 
  <div style="float: right;">
  <a href="#"><?php echo "Welcome  ".$fetch['firstname']; ?></a>
  <a href="logout.php">Logout</a>
  </div>
      
    </div>
	
    <P><h1>Seller Registration</h1></P>
	<?php include_once("template_footer.php"); ?>
</div>
</body>
</html>

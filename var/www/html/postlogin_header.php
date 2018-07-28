<?php 
ob_start();
session_start();
include_once ("storescripts/connect_to_mysql.php");
$user_id      = $_SESSION['login_id']; 
$sql_admin="select * from user where id='$user_id'";
$sql_admin_query=mysqli_query($db_connect, $sql_admin);
$fetch=  mysqli_fetch_assoc($sql_admin_query); 

$sql_admin1="select * from admin where id='$user_id'";
$sql_admin_query1=mysqli_query($db_connect, $sql_admin1);
$fetch1=  mysqli_fetch_assoc($sql_admin_query1);
?>
<div id="pageHeader"><table width="100%" border="0" cellspacing="0" cellpadding="12">
<a href="index.php"><img src="http://35.198.90.129/style/logo.jpg" width="75" height="60" alt="logo" align="left"/><br />
<p align="left"><i>For the artist in you</i></p><br />
<div class="navbar">
  <a href="index.php">Home</a>
  <a href="about_us.php">About Us</a>
  <a href="discover.php">Discover</a>
  <a href="product.php">My Account</a>
  <a href="product.php">Product</a>
  <a href="addproduct.php">Add Product</a>
  </div> 
  <?php 
  if(isset($_SESSION["user_role"]))
  {
  if($_SESSION["user_role"]==1){ ?>
          <!--<a href="addproduct.php">Add Product</a>
          <a href="product.php">Product</a>-->
 
  <div style="float: right;">
  <a href="#"><?php echo "Welcome  ".$fetch['firstname']; ?></a>
  <a href="logout.php">Logout</a>
  </div>
      <?php } ?>
       <?php if($_SESSION["user_role"]==2){ ?>
          <a href="add_category.php">Add Category</a>
          <a href="category.php">Category</a>
 
       <?php } } ?> 
</div>
  </tr>
  </tbody>
  </table>
</div>


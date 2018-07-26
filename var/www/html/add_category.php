<?php 
ob_start();
session_start();
$id=$_SESSION['login_id'];
$sql_admin="select * from admin where id='$id'";
$sql_admin_query=mysqli_query($db_connect, $sql_admin);
$fetch=  mysqli_fetch_assoc($sql_admin_query);
?>
<style>
body {
  font-family: Arial;
  margin: 0;
}

* {
  box-sizing: border-box;
}

img {
  vertical-align: middle;
}

/* Position the image container (needed to position the left and right arrows) */
.container {
  position: relative;
}

/* Hide the images by default */
.mySlides {
  display: none;
}

/* Add a pointer when hovering over the thumbnail images */
.cursor {
  cursor: pointer;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 40%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* Container for image text */
.caption-container {
  text-align: center;
  background-color: #222;
  padding: 2px 16px;
  color: white;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Six columns side by side */
.column {
  float: left;
  width: 16.66%;
}

/* Add a transparency effect for thumnbail images */
.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}
</style>
<div id="pageHeader"><table width="100%" border="0" cellspacing="0" cellpadding="12">
<a href="index.php"><img src="http://35.198.90.129/style/logo.jpg" width="75" height="60" alt="logo" align="left"/><br />
    <p align="left" style="color:black"><i><b>For the artist in you</b></i></p><br />
<div class="navbar">
  <a href="index.php">Home</a>
  <a href="about_us.php">About Us</a>
  <a href="discover.php">Discover</a>
  <a href="category.php">Category</a>
  <div style="float: right;">
      <a href="logout.php">Logout</a>
  </div>
</div>
</div>
<?php 
if (isset($_POST['add']))
{
$category_name=  mysqli_real_escape_string($db_connect,$_REQUEST['category_name']);
$sql="insert into category(name) values('$category_name')";
mysqli_query($db_connect,$sql);
 header('location:category.php');
}
?>
<?php include_once("template_header.php"); ?>
  <form method="post" action="">
      <div class="input-group">
  	  <label>Category Name</label>
          <input type="text" name="category_name" required="">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="add">ADD</button>
  	</div>
  </form>
<?php include_once("template_footer.php"); ?>
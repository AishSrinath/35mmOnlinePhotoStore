<?php
require "storescripts/connect_to_mysql.php";
ob_start();
$msg="";
//session_start();
$login=true;
$no_visible_elements=true;
if(isset($_REQUEST['Exit']) &&  $_REQUEST['Exit']=="end")
{
 session_unset();
}
if(isset($_REQUEST['Exit']) &&  $_REQUEST['Exit']=="exp")
{
 session_unset();
 $msg="Your session has expired.";
}
//else
//	$msg="Please login with your Username and Password.";
if (isset($_POST['login']))
{
	$conn = mysqli_connect($db_host, $db_username, $db_pass, $db_name);
	$user_name=strip_tags(mysqli_real_escape_string($conn,trim($_POST['username'])));
	$pwd=strip_tags(mysqli_real_escape_string($conn,trim($_POST['password'])));
	$sql_query = "SELECT `id`, `user_role`, `username`, `password` FROM `user` WHERE username='$user_name' AND password='$pwd'";
	$sql = mysqli_query($conn, $sql_query);
	if (mysqli_num_rows($sql)>0)
	{
		$row_login=mysqli_fetch_assoc($sql);
		$_SESSION['user_name']=$row_login['user_name'];
		$_SESSION['id']=$row_login['id'];
                if($row_login['user_role']==0){
		header('location:buyer_registration.php');
                }
                else if($row_login['user_role']==1){
                 header('location:seller_registration.php');
                }
 	else {
    header('location:admin.php');
 	}
	exit;
	}
	else{
		$msg="The username or password you entered is incorrect";
        }
	}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Store Home Page</title>
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
<style>
form, .content {
  width: 30%;
  margin: 0px auto;
  padding: 20px;
  border: 1px solid #B0C4DE;
  background: white;
  border-radius: 0px 0px 10px 10px;
}
.input-group {
  margin: 10px 0px 10px 0px;
}
.input-group label {
  display: block;
  text-align: left;
  margin: 3px;
}
.input-group input {
  height: 30px;
  width: 93%;
  padding: 5px 10px;
  font-size: 16px;
  border-radius: 5px;
  border: 1px solid gray;
}
.btn {
  padding: 10px;
  font-size: 15px;
  color: white;
  background: #5F9EA0;
  border: none;
  border-radius: 5px;
}
.error {
  width: 92%; 
  margin: 0px auto; 
  padding: 10px; 
  border: 1px solid #a94442; 
  color: #a94442; 
  background: #f2dede; 
  border-radius: 5px; 
  text-align: left;
}
.success {
  color: #3c763d; 
  background: #dff0d8; 
  border: 1px solid #3c763d;
  margin-bottom: 20px;
}    
</style>
</head>
<body>
<div align="center" id="mainWrapper">
	<?php include_once("template_header.php"); ?>
  	<form method="post" action="">
  	<div class="input-group">
  	<label>Username</label>
        <input type="text" name="username" required="">
  	</div>
  	<div class="input-group">
  	<label>Password</label>
        <input type="password" name="password" required="">
  	</div>
  	<div class="input-group">
  	<button type="submit" class="btn" name="login">Login</button>
  	</div>
  	<p>
  	Not yet a member? <a href="register.php">Sign up</a>
  	</p>
        <p style="color: red;">
          <?php echo $msg; ?>
        </p>
  	</form>
  	<?php include_once("template_footer.php"); ?>
</div>
</body>
</html>

<?php 
include_once ("storescripts/connect_to_mysql.php");
ob_start();
$msg="";
$login=true;
session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Project</title>
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
<?php
$login=true;
$no_visible_elements=true;
//include('storescripts/header.php');
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
	$user_name=mysqli_real_escape_string($db_connect,$_POST['username']);
        $password= md5($_POST['password']);
	$pwd=mysqli_real_escape_string($db_connect,$password);
        
        
	$sql="select username,id,user_role from user where username='$user_name' and password='$pwd'";
        $sql_query=  mysqli_query($db_connect, $sql);
        
        $sql_admin="select username,id,password from admin where username='$user_name' and password='".$_POST['password']."'";
        //echo "select username,id,password from admin where username='$user_name' and password='".$_POST['password']."'";
        //exit();
        $sql_admin_query=mysqli_query($db_connect, $sql_admin);
	if (mysqli_num_rows($sql_query)>0)
	{
		$row_login=mysqli_fetch_assoc($sql_query);
		$_SESSION['login_username']=$row_login['username'];
		$_SESSION['login_id']=$row_login['id'];
                $_SESSION['user_role']=$row_login['user_role'];
                if($row_login['user_role']==0){
		header('location:buyer_registration.php');
                }
                else if($row_login['user_role']==1){
                 header('location:product.php');   
                }
                
                }
                else if (mysqli_num_rows($sql_admin_query)>0){
                $row_login_admin=mysqli_fetch_assoc($sql_admin_query);
		$_SESSION['login_username']=$row_login_admin['username'];
		$_SESSION['login_id']=$row_login_admin['id'];
                $_SESSION['user_role']=2;
                 header('location:category.php');  
                }
        
	else{
		$msg="The username or password you entered is incorrect";
        }
}	

 ?>
<body>
<div align="center" id="mainWrapper">
<?php 

include_once("template_header.php"); ?>
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
<?php include 'includes/footer.php' ?>;

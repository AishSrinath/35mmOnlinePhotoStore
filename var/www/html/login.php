<?php
require 'functions.php';
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
	$user_name=strip_tags(mysql_real_escape_string(trim($_POST['username'])));
	$pwd=strip_tags(mysql_real_escape_string(trim(md5($_POST['password']))));
	$sql = get_user('$user_role','$login_username','$pwd');
	if (mysql_num_rows($sql)>0)
	{
		$row_login=mysql_fetch_assoc($sql);
		$_SESSION['login_username']=$row_login['login_username'];
		$_SESSION['login_id']=$row_login['login_id'];
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
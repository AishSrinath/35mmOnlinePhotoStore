<?php ob_start(); ?>
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
<body>
<div align="center" id="mainWrapper">
<?php 
include_once ("includes/connect_to_mysql.php");
include_once("template_header.php"); ?>

<?php 
if (isset($_POST['reg_user']))
	{
	$conn = mysqli_connect($db_host, $db_username, $db_pass, $db_name);
 	$user_name=mysql_real_escape_string($conn,$_REQUEST['username']);
 	$firstname=mysql_real_escape_string($conn,$_REQUEST['firstname']);
 	$lastname=mysql_real_escape_string($conn,$_REQUEST['lastname']);
 	$email=mysql_real_escape_string($conn,$_REQUEST['email']);
 	$password_1=  mysql_real_escape_string($conn,$_REQUEST['password_1']);
 	//echo $password_1;
	// exit();
 	$user_role=  mysql_real_escape_string($conn,$_REQUEST['user_role']);
	$sql_query = "INSERT INTO `user`(`user_role`, `username`, `password`, `firstname`, `lastname`, `email`) VALUES ('$user_role','$user_name','$firstname','$lastname','$email')";
	mysqli_query($conn, $sql_query);
 	header('location:login.php');
	}
?>

  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	
        <div class="input-group">
  	  <label>First Name</label>
          <input type="text" name="firstname" value="<?php echo $firstname; ?>" required="">
  	</div>
        <div class="input-group">
  	  <label>Last Name</label>
          <input type="text" name="lastname" value="<?php echo $lastname; ?>" required="">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
          <input type="email" name="email" value="<?php echo $email; ?>" required="">
  	</div>
      <div class="input-group">
  	  <label>Username</label>
          <input type="text" name="username" value="<?php echo $username; ?>" required="">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
          <input type="password" name="password_1" required="">
  	</div>
<!--  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>-->
        <div class="input-group">
  	  <label>User Role: </label>
          <input type="radio" name="user_role" <?php if (isset($user_role) && $user_role=="0") echo "checked";?> value="0" required="">Buyer
          <input type="radio" name="user_role" <?php if (isset($user_role) && $user_role=="1") echo "checked";?> value="1" required="">Seller
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  </form>
  	<?php include 'includes/footer.php' ?>;

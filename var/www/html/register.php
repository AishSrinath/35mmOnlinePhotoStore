<?php include('server.php') ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Registration</title>
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
<?php include_once("template_header.php"); ?>
<div align="center" id="mainWrapper">
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
        <div class="input-group">
  	  <label>First Name</label>
  	  <input type="text" name="firstname" value="<?php echo $firstname; ?>">
  	</div>
        <div class="input-group">
  	  <label>Last Name</label>
  	  <input type="text" name="lastname" value="<?php echo $lastname; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
        <div class="input-group">
  	  <label>Seller?</label>
          <input type="checkbox" name="user_role">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  	Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</div>
<?php include_once("template_footer.php"); ?>
</body>
</html>
<?php 
ob_start();
session_start(); 
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>About Us</title>
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
</head>
<body background="images/landscape/LS_1.jpg" size="cover">
<div align="center" id="mainWrapper">
     <?php 
    if(strlen($_SESSION['login_id']) <= 0)
    {
      
        include_once("template_header.php");
        }
        else{
           
        
    include_once("postlogin_header.php");
        }
    ?>
	
    <h1>About Us</h1>
<p>Welcome to 35mm Online Photostore, your number one source for online photo shopping. We're dedicated to giving you the very best of photographs taken by professionals under various categories, with a focus on dependability, customer service and uniqueness.</p>

<p>Our website is fast growing as we are passionate about what we do- photography and bet customer service.We enable people passionate about photography discover various photographs grouped under categories for their easy access. Our website provides user friendly UI for buyers and sellers so that they can enjoy shopping with ease. </p>

<p>We hope you enjoy our products as much as we enjoy offering them to you. If you have any questions or comments, please don't hesitate to contact us.</p>
	<?php include_once("template_footer.php"); ?>
</div>
</body>
</html>

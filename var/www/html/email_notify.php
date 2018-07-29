<?php require 'mail.php'; 
sendmail ('Aiswarya G','aiswarya.g2008@gmail.com','TEST-NOTIFY','TEST');
?>
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
<body>
<div align="center" id="mainWrapper">
      <?php 
    if(strlen($_SESSION['login_id']) <= 0)
    {
        //echo "User session <0 ...user not logged inxxxxxx";
        include_once("template_header.php");
        }
        
           if(($_SESSION['user_role']==0) && (strlen($_SESSION['login_id']) > 0))
               {
               //echo "User is buyer ...user logged in";
              include_once ("buyer_header.php"); 
               }
               
             if(($_SESSION['user_role']==1)&& (strlen($_SESSION['login_id']) > 0)){
                 //echo "User session >0 ...seller user logged in";
            
           include_once("postlogin_header.php");
             }
    
        
    ?>
    <form name="shipform" id="payform" action="paypalbutton.html" method="post"> 
 <input type="submit" name="paypal" value="Proceed to payment">
                    
       </form> 	
</body>
</html>
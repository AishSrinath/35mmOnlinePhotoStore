<?php require 'mail.php'; ?>
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
<style>

</style>
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
    </div>
    <div>
        <p style="font-size:20px;font-family:Algerian;color:orange;"><i><?php echo "Thank you for choosing 35mm ".$fetch['firstname']; ?></i></p>
        <p style="font-size:20px;font-family:Imprint MT Shadow;color:red;"><i><b>Please proceed to payment.An automated email notification has been sent to your registered email...</b></i></p>
         </div>  
     <form name="shipform" id="payform" action="paypalbutton.html" method="post"> 
         
 <input type="submit" name="paypal" class="btn" value="Proceed to payment">
                   
       </form> 
</div>
   	
</body>
</html>
<?php require 'mail.php'; 
sendmail ('Nandita Krishnamurthy','10378895@mydbs.ie','TEST-NOTIFY','TEST');
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
         <div class="input-group">
 <input type="submit" name="paypal" class="btn" value="Proceed to payment">
         </div>          
       </form> 
</div>
   	
</body>
</html>
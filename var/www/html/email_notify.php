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
/* Style the tab */
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
.responsive {
    width: 100%;
    max-width: 400px;
    height: auto;
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
   <div class="navbar">
        <a href="index.php">Home</a>
        <a href="about_us.php">About Us</a>
        <a href="discover.php">Discover</a>
        <div style="float: right;">
        <a href="#"><?php echo "Welcome  ".$fetch['firstname']; ?></a>
        <a href="logout.php">Logout</a>
        </div>  </div>
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
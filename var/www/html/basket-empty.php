<?php 
ob_start();
session_start();
include_once ("storescripts/connect_to_mysql.php");
if(!isset($_SESSION['login_id']))
{
    header("Location:login.php");
}
 $user_id      = $_SESSION['login_id']; 
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Product</title>
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
    
    
<div id="tbl_container_demo_grid1" class="table-responsive">
    <p><h1 style="color: red;">Your Shopping cart is empty</h1>

    <table width="500" border="0" cellpadding="5">

<tr>

<td align="center" valign="center">
<img src="images/cart.jpg" height="40" width="40"/>
<br />
<a href="discover.php" class="btn-grey btn-bas-contshopping"> Continue Shopping</a>
</td>
</tr>
</div>    
	<?php include_once("template_footer.php"); ?>
</div>
    </table>
</body>
</html>

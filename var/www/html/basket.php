<?php 
ob_start();
session_start();
include_once ("storescripts/connect_to_mysql.php");
if(!isset($_SESSION['login_id']))
{
    header("Location:login.php");
}
 $user_id      = $_SESSION['login_id']; 
 
 if (isset($_GET['action']) && $_GET['action']=="remove")
{
  $sql="delete from tbl_cart where cart_id=".$_GET['id'];
  mysqli_query($db_connect,$sql) or die(mysqli_error($db_connect));
 } 
 
 
 if (isset($_POST['submit1']))
{
  $nos=$_POST['cid'];
  foreach ($nos as $id)
   {
     $sql="update tbl_cart set cart_qty=".$_POST['pqty'.$id]." where cart_id=".$id." and cart_sessionid='".session_id()."'" ;
	// echo $sql;
     mysqli_query($db_connect,$sql);
  }
}

$sql_admin="select * from user where id='$user_id'";
$sql_admin_query=mysqli_query($db_connect, $sql_admin);
$fetch=  mysqli_fetch_assoc($sql_admin_query);
 
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Product</title>
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />

<script language="javascript1.5" type="text/javascript">
function submitform()
{
  var det=document.getElementsByName('cid[]');
  var l=det.length;	
  var flag=1;
  for (var i=0;i<l;i++)
  {
	var num=det[i].value;
	var imei=trimSpaces(document.getElementById("pqty"+num).value);
	if(imei=="" || imei<=0)
    {
	  flag=0;
	  break;
	}
   }
   if (flag==0)
   {
   		alert("Please enter valid quantity");
   		return false;
    }
	document.cartform.submit();
	return true;
}	
function onlyNumbers(evt)

{

var e = window.event || evt; // for trans-browser compatibility

var charCode = e.which || e.keyCode;

    if (charCode==46)

 return true; 

if (charCode > 31 && (charCode < 48 || charCode > 57))

return false;

return true;

}
 function trimSpaces(stringValue) {
	// Checks the first occurance of spaces and removes them
	for(i = 0; i < stringValue.length; i++) {
		if(stringValue.charAt(i) != " ") {
			break;
		}
	}
	if(i > 0) {
		stringValue = stringValue.substring(i);
	}
	// Checks the last occurance of spaces and removes them
	strLength = stringValue.length - 1;
	for(i = strLength; i >= 0; i--) {
		if(stringValue.charAt(i) != " ") {
			break;
		}
	}
	if(i < strLength) {
		stringValue = stringValue.substring(0, i + 1);
	}
	// Returns the string after removing leading and trailing spaces.
	return stringValue;
}


</script>

</head>

<body>    
    
<div align="center" id="mainWrapper">
	<div id="pageHeader"><table width="100%" border="0" cellspacing="0" cellpadding="12">
<a href="index.php"><img src="http://35.198.90.129/style/logo.jpg" width="75" height="60" alt="logo" align="left"/><br />
<p align="left"><i>For the artist in you</i></p><br />
<div class="navbar">
  <a href="index.php">Home</a>
  <a href="about_us.php">About Us</a>
  <a href="discover.php">Discover</a>
  <div style="float: right;">
  <a href="#"><?php echo "Welcome  ".$fetch['firstname']; ?></a>
  <a href="logout.php">Logout</a>
  </div>
</div>
  </tr>
  </tbody>
  </table>
</div>


    
<div align="center">
<h1 style="color:orange; font-family:Imprint MT Shadow;background-color:lightgrey;"><em><i>Products Added To The Cart</i></em></h1>
    </div>     
<div id="tbl_container_demo_grid1" class="table-responsive">
<form action="basket.php" method="post" name="cartform">
               <table cellpadding="0" cellspacing="55" class="basketTbl">
                    	<tr style="color: blue;">
                        <th>Qty</th>
                        <th>Item</th>
                        <th class="desc">Description</th>
                        <th>Price(€)</th>
                        <th>&nbsp;</th>
                         </tr>
                         <?php
						  $tot=0;
						  $items=0;
						  $sql="select * from tbl_cart where cart_sessionid='".session_id()."'";
						  $result=mysqli_query($db_connect,$sql);
						   if(mysqli_affected_rows($db_connect)) 
{
                                                       
							  while($row=mysqli_fetch_array($result))
							  {
							   if (strlen(trim($row['cart_pimage']))==0)
							   	$img="productimages/thumbimages/no_thumb.png";
							   else
							  	$img=$row['cart_pimage'];	
								
							?> 
                         <tr>
                        	<td><input  type="text" class="inputField"  id="pqty<?php echo $row['cart_id'] ?>" onkeypress="return onlyNumbers(event);" maxlength="3" name="pqty<?php echo $row['cart_id'] ?>" size="10" value="<?= $row['cart_qty'] ?>"/></td>
                            <td><img src="<?=$img?>" width="70px"  height="70px"/></td>
                            <td><?=$row['cart_pname']?></td>
                            <td><?php echo number_format($row['cart_qty']*$row['cart_price'],2)?></td>
                            <td>
                                <a  onclick="return confirm ('Are you sure?')" href="basket.php?action=remove&id=<?php echo $row['cart_id'] ?>"><img src="images/delete.png" height="10" width="10"/>  </a>                            </td>
                         </tr>
         				 <input type="hidden" value="<?php echo $row['cart_id'] ?>" name="cid[]">
					<?php
								  $tot=$tot+$row['cart_qty']*($row['cart_price']);
								  $items=$items+$row['cart_qty'];
							}
}
                                                        else {
                                                             header('location:basket-empty.php'); 
                                                        }
           
						  
						  ?>
                                    
                         <tr>
                         	<td colspan="5" class="basketItemEnd"></td>
                         </tr>
                         
                        
                        
                          
                          <tr class="basketRowHiglight">
                        	<td></td>
                            <td></td>
                            <td class="total">Total</td>
                            <td class="totalCost" width="120">€<span id="tot"> <?php echo number_format(($tot),2) ?> </span></td>
                            <td></td>
                         </tr>
                       </table>
           	<input  type="hidden"  name="submit1" value="" />
        </form>
    <div class="basketButtons">
        <table>
  <tr>
      <th><a href="discover.php" class="btn-grey btn-bas-contshopping">< Continue Shopping</a></th><td></td>
    <th> <a href="basket-summary.php" class="btn-purple btn-bas-checkout">Checkout</a></th><td></td>
    <th><a onclick="return submitform()" href="javascript:void(0)" class="btn-lightpurple btn-bas-checkout">Update Cart</a></th>
  </tr>
        </table>
    
    </div>
    
    
</div>    
	<?php include_once("template_footer.php"); ?>
</div>
</body>
</html>

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
	<?php include_once("template_header.php"); ?>
    
    
<div id="tbl_container_demo_grid1" class="table-responsive">
<form action="basket.php" method="post" name="cartform">
               <table cellpadding="0" cellspacing="0" class="basketTbl">
                    	<tr style="color: blue;">
                        	<th>Qty</th>
                            <th>Item</th>
                            <th class="desc">Description</th>
                            <th>Price</th>
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
                            <td><img src="./images/rsico_black.png" border="0" style="border:none;"  class="rsicoblack" /><?php echo number_format($row['cart_qty']*$row['cart_price'],2)?></td>
                            <td>
                            <a  onclick="return confirm ('Are you sure?')" href="basket.php?action=remove&id=<?php echo $row['cart_id'] ?>"><img src="images/basket-remove.gif" /> </a>                            </td>
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
                         
                          <tr>
                        	<td></td>
                            <td></td>
                            <td class="postage">Subtotal</td>
                            <td><img src="./images/rsico_black.png" border="0" style="border:none;"  class="rsicoblack" /><?php echo number_format($tot,2) ?></td>
                            <td></td>
                         </tr>
                        
                          
                          <tr class="basketRowHiglight">
                        	<td></td>
                            <td></td>
                            <td class="total">Total</td>
                            <td class="totalCost" width="120"><img src="./images/rsico_black.png" border="0" style="border:none;"  class="rsicoblack" /> <span id="tot"> <?php echo number_format(($tot),2) ?> </span></td>
                            <td></td>
                         </tr>
                       </table>
           	<input  type="hidden"  name="submit1" value="" />
        </form>  
</div>    
	<?php include_once("template_footer.php"); ?>
</div>
</body>
</html>
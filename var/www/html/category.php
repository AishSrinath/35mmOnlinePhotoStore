<?php 
ob_start();
session_start();
//echo $_SESSION['login_id'];
//exit;
if (!(isset($login) && $login == true)) {
    if (!isset($_SESSION['login_id']) || (isset($_SESSION['login_id']) && strlen($_SESSION['login_id']) <= 0)) {
      
        header("Location: login.php");
    }

    if (isset($_SESSION['EXPIRES']) && strlen($_SESSION['EXPIRES']) > 0 && $_SESSION['EXPIRES'] < time()) {
        $_SESSION['login_username'] = "";
        $_SESSION['login_id'] = "";
        $_SESSION['EXPIRES'] = "";
        
       header("Location:login.php?Exit=exp");
        exit;
    }
}
$_SESSION['EXPIRES'] = time() + 900; // 150 seconds (2.5 mins) 
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
<?php 

include_once ("template_header.php");
?>


 

<div class="input-group">
  	  <table>
						  <thead>
							  <tr style="color: blue;">
								  <th>Category Names</th>
                                                                  <th colspan="2"></th>
								  <th>Action</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?
						  	$sql="select * from category";
							$result_category=mysqli_query($db_connect,$sql)or die(mysql_error());
							while($row_category=mysqli_fetch_assoc($result_category))
							{
						  ?>
							<tr>
								<td><? echo $row_category['name']?></td>
                                                                <td colspan="2"></td>
								<td>
                                                                    <a  href="delete_category.php?id=<?=$row_category['id']?>" onclick="return confirm('Are you sure?')">
										 
										Delete
									</a>
								</td>
							</tr>
						<?
							}
						?>		
							
						  </tbody>
					  </table>
  	</div>
        
  	</div>    
	<?php include_once("template_footer.php"); ?>

</body>
</html>
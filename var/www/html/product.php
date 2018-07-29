<?php 
ob_start();
session_start();
//session_start();
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

include_once ("postlogin_header.php");
?>

  
        <div align="center">
<h1 style="color:red;"><em>Products Added By You For Sale</em></h1>
    </div>   
<div id="tbl_container_demo_grid1" class="table-responsive">
   <table id="tbl_demo_grid1" class="table table-bordered table-hover">
      <thead>
         <tr id="tbl_demo_grid1_tr_0" style="color: blue;">
             <th class="th-common">No</th>
            <th class="th-common">Product Name</th>
            <th class="th-common">Details</th>
            <th class="th-common">Category</th>
            <th class="th-common">Image</th>
            <th class="th-common">Date Added</th>
            <th class="th-common">Action</th>
         </tr>
      </thead>
      <tbody>
                     <?php
 $sqlcat = "SELECT * FROM products WHERE user_id='$user_id'";
 $res1= mysqli_query($db_connect,$sqlcat) or die("error");

            
              $i=0;
              while($row = mysqli_fetch_assoc($res1))
              {
                   $i++;
                 
  ?>
         <tr id="tbl_demo_grid1_tr_3" >
              <td><?php echo $i;?></td>
            <td><?php echo $row['product_name'];?></td>
            <td><?php echo $row['details'];?></td>
            <td><?php
             $sqlcat1 = "SELECT * FROM category WHERE id='".$row['category']."'";
$res= mysqli_query($db_connect,$sqlcat1) or die("error");
if(mysqli_affected_rows($db_connect)) 
{ 
              
              while($row1 = mysqli_fetch_assoc($res))
              {
                  $imagefold = $row1['name'];
              }
}
            
            echo $imagefold;?></td>
            <td><?php echo "<img src='{$row['image']}' alt={$row['product_name']} class='responsive' width='100' height='100'/>";?></td>
            <td><?php echo $row['date_added'];?></td>
            <td>
                                                                 <!--   <a  href="delete_product.php?id=<?=$row['id']?>" onclick="return confirm('Are you sure?')" style="color: red;"> 
										 
										Delete
									</a>-->
                  <a  href="delete_product.php?id=<?=$row['id']?>" onclick="return confirm('Are you sure?')" style="color: red;"> 
										 
										Delete
                  </a>
								</td>
         </tr>
         
              <?php } 
?>
        
         
      </tbody>
      <tbody></tbody>
   </table>
</div>    
	<?php include_once("template_footer.php"); ?>
</div>
</body>
</html>

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
<style>
form, .content {
  width: 60%;
  margin: 0px auto;
  padding: 20px;
  border: 1px solid #B0C4DE;
  background: black;
  border-radius: 0px 0px 10px 10px;
}
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    background-color:black;
}
.input-group {
  margin: 10px 0px 10px 0px;
}
.input-group label {
color: red;
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
</style>
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



<?php 
$msg = $_REQUEST['msg'];
if (isset($_POST['reg_product']))
{
$category      =  mysqli_real_escape_string($db_connect,$_REQUEST['category']);
 $product_name =  mysqli_real_escape_string($db_connect,$_REQUEST['product_name']);
 $details      =  mysqli_real_escape_string($db_connect,$_REQUEST['details']);
 $price        =  mysqli_real_escape_string($db_connect,$_REQUEST['price']);
$price_small   =  mysqli_real_escape_string($db_connect,$_REQUEST['price_small']);  
 $user_id      = $_SESSION['login_id']; 
 //
 $sqlcat1 = "SELECT * FROM category WHERE id='$category'";
 $res= mysqli_query($db_connect,$sqlcat1) or die("error");
if(mysqli_affected_rows($db_connect)) 
{ 
              
              while($row1 = mysqli_fetch_assoc($res))
              {
                  $imagefold = $row1['name'];
              }
}
 //
    if (!file_exists($imagefold)) {
    mkdir($imagefold, 0777, true);
}
//For upload image_large  
 $target_dir = "$imagefold/";
$target_file = $target_dir .mt_rand(100000, 999999).basename($_FILES["image_large"]["name"]);
$uploadOk1 = 1;
$image_largeFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image_large file is a actual image or fake image_large
    $check = getimagesize($_FILES["image_large"]["tmp_name"]);
    if($check !== false) {
        echo "I am in file size check.";
      // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk1 = 1;
        
    } else {
    echo "File is not an image.I am resetting $uploadOk1 to 0";
        $uploadOk1 = 0;
    }
    
// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.I am resetting $uploadOk1 to 0";
    $uploadOk1 = 0;
}
// Allow certain file formats
if($image_largeFileType != "jpg" && $image_largeFileType != "png" && $image_largeFileType != "jpeg"
&& $image_largeFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.I am resetting $uploadOk1 to 0";
    $uploadOk1 = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk1 == 0) {
   echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image_large"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["image_large"]["name"]). " has been uploaded.";
    } else {
     echo "Sorry, there was an error uploading your file.";
    }
}  
$image_large = $target_file;
$sql= "insert into products(category,product_name,details,price,user_id,status,date_added,price_small) values('$category','$product_name','$details','$price','$user_id','1',now(),'$price_small')";
mysqli_query($db_connect,$sql) or die(mysqli_error($db_connect));
//$sql= "insert into products(category,product_name,details,price,user_id,status,date_added) values('$category','$product_name','$details','$price','$user_id','1',now())";
//mysqli_query($db_connect,$sql) or mysqli_error($db_connect);
$product_id = mysqli_insert_id($db_connect); 
$sql1= "UPDATE  products SET image='$image_large' WHERE id='$product_id'";
mysqli_query($db_connect,$sql1) or die("error in update");
 header('location:addproduct.php?msg=1'); 
}
$msg= $_REQUEST['msg'];
?>
<form method="post" name="f1" action="addproduct.php"  enctype= "multipart/form-data">
<?php include('errors.php'); ?>
<?php if(!empty($msg)) {?>
<span style="color:red"><?php echo "Product added successfully!";?></span>
<?php }?>
<table>
<tr><td>
      <div class="input-group">
  	  <label>Select Category</label>
          <select name="category" required="required">
              <option value="">Select Category</option> 
              <?php
$sqlcat = "SELECT * FROM category ";
 $res= mysqli_query($db_connect,$sqlcat) or die("error");
          if(mysqli_affected_rows($db_connect)) 
{ 
              
              while($row = mysqli_fetch_assoc($res))
              {
  ?>
               <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option> 
               
              <?php } }?>
          </select>
  	</div></td></tr>
      <tr><td>
        <div class="input-group">
  	  <label>Product Name*</label>
          <input type="text" name="product_name" value="" required="required">
  	</div> 
    </td></tr>
    <tr><td>
        <div class="input-group">
  	  <label>Description*</label>
          <textarea name="details" rows="4" cols="50" required="required">
</textarea> 

  	</div> </td></tr>
    <tr><td>
  	
      <div class="input-group">
  	  <label> Upload from PC*</label>
          <input type="file" name="image_large" id="image"  required="required"/>
  	</div></td></tr>
      <tr><td>
      <div class="input-group">
  	  <label>Price in EUR For High Resolution*</label>
          <input type="number" name="price" value="" required="required" type="number" min="1" step="any">
  	</div></td></tr>
      
      <tr><td>
      <div class="input-group">
  	  <label>Price in EUR For Low Resolution*</label>
          <input type="number" name="price_small" value="" required="required" type="number" min="1" step="any">
  	</div></td></tr>
  	</table>

    <p>
  	<div class="input-group">
  	  <button class="btn"  type="submit" class="btn" name="reg_product">Add for sale</button>
  	</div></p>
  </form>
  	</div>    
<?php include_once("template_footer.php"); ?>
</body>
</html>

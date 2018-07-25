<?php
ob_start();
session_start();
if(!isset($_SESSION['login_id']))
{
    header("Location:login.php");
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Project</title>
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
include_once ("storescripts/connect_to_mysql.php");
include_once("template_header.php"); ?>
<?php 
$msg = $_REQUEST['msg'];
if (isset($_POST['reg_product']))
    {
    $category      =  mysqli_real_escape_string($db_connect,$_REQUEST['category']);
    $product_name =  mysqli_real_escape_string($db_connect,$_REQUEST['product_name']);
    $details      =  mysqli_real_escape_string($db_connect,$_REQUEST['details']);
    $price        =  mysqli_real_escape_string($db_connect,$_REQUEST['price']); 
    $price_small  =  mysqli_real_escape_string($db_connect,$_REQUEST['price_small']);
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
    $target_file = $target_dir . basename($_FILES["image_large"]["name"]);
$uploadOk = 1;
$image_largeFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image_large file is a actual image_large or fake image_large
$check = getimagesize($_FILES["image_large"]["tmp_name"]);
if($check !== false) {
    // echo "File is an image_large - " . $check["mime"] . ".";
    $uploadOk = 1;
    } else {
    //   echo "File is not an image_large.";
    $uploadOk = 0;
    }
// Check if file already exists
if (file_exists($target_file)) {
  //  echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Allow certain file formats
if($image_largeFileType != "jpg" && $image_largeFileType != "png" && $image_largeFileType != "jpeg"
&& $image_largeFileType != "gif" ) {
   // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
   $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image_large"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["image_large"]["name"]). " has been uploaded.";
    } else {
      //  echo "Sorry, there was an error uploading your file.";
    }
}  

$image_large = $_FILES["image_large"]["tmp_name"];
$sql= "insert into products(category,product_name,details,price,price_small,user_id,status) values('$category','$product_name','$details','$price','$price_small','$user_id','1')";
mysqli_query($db_connect,$sql) or die("error");
$product_id = mysqli_insert_id($db_connect); 

$sql1= "UPDATE  products SET image='$image_large' WHERE id='$product_id'";
mysqli_query($db_connect,$sql1) or die("error");
}
?>
<form method="post" name="f1" action="addproduct.php"  enctype= "multipart/form-data">
  	<?php include('errors.php'); ?>
      <?php if(!empty($msg)) {?>
      <span style="color:red"><?php echo "Username Already exist please choose another one";?></span>
      <?php }?>
      <div class="input-group">
  	  <label>Select Category</label>
          <select name="category">
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
  	</div>
      
        <div class="input-group">
  	  <label>Product Name</label>
          <input type="text" name="product_name" value="" >
  	</div>
        <div class="input-group">
  	  <label>Description</label>
          <textarea name="details" rows="4" cols="50">

</textarea> 
  	</div>
  	
      <div class="input-group">
  	  <label> Large Photo</label>
          <input type="file" name="image_large" id="image" />
  	</div>
      
      <div class="input-group">
  	  <label>Price Large Photo</label>
          <input type="text" name="price" value="" required="">
  	</div>
  	<div class="input-group">
  	  <label>Small Photo</label>
         <input type="file" name="image_small" id="image_small" />
  	</div>
      
      <div class="input-group">
  	  <label>Price Small Photo</label>
          <input type="text" name="price_small" value="" >
  	</div>

    
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_product">Add Product</button>
  	</div>
  </form>
  	<?php include 'includes/footer.php' ?>;
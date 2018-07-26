<?php 
ob_start();
session_start();
include_once ("storescripts/header.php");
$user_id      = $_SESSION['login_id']; 
$sql_admin="select * from user where id='$user_id'";
$sql_admin_query=mysqli_query($db_connect, $sql_admin);
$fetch=  mysqli_fetch_assoc($sql_admin_query);?>
<div class="navbar">
  <a href="index.php">Home</a>
  <a href="product.php">Product</a>
  <div style="float: right;">
  <a href="#"><?php echo "Welcome  ".$fetch['firstname']; ?></a>
  <a href="logout.php">Logout</a>
  </div>
      
    </div>

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
$target_file = $target_dir .mt_rand(100000, 999999).basename($_FILES["image_large"]["name"]);


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

$image_large = $target_file;



// for small image

$target_file1 = $target_dir .mt_rand(100000, 999999).basename($_FILES["image_small"]["name"]);


$uploadOk = 1;
$image_largeFileType = strtolower(pathinfo($target_file1,PATHINFO_EXTENSION));
// Check if image_large file is a actual image_large or fake image_large

    $check = getimagesize($_FILES["image_small"]["tmp_name"]);
    if($check !== false) {
       // echo "File is an image_large - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
     //   echo "File is not an image_large.";
        $uploadOk = 0;
    }
    

// Check if file already exists
if (file_exists($target_file1)) {
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
    if (move_uploaded_file($_FILES["image_small"]["tmp_name"], $target_file1)) {
        //echo "The file ". basename( $_FILES["image_large"]["name"]). " has been uploaded.";
    } else {
      //  echo "Sorry, there was an error uploading your file.";
    }
}  

$image_small = $target_file1;


$sql= "insert into products(category,product_name,details,price,price_small,user_id,status,date_added) values('$category','$product_name','$details','$price','$price_small','$user_id','1',now())";
mysqli_query($db_connect,$sql) or die("error");
$product_id = mysqli_insert_id($db_connect); 

$sql1= "UPDATE  products SET image='$image_large',image_small='$image_small' WHERE id='$product_id'";
mysqli_query($db_connect,$sql1) or die("error");
 header('location:addproduct.php?msg=1'); 
}

$msg= $_REQUEST['msg'];
?>
<form method="post" name="f1" action="addproduct.php"  enctype= "multipart/form-data">
  	<?php include('errors.php'); ?>
      <?php if(!empty($msg)) {?>
      <span style="color:red"><?php echo "Product added successfully!";?></span>
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
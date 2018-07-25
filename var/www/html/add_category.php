<?php 
include_once ("storescripts/header.php");?>
<div class="navbar">
  <a href="index.php">Home</a>
  <a href="category.php">Category</a>
  
      
    </div>

<?php 
 

if (isset($_POST['add']))
{
$category_name=  mysqli_real_escape_string($db_connect,$_REQUEST['category_name']);
$sql="insert into category(name) values('$category_name')";
mysqli_query($db_connect,$sql);
 header('location:category.php');
}
?>

  <form method="post" action="">
  	
  	
        <div class="input-group">
  	  <label>Category Name</label>
          <input type="text" name="category_name" required="">
  	</div>
        
  	<div class="input-group">
  	  <button type="submit" class="btn" name="add">ADD</button>
  	</div>
  </form>
  	<?php include 'includes/footer.php' ?>;
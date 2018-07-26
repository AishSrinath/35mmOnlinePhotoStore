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
  <a href="addproduct.php">Add Product</a>
 
  <div style="float: right;">
  <a href="#"><?php echo "Welcome  ".$fetch['firstname']; ?></a>
  <a href="logout.php">Logout</a>
  </div>
      
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
            <td><?php echo "<img src='{$row['image_small']}' alt={$row['product_name']} class='responsive' width='100' height='100'/>";?></td>
            <td><?php echo $row['date_added'];?></td>
            <td>
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

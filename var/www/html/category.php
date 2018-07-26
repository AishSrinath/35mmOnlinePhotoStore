<?php 
ob_start();
session_start();
include_once ("storescripts/header.php");
$id=$_SESSION['login_id'];
$sql_admin="select * from admin where id='$id'";
$sql_admin_query=mysqli_query($db_connect, $sql_admin);
$fetch=  mysqli_fetch_assoc($sql_admin_query);
?>
<div class="navbar">
  <a href="index.php">Home</a>
  <a href="add_category.php">Add Category</a>
  <div style="float: right;">
  <a href="#"><?php echo "Welcome  ".$fetch['firstname']; ?></a>
  <a href="logout.php">Logout</a>
  </div>
      
    </div>
 

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
        
  	<?php include 'includes/footer.php' ?>;
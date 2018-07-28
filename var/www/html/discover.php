<?php
ob_start();
session_start();
include_once ("storescripts/connect_to_mysql.php");
require 'functions.php';
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>About Us</title>
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
<style>
/* Style the tab */
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
.responsive {
    width: 100%;
    max-width: 400px;
    height: auto;
}

</style>
</head>
<body>
<div align="center" id="mainWrapper">
  
    <?php 
    if(strlen($_SESSION['login_id']) <= 0)
    {
        //echo "User session <0 ...user not logged inxxxxxx";
        include_once("template_header.php");
        }
        
           if(($_SESSION['user_role']==0) && (strlen($_SESSION['login_id']) > 0))
               {
               //echo "User is buyer ...user logged in";
              include_once ("buyer_header.php"); 
               }
               
             if(($_SESSION['user_role']==1)&& (strlen($_SESSION['login_id']) > 0)){
                 //echo "User session >0 ...seller user logged in";
            
           include_once("postlogin_header.php");
             }
    
        
    ?>
    <div class="tab">
                      <?php
$sqlcat = "SELECT * FROM category ";
 $res= mysqli_query($db_connect,$sqlcat) or die("error");
          if(mysqli_affected_rows($db_connect)) 
{ 
              
              while($row = mysqli_fetch_assoc($res))
              {
                  
              $cat_name=    $row['name'];
  ?>
    <button class="tablinks" onclick="openCat(event, '<?php echo $cat_name;?>')"><?php echo $cat_name;?></button>
    <?php } }?>
    </div>
                         <?php
$sqlcat = "SELECT * FROM category ";
 $res= mysqli_query($db_connect,$sqlcat) or die("error");
          if(mysqli_affected_rows($db_connect))
          {              
              while($rowproduct = mysqli_fetch_assoc($res))
              {                  
              $cat_name=    $rowproduct['name'];
               $cat_id=    $rowproduct['id'];
              
              
  ?> 
    
    <div id="<?php echo $cat_name;?>" class="tabcontent">
        <form name="productform" method="post" onsub	mit="" action="addcart.php"> 
    <table>
        
    <?php
    $i=0;
    $product = "SELECT * FROM products where category='$cat_id'";
    $result_product = mysqli_query($db_connect,$product);
    while($row = mysqli_fetch_assoc($result_product)) {
        if($i%3 == 0) {
            echo "<tr>";
        }
          echo"<td><img src='{$row['image']}' alt={$row['image_title']} class='responsive' width='600' height='400'<br>Product Name:{$row['product_name']}<br>Low Resolution Price:{$row['price']}<br>High Resolution Price:{$row['price']} <br>select product type: <select name='image_type'><option value='large'>High Resolution</option><option value='small'>Small Resolution</option></select><br><button type='submit' name='buy'>Buy Now</button> </td>";
        if($i%3 == 2) {
            echo "</tr>";
        }
        $i++; 
        
        ?>
         <?php 
         $row_lowresolution=$row['price'];
         
    ?>
        
        <input type="hidden" name="pname" value="<?php echo $row['product_name'] ?>" />
        <input type="hidden" name="pid" value="<?php echo $row['id'] ?>" />
        <input type="hidden" name="price_large" value="<?php echo $row['price'] ?>" />
        <input type="hidden" name="price_small" value="<?php echo $row['price'] ?>" />
        <input type="hidden" name="category" value="<?php echo $row['category'] ?>" />
        <input type="hidden" name="pqty" value="1" />
        
   <?php }
    ?>
        
        
    </table>
      </form>           

    </div>
        <?php } }?>
    
<script>
function openCat(evt, catName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(catName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>
    <?php include_once("template_footer.php"); ?>
</div>
</body>
</html>

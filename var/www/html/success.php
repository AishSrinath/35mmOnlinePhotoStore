<?php
include_once ("storescripts/connect_to_mysql.php");
//return to uRL


$st = $_REQUEST['st'];

if($st=="Completed")
{
    $status = 1;
  //Transaction completed  
}
 else {
      $status = 0;
    //transaction failde
}
    

?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<input type="submit" value="" />
<title>paypal</title>
</head>
<body>    
<?php

if($status==1)
{
    echo "Payment was successfull!";
}
 else {
    echo "Payment failed please try again!";
    ?>
    <p><a href="basket.php">Continue Shopping </a></p>
    <?php

 }


?>

</body>
</html>

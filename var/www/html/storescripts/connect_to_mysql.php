<?php  
$db_host = "localhost"; 
$db_username = "builder";  
$db_pass = "builder";  
$db_name = "php_webstore"; 
$db_connect = mysqli_connect("$db_host","$db_username","$db_pass","$db_name");

if (mysqli_connect_errno())
{
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
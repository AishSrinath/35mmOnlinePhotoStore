<?php
session_start();
unset($_SESSION['login_username']);
session_unset(); 
session_destroy();
header("Location: login.php");
exit;
?>

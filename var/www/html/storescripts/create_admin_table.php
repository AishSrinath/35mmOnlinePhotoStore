<?php
require "connect_to_mysql.php";

$sqlcmd = "CREATE TABLE admin (
        id INT(11) NOT NULL AUTO_INCREMENT, 
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        firstname VARCHAR(255) NOT NULL,
        lastname VARCHAR(255) NOT NULL,
        email VARCHAR(50),
        PRIMARY KEY (id),
        UNIQUE KEY username (username)
        )";

if (mysqli_query($db_connect,$sqlcmd)){
        echo "Admin table created.. yada yada yada";
} else {
        echo "Scripts needs to be in ICU";
}

?>

<?php
require "connect_to_mysql.php";

$sqlcmd = "CREATE TABLE user (
        id INT(11) NOT NULL AUTO_INCREMENT,
        user_role VARCHAR(255) NOT NULL,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        firstname VARCHAR(255) NOT NULL,
        lastname VARCHAR(255) NOT NULL,
        email VARCHAR(50),
        PRIMARY KEY (id),
        UNIQUE KEY username (username)
        )";

if (mysqli_query($db_connect,$sqlcmd)){
        echo "User table created.. yada yada yada";
} else {
        echo "Scripts needs to be in ICU";
}

?>

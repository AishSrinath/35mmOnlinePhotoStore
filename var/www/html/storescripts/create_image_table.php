<?php
require "connect_to_mysql.php";

$sqlcmd = "CREATE TABLE image (
        image_id INT(11) NOT NULL AUTO_INCREMENT, 
        image_username VARCHAR(255) NOT NULL,
        image_name VARCHAR(255) NOT NULL,
        image_category VARCHAR(255) NOT NULL,
        image_title VARCHAR(255) NOT NULL,
        PRIMARY KEY (image_id),
        UNIQUE KEY image_name (image_name)
        )";

if (mysqli_query($db_connect,$sqlcmd)){
        echo "Image table created.. yada yada yada";
} else {
        echo "Scripts needs to be in ICU";
}

?>

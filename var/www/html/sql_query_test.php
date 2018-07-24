<?php
require "storescripts/connect_to_mysql.php";
$conn = mysqli_connect($db_host, $db_username, $db_pass, $db_name);

$sql = "SELECT id, firstname, lastname FROM user";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>

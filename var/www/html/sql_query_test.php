<?php
require 'functions.php';
$sql = get_user('1','aditi','password');
echo $sql;
if (mysqli_num_rows($sql) > 0) {
    while($row = mysqli_fetch_assoc($sql)) {
        echo "id: " . $row["id"]. " - Name: " . $row["username"]. " " . $row["password"]. "<br>";
    }
} else {
    echo "0 results";
}
?>


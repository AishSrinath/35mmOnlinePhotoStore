<?php
function inser_user($user_role,$username,$password,$firstname,$lastname,$email) {
require 'storescripts/connect_to_mysql.php';
$password_md5 = md5($password);
$sql = "INSERT INTO user (user_role, username, password, firstname, lastname, email) VALUES ('$user_role', '$username', '$password_md5', '$firstname', '$lastname', '$email')";
if (mysqli_query($db_connect, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($db_connect);
}
mysqli_close($db_connect);
};
?>

<?php inser_user('1','aditi','password','Aditi','Srinath','aditi@gmail.com') ?>


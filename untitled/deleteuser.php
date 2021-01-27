<?php
require('dbconnect.php');
$id=$_REQUEST['id'];
$query = "DELETE FROM users WHERE id=$id";
$result = mysqli_query($connection,$query) or die ( mysqli_error());
$query2="DELETE FROM users_roles WHERE users_id=$id";
$result2 = mysqli_query($connection,$query2) or die ( mysqli_error());
header("Location: adminprofile.php");
?>
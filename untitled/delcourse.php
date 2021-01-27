<?php
require('dbconnect.php');
$id=$_REQUEST['id'];


$query2 = "DELETE FROM course WHERE id=$id";
$result2 = mysqli_query($connection,$query2) or die ( mysqli_error());
$query3="DELETE FROM course_student WHERE course_id=$id";
$result3 = mysqli_query($connection,$query3) or die ( mysqli_error());
header("Location: profile.php");
?>
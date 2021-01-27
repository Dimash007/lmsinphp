<?php
require('dbconnect.php');
$id=$_REQUEST['id'];
$query = "DELETE FROM course_student WHERE id=$id";
$result = mysqli_query($connection,$query) or die ( mysqli_error());
header("Location: mycourses.php");
?>
<?php
session_start();
require('dbconnect.php');
$courseid=$_REQUEST['id'];
$studentid=$_SESSION['id'];

$courseid=stripcslashes($courseid);
$studentid=stripcslashes($studentid);
$courseid=$connection->real_escape_string($courseid);
$studentid=$connection->real_escape_string($studentid);


$q="SELECT *FROM course_student WHERE users_id='$studentid' AND course_id='$courseid'";
$r=mysqli_query($connection, $q);
$row=$r->fetch_assoc();
if($row['users_id']!=$studentid && $row['course_id']!=$courseid) {
    $query = "INSERT INTO course_student (users_id, course_id) VALUES('$studentid', '$courseid')";
    $res = mysqli_query($connection, $query);
    header("Location: allcourses.php");
}else{
    header("Location: allcourses.php");
}
?>
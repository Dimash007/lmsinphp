<?php
session_start();
if($_SESSION['role']=='1'){
    include('adminprofile.php');
}
elseif ($_SESSION['role']=='2'){
    include('teacherprofile.php');
}
elseif ($_SESSION['role']=='3'){
    include('userprofile.php');
}
?>

<?php
require('dbconnect.php');
$courseid=$_REQUEST['id'];
$query="SELECT *FROM course WHERE id='$courseid'";
$r=mysqli_query($connection, $query);
$row=$r->fetch_assoc();
$id=$row['teacher_id'];
$query2="SELECT *FROM users WHERE id='$id'";
$r2=mysqli_query($connection, $query2);
$row2=$r2->fetch_assoc();
?>
<div style="margin-left: 4%;margin-top: 2%;margin-bottom: 10%">
    <h2><b>Name:</b> <i><?php echo $row['name'];?></i></h2>
    <h2><b>Credits:</b> <i><?php echo $row['credits'];?></i></h2>
    <h2><b>Price:</b> <i><?php echo $row['price'];?></i></h2>
    <h2><b>Duration:</b> <i><?php echo $row['duration'];?></i></h2>
    <h2><b>Description:</b> <i><?php echo $row['description'];?></i></h2>
    <h2><b>Teacher:</b> <i><?php echo $row2['name']." ".$row2['surname'];?></i></h2>
</div>
<?=include ("footer.php");?>
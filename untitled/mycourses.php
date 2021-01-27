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
require ("dbconnect.php");
?>

<h2 style="color: #b48608;
           font-family: 'Droid serif', serif;
           font-size: 36px;
           font-weight: 400;
           font-style: italic;
           line-height: 44px;
           margin: 2% 2% 12px;
           text-align: center;">My Courses</h2>
<table class="table table-striped"
       style="width: 96%;
            margin-left: 2%;
            margin-bottom: 10%;
            text-align: center;
            border-collapse: collapse;
            border-radius: 15px;
            overflow: hidden;
            -webkit-box-shadow: 10px 10px 56px -8px rgba(0,0,0,0.75);
            -moz-box-shadow: 10px 10px 56px -8px rgba(0,0,0,0.75);
            box-shadow: 10px 10px 56px -8px rgba(0,0,0,0.75);">
    <thead style="color:white; background-color: #6c7ae0;">
    <tr >
        <th scope="col">#id</th>
        <th scope="col">Name</th>
        <th scope="col">Credits</th>
        <th scope="col">Price</th>
        <th scope="col">Duration</th>
        <th scope="col">Teacher</th>
        <th scope="col">Delete</th>
        <th scope="col">Read More</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $count=1;
    $myid=$_SESSION['id'];

    $myid=stripcslashes($myid);
    $myid=$connection->real_escape_string($myid);

    $sel_query="SELECT * FROM course_student WHERE users_id='$myid'";
    $result = mysqli_query($connection,$sel_query);
    while($row = mysqli_fetch_assoc($result)) {
        $id=$row['course_id'];
        $sel_query3="SELECT * FROM course WHERE id='$id'";
        $result3=mysqli_query($connection,$sel_query3);
        $row2 = mysqli_fetch_assoc($result3);
        $id2=$row2['teacher_id'];
        $qu="SELECT * FROM users WHERE id='$id2'";
        $result4=mysqli_query($connection,$qu);
        $row3 = mysqli_fetch_assoc($result4);
        ?>
        <tr><td ><?php echo $row2["id"]; ?></td>
            <td ><?php echo $row2["name"]; ?></td>
            <td ><?php echo $row2["credits"]; ?></td>
            <td ><?php echo $row2["price"]; ?></td>
            <td ><?php echo $row2["duration"]; ?></td>
            <td ><?php echo $row3["name"]." ".$row3["surname"]; ?></td>
            <td >
                <a href="delusercourse.php?id=<?php echo $row["id"]; ?>">Delete</a>
            </td>
            <td >
                <a href="readmore.php?id=<?php echo $row2["id"]; ?>">Read More</a>
            </td>
        </tr>
        <?php $count++; } ?>
    </tbody>
</table>
<?=include ("footer.php");?>
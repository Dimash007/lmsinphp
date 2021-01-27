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
           text-align: center;">All Courses</h2>
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
            <?php
            if($_SESSION['role']=='3'){
                ?>
                <th scope="col">+Add</th>
            <?php }?>
            <?php
            if($_SESSION['role']=='1'){
                ?>
                <th scope="col">Edit</th>
            <?php }?>
            <?php
            if($_SESSION['role']=='1'){
                ?>
                <th scope="col">Delete</th>
            <?php }?>

            <th scope="col">Read More</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count=1;
        $sel_query="SELECT * FROM course  ORDER BY id";
        $result = mysqli_query($connection,$sel_query);
        while($row = mysqli_fetch_assoc($result)) {
            $id=$row['teacher_id'];
            $sel_query3="SELECT * FROM users WHERE id='$id'";
            $result3=mysqli_query($connection,$sel_query3);
            $row2 = mysqli_fetch_assoc($result3)?>
            <tr><td scope="row"><?php echo $row["id"]; ?></td>
                <td ><?php echo $row["name"]; ?></td>
                <td ><?php echo $row["credits"]; ?></td>
                <td ><?php echo $row["price"]; ?></td>
                <td ><?php echo $row["duration"]; ?></td>
                <td ><?php echo $row2["name"]." ".$row2["surname"]; ?></td>
                <?php
                if($_SESSION['role']=='3'){
                    ?>
                    <td >
                        <a href="enroll.php?id=<?php echo $row["id"]; ?>">+Add</a>
                    </td>
                    <?php
                }
                ?>
                <?php
                if($_SESSION['role']=='1'){
                    ?>
                    <td >
                        <a href="editcourse.php?id=<?php echo $row["id"]; ?>">Edit</a>
                    </td>
                    <?php
                }
                ?>
                <?php
                if($_SESSION['role']=='1'){
                    ?>
                    <td >
                        <a href="delcourse.php?id=<?php echo $row["id"]; ?>">Delete</a>
                    </td>
                    <?php
                }
                ?>
                <td >
                    <a href="readmore.php?id=<?php echo $row["id"]; ?>">Read More</a>
                </td>
            </tr>
            <?php $count++; } ?>
    </tbody>
</table>

<?=include ("footer.php");?>
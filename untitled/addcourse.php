<link rel="stylesheet" href="style.css" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
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
if(isset($_POST['addcourse'])) {
    $name = $_POST['coursename'];
    $credit = (int)$_POST['credits'];
    $price = (int)$_POST['price'];
    $duration = $_POST['duration'];
    $description = $_POST['description'];
    if ($name !="" && $credit!=0 && $price!=0 && $duration!="" && $description!="") {
        if ($_SESSION['role'] == '2') {
            $id=$_SESSION['id'];
            $query3 = "INSERT INTO course(name,credits,price,duration,description,teacher_id) VALUES ('$name', '$credit','$price','$duration', '$description','$id')";
            $result = mysqli_query($connection, $query3);
            if ($result) {
                $success = "Add Course was successful!";
            } else {
                $error = "Add Course not compeleted...1st";
            }
        }
        else{
            $teacher=$_POST['teacher'];
            $query3 = "INSERT INTO course(name,credits,price,duration,description,teacher_id) VALUES ('$name', '$credit','$price','$duration', '$description','$teacher')";
            $result = mysqli_query($connection, $query3);
            if ($result) {
                $success = "Add Course was successful!";
            } else {
                $error = "Add Course not compeleted...1st";
            }
        }
    }
    else{
        $error="Add Course not compeleted...2nd";
    }
}
?>

<div class="form-style-8">
    <h2>Add Course to System</h2>
    <form method="post">
        <?php if(isset($success)){ ?><div class="alert alert-success" role="alert"><?php echo $success?></div><?php } ?>
        <?php if(isset($error)){ ?><div class="alert alert-danger" role="alert"><?php echo $error?></div><?php } ?>
        <input type="text" name="coursename" placeholder="Enter Course Name" />
        <input type="number" name="credits" placeholder="Enter Course Credits" />
        <input type="number" name="price" placeholder="Enter Price" />
        <input type="text" name="duration" placeholder="Duration(in weeks)" />
        <input type="text" name="description" placeholder="Course Description" />
        <?php
        if($_SESSION['role']=='1'){
            ?>
            <select name="teacher" class="form-control">
                <?php
                $query = "SELECT * from users_roles where roles_id='".'2'."'";
                $result = mysqli_query($connection, $query) or die ( mysqli_error());
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['users_id'];
                    $sel_query3 = "SELECT * FROM users WHERE id='$id'";
                    $result3 = mysqli_query($connection, $sel_query3);
                    $row2 = mysqli_fetch_array($result3);
                    echo "<option value='" . $row2['id'] . "'>'" . $row2['name']." ".$row2['surname'] . "'</option>";
                }
                ?>
            </select>
            <?php
        }
        ?>
        <button name="addcourse">Add Course</button>
    </form>
</div>
<?=include ("footer.php");?>

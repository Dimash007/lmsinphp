<link rel="stylesheet" href="style.css" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
<?php
session_start();
$id=$_REQUEST['id'];
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
if(isset($_POST['editcourse'])) {
    $name = $_POST['coursename'];
    $credit = (int)$_POST['credits'];
    $price = (int)$_POST['price'];
    $duration = $_POST['duration'];
    $description = $_POST['description'];
    if ($name !="" && $credit!=0 && $price!=0 && $duration!="" && $description!="") {
        if ($_SESSION['role'] == '2') {
            $tid=$_SESSION['id'];
            $update="update course set name='".$name."',
credits='".$credit."', price='".$price."',
duration='".$duration."', description='".$description."',teacher_id='".$tid."' where id='".$id."'";

            $result = mysqli_query($connection, $update);
            if ($result) {
                $success = "Edit Course was successful!";
            } else {
                $error = "Edit Course not compeleted...1st";
            }
        }
        else{
            $teacher=$_POST['teacher'];
            $update="update course set name='".$name."',
credits='".$credit."', price='".$price."',
duration='".$duration."', description='".$description."',teacher_id='".$teacher."' where id='".$id."'";
            $result = mysqli_query($connection, $update);
            if ($result) {
                $success = "Edit Course was successful!";
            } else {
                $error = "Edit Course not compeleted...1st";
            }
        }
    }
    else{
        $error="Edit Course not compeleted...2nd";
    }
}
?>

<div class="form-style-8">
    <h2>Edit Course</h2>
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
        <button name="editcourse">Edit Course</button>
    </form>
</div>
<?=include ("footer.php");?>

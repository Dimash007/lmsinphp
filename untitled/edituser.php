<link rel="stylesheet" href="style.css" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
<?= include('adminprofile.php'); ?>
<?php
require('dbconnect.php');
$id=$_REQUEST['id'];
$query = "SELECT * from users where id='".$id."'";
$result = mysqli_query($connection, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);
?>

<?php
require ("dbconnect.php");
if(isset($_POST['edit'])) {
    $f = $_POST['fname'];
    $s = $_POST['sname'];
    $email = $_POST['email'];
    $p1 = $_POST['p1'];
    $p2 = $_POST['p2'];
    $r=$_POST['role'];

    if ($p1 == $p2 && $f!="" && $s!="") {
        $update="update users set name='".$f."',
surname='".$s."', email='".$email."',
password='".$p1."' where id='".$id."'";
        $result=mysqli_query($connection,$update);
        if($result) {

            $query = "update users_roles set users_id='".$id."', roles_id='".$r."' where users_id='".$id."'";
            $res = mysqli_query($connection, $query);
            if($res){
                  $success = "Edit was successful!";
        }else{
                $error="Edit not compeleted...";
            }
        }
        else{
            $error="Edit not compeleted...";
        }
    }
    else{
        $error="Edit  not compeleted...";
    }
}
?>
<div class="form-style-8">
    <h2>Edit User</h2>
    <form method="post">
        <?php if(isset($success)){ ?><div class="alert alert-success" role="alert"><?php echo $success?></div><?php } ?>
        <?php if(isset($error)){ ?><div class="alert alert-danger" role="alert"><?php echo $error?></div><?php } ?>
        <input type="text" name="fname" placeholder="Enter New First Name" />
        <input type="text" name="sname" placeholder="Enter New Second Name" />
        <input type="email" name="email" placeholder="Enter New Email" />
        <input type="password" name="p1" placeholder="Enter New Password" />
        <input type="password" name="p2" placeholder="Confirm New Password" />
        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="role">
            <option selected>Roles...</option>
            <option value="3">Student</option>
            <option value="2">Teacher</option>
        </select>
        <button name="edit">Edit User</button>
    </form>
</div>

<?=include ("footer.php");?>
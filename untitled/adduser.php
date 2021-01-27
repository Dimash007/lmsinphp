<link rel="stylesheet" href="style.css" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
<?= include('adminprofile.php'); ?>
<?php
require ("dbconnect.php");
if(isset($_POST['registration2'])) {
    $f = $_POST['fname'];
    $s = $_POST['sname'];
    $email = $_POST['email'];
    $p1 = $_POST['p1'];
    $p2 = $_POST['p2'];
    $r=$_POST['role'];
    if ($p1 == $p2 && $f!="" && $s!="") {
        $query="INSERT INTO users (name,surname,email,password) VALUES ('$f', '$s','$email', '$p1')";
        $result=mysqli_query($connection,$query);
        if($result) {
            $user_id = mysqli_insert_id($connection);
            $query = "INSERT INTO users_roles (users_id, roles_id) VALUES('$user_id', '$r');";
            $res = mysqli_query($connection, $query);
            if ($res) {
                $success = "The Sign Up was successful and you can move Sign In page!";
            }
            else{
                $error="The Sign Up not compeleted...";
            }
        }
        else{
            $error="Add User not compeleted...";
        }
    }
    else{
        $error="Add User not compeleted...";
    }
}
?>
    <div class="form-style-8">
        <h2>Add User to System</h2>
        <form method="post">
            <?php if(isset($success)){ ?><div class="alert alert-success" role="alert"><?php echo $success?></div><?php } ?>
            <?php if(isset($error)){ ?><div class="alert alert-danger" role="alert"><?php echo $error?></div><?php } ?>
            <input type="text" name="fname" placeholder="Enter First Name" />
            <input type="text" name="sname" placeholder="Enter Second Name" />
            <input type="email" name="email" placeholder="Enter Email" />
            <input type="password" name="p1" placeholder="Enter Password" />
            <input type="password" name="p2" placeholder="Confirm Password" />
            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="role">
                <option selected>Roles...</option>
                <option value="3">Student</option>
                <option value="2">Teacher</option>
            </select>
            <button name="registration2">Add User</button>
        </form>
    </div>
<?=include ("footer.php");?>
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
if(isset($_POST['update'])) {
    $f = $_POST['fname'];
    $s = $_POST['sname'];
    $email = $_POST['email'];
    $p1 = $_POST['old'];
    $p2 = $_POST['nw'];
    $p3= $_POST['cnw'];
    $pass=$_SESSION['pass'];
    if ($p1 == $pass && $f!="" && $s!="" && $p2==$p3){
        $update="update users set name='".$f."',
surname='".$s."', email='".$email."',
password='".$p3."' where id='".$_SESSION['id']."'";
        $result=mysqli_query($connection,$update);
        if($result) {
            $success = "The process Update was successful!";
        }
        else{
            $error="The process Update not compeleted...";
        }
    }
    else{
        $error="The process Update not compeleted...";
    }
}
?>
    <div class="form-style-8">
        <h2>Update Personal Data</h2>
        <form method="post">
            <?php if(isset($success)){ ?><div class="alert alert-success" role="alert"><?php echo $success?></div><?php } ?>
            <?php if(isset($error)){ ?><div class="alert alert-danger" role="alert"><?php echo $error?></div><?php } ?>
            <input type="text" name="fname" placeholder="Enter New First Name" />
            <input type="text" name="sname" placeholder="Enter New Second Name" />
            <input type="email" name="email" placeholder="Enter New Email" />
            <input type="password" name="old" placeholder="Old Password" />
            <input type="password" name="nw" placeholder="New Password" />
            <input type="password" name="cnw" placeholder="Confirm Password" />
            <button name="update">Update Data</button>
        </form>
    </div>
<?=include ("footer.php");?>
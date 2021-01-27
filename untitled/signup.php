<?= include('header.php'); ?>
<?php
require ("dbconnect.php");
if(isset($_POST['registration'])) {
    $f = $_POST['fname'];
    $s = $_POST['sname'];
    $email = $_POST['email'];
    $p1 = $_POST['p1'];
    $p2 = $_POST['p2'];
    if ($p1 == $p2 && $f!="" && $s!="") {
        $query="INSERT INTO users (name,surname,email,password) VALUES ('$f', '$s','$email', '$p1')";
        $result=mysqli_query($connection,$query);
        if($result) {
            $user_id = mysqli_insert_id($connection);
            $query = "INSERT INTO users_roles (users_id, roles_id) VALUES('$user_id', '3');";
            $res = mysqli_query($connection, $query);
            if ($res) {
                $success = "The Sign Up was successful and you can move Sign In page!";
            }
            else{
                $error="The Sign Up not compeleted...";
            }
        }
        else{
            $error="The Sign Up not compeleted...";
        }
    }
    else{
        $error="The Sign Up not compeleted...";
    }
}
?>
<form method="post" style="margin: 2% 30% 10% ;">
    <?php if(isset($success)){ ?><div class="alert alert-success" role="alert"><?php echo $success?></div><?php } ?>
    <?php if(isset($error)){ ?><div class="alert alert-danger" role="alert"><?php echo $error?></div><?php } ?>
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" name="fname"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter First Name">

    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Surname</label>
        <input type="text" name="sname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Second Name">

    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">

    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name="p1"  class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Confirm Password</label>
        <input type="password" name="p2" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password">
    </div>
    <div style="text-align: center">
    <button class="btn btn-primary" name="registration">Sign Up</button>
    </div>
</form>

<?= include('footer.php'); ?>
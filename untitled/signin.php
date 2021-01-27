<?= include('header.php'); ?>
<?php
require ("dbconnect.php");
session_start();
if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $p1 = $_POST['p1'];
    $email=stripcslashes($email);
    $p1=stripcslashes($p1);
    $email=$connection->real_escape_string($email);
    $p1=$connection->real_escape_string($p1);
    if ($email != "" and $p1 != "") {
        $res=$connection->query("select *from users where email='$email' and password='$p1'")
        or die("Failed database ".mysqli_error());
        $row=$res->fetch_assoc();

        $id=$row['id'];
        $id=stripcslashes($id);
        $id=$connection->real_escape_string($id);

        $res2=$connection->query("select *from users_roles where users_id='$id'")
        or die("Failed database ".mysqli_error());
        $row2=$res2->fetch_assoc();

        if ($row['email'] == $email and $row['password'] == $p1) {
            if($row2['roles_id']=='1'){
                $_SESSION['name'] = $row['name'];
                $_SESSION["surname"] = $row['surname'];
                $_SESSION["role"]='1';
                $_SESSION["id"] = $row['id'];
                $_SESSION["email"] = $row['email'];
                $_SESSION["pass"]=$p1;
                header("location: profile.php");
            }else if($row2['roles_id']=='2'){
                session_start();
                $_SESSION["name"] = $row['name'];
                $_SESSION["surname"] = $row['surname'];
                $_SESSION["role"]='2';
                $_SESSION["id"] = $row['id'];
                $_SESSION["email"] = $row['email'];
                $_SESSION["pass"]=$p1;
                header("location: profile.php");
            }
            else{
                $_SESSION["name"] = $row['name'];
                $_SESSION["surname"] = $row['surname'];
                $_SESSION["role"]='3';
                $_SESSION["id"] = $row['id'];
                $_SESSION["email"] = $row['email'];
                $_SESSION["pass"]=$p1;
                header("location: profile.php");
            }
        } else {
            $error2 = "The email or password error!";
        }
    }
    else{
        $error2 = "The email or password error!";
    }
}
?>
<div id="page-content" style="margin: 10% 30%;">
    <form method="post">
        <?php if(isset($error2)){ ?><div class="alert alert-danger" role="alert"><?php echo $error2?></div><?php } ?>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="p1"  class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div style="text-align: center">
        <button class="btn btn-primary" name="login" style="text-align: center">Sign In</button>
        </div>
    </form>
</div>


<?= include('footer.php'); ?>

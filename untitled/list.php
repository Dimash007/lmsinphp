<?= include('adminprofile.php'); ?>
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
           text-align: center;">All Users</h2>
<table class="table table-striped"
       style="width: 96%;
            margin-left: 2%;
            margin-bottom: 5%;
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
        <th scope="col">Surname</th>
        <th scope="col">Email</th>
        <th scope="col">Role</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $count=1;
    $sel_query="SELECT * FROM users_roles  WHERE roles_id<>'1'";
    $result = mysqli_query($connection,$sel_query);

    $sel_query2="SELECT * FROM users ORDER BY id";
    $result2=mysqli_query($connection,$sel_query2);

    while($row = mysqli_fetch_assoc($result)) {
        if($row['roles_id']=='2'){
            $row['roles_id']='Teacher';
        }
        else if($row['roles_id']=='3'){
            $row['roles_id']='Student';
        }
        $id=$row['users_id'];
        $sel_query3="SELECT * FROM users WHERE id='$id'";
        $result3=mysqli_query($connection,$sel_query3);
        $row2 = mysqli_fetch_assoc($result3)?>
        <tr><td><?php echo $row2["id"]; ?></td>
            <td ><?php echo $row2["name"]; ?></td>
            <td ><?php echo $row2["surname"]; ?></td>
            <td ><?php echo $row2["email"]; ?></td>
            <td ><?php echo $row["roles_id"]; ?></td>
            <td >
                <a href="edituser.php?id=<?php echo $row2["id"]; ?>">Edit</a>
            </td>
            <td>
                <a href="deleteuser.php?id=<?php echo $row2["id"]; ?>">Delete</a>
            </td>
        </tr>
        <?php $count++; } ?>
    </tbody>
</table>
<?=include ("footer.php");?>
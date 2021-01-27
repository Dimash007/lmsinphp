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
<div id="page-content">
    <h1>Welcome, <?php echo $_SESSION['name']." ".$_SESSION['surname'];?></h1>
</div>
<?=include ("footer.php");?>
<?php
$conn=require_once("config.php");
$sql="delete from users where userID='00857029'";
mysqli_query($conn,$sql);
echo  mysqli_error($conn);
?>
<?php
//POST 後端 用來發送評論
$conn=require_once("../config.php");
$username=$_POST['username'];
$ISBN=$_POST['ISBN'];
$context=$_POST['context'];
$num=$_POST['num'];
$good = substr($_POST['good'], 0, -1);
$sql="INSERT INTO comment (username,ISBN, context,good)
VALUES('".$username."','".$ISBN."','".$context."','".$good."')";

if(mysqli_query($conn, $sql)){
echo "回應成功<br>";
header("location:../php-book/book.php?search=".$ISBN);
}else{
echo "Error creating table: " . mysqli_error($link);
}
$sql="Update user_book_history set comment_status='已評論' where numbering=$num";
mysqli_query($conn, $sql);
?>
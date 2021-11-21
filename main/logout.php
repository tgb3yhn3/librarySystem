<?php 
$from=$_GET['from'];
session_start(); 
$_SESSION = array(); 
session_destroy(); 

header('location:index.php'); 


?>
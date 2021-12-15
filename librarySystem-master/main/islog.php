<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    require_once("cav.php");
    $username=$_SESSION['username'];
    echo "<span style='float:right; height=auto;margin-top=0;box-sizing:border-box;'>
    <h4>hi ".$username."</h4>
    </span>
    ";
    }
?>
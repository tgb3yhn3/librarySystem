<?php
//GET 前端 大家都可以進入的首頁
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;  //記得要跳出來，不然會重複轉址過多次
}
?>
<html>
<head>
  <title>Library-System</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
  <style>
    body{
      text-align:center;
    }
    button{
      width:400px;
      height:300px;
      font-size:50px;
      box-sizing:border-box;
      margin-top:10%;
    }
    </style>
<body>

<form method="POST" action="php-member/login.php">
帳號(學號)：
<input type="text" name="userID"><br/><br/>
密碼：
<input type="password" name="password"><br><br>
<input type="submit" value="登入" name="submit"><br><br>
<a href="php-member/register.html">還沒有帳號？現在就註冊！</a>
<a href="php-member/forget.html">忘記密碼了?</a>
</form>
<table>
  <tr>
 <a href="php-book/select.php"><button>查詢</button></a> 
 <?php
 if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location:welcome.php");
 }?>

  </tr>
 <!-- <li><a href="update.php">UPDATE，更新資料表中的資料</a></li>
 <li><a href="delete.php">DELETE，刪除資料表中的資料</a></li> -->
</table>


</body>

</html>
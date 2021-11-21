<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false){
    header("location: index.php");
    exit;  //記得要跳出來，不然會重複轉址過多次
}
?>
<html xmlns=”http://www.w3.org/1999/xhtml”>
<head>
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
<?php
  //很重要，可以用的變數存在session裡
$username=$_SESSION["username"];
echo "<h1>你好 ".$username."你好</h1>";
echo "<a href='logout.php'><button>登出</button></a>";
    
?>

<table>
  <tr>
 <a href="select.php"><button>查詢</button></a> 
 <?php
 if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        
 echo '<a href="insert.php"><button>新增書籍</button></a>';
 }?>
  </tr>
 <!-- <li><a href="update.php">UPDATE，更新資料表中的資料</a></li>
 <li><a href="delete.php">DELETE，刪除資料表中的資料</a></li> -->
</table>


</body>

</html>
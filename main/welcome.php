<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){
    header("location: index.php");
    exit;  //記得要跳出來，不然會重複轉址過多次
}
?>
<html>
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
$userID=$_SESSION["userID"];
echo "<h1>".$userID."你好</h1>";
echo "<a href='php-member/logout.php'><button>登出</button></a>";
    
?>

<table>
  <tr>
 <a href="../php-book/select.php"><button>查詢</button></a> 
 <?php
 if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        
 echo '<a href="../php-book/insert.php"><button>新增書籍</button></a>';
 }
 ?>
  </tr>
</table>


</body>

</html>
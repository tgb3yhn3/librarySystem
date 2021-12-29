<?php 
//GET 後端 用來驗證註冊token
$conn=require_once("../config.php");
if($_SERVER["REQUEST_METHOD"]=="GET"){
$token=$_GET['verify'];
// 
echo '<form action="validReg.php" method="POST">
<button>按我以驗證</button>
<input type="hidden" name="ver" value="'.$token.'">

</form>';
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $token=$_POST['ver'];
$sql="SELECT * FROM users WHERE token='".$token."'";
// echo $sql;
if(mysqli_num_rows(mysqli_query($conn,$sql))==1){
   $sql="UPDATE users SET status=1 where token='".$token."'";
   if(mysqli_query($conn,$sql)==1){
    echo"驗證成功";
    header("refresh:3;url=../index.php",true);
    echo "<a href='../index.php'>未成功跳轉頁面請點擊此</a>";
    }
}
else{
    echo "系統token錯誤，請在試一次或聯絡管理員";
    echo "<a href='register.php'>未成功跳轉頁面請點擊此</a>";
    header('HTTP/1.0 302 Found');
    header("refresh:3;url=register.php",true);
    exit;
}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>會員註冊</title>
    <script>
        
        function validateForm() {
            var x = document.forms["registerForm"]["password"].value;
            var y = document.forms["registerForm"]["password_check"].value;
            if(x.length<6){
                alert("密碼長度不足");
                return false;
            }
            if (x != y) {
                alert("請確認密碼是否輸入正確");
                return false;
            }
        }
    </script>
    
    </head>
<body>
    <h1>註冊頁面</h1>
<form name="registerForm" method="post" action="register.php" onsubmit="return validateForm()">
    使用者名稱
    <input type="text" name="username"><br/><br/>
    學  號：
    <input type="text" name="userID"><br/><br/>
    密  碼：
    <input type="password" name="password" id="password"><br/><br/>
    確認密碼：
    <input type="password" name="password_check" id="password_check"><br/><br/>


    <input type="submit" value="註冊" name="submit">
    <input type="reset" value="重設" name="submit">
</form>

<?php 
$conn=require_once("../config.php");
require_once("sentRegisterEmail.php");
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST["username"];
    $userID=$_POST["userID"];
    $email=$userID.'@mail.ntou.edu.tw';
    $password=$_POST["password"];
    $token=md5($userID.$password.time());
    //檢查帳號是否重複
    $check="SELECT * FROM users WHERE username='".$username."'";
    if(mysqli_num_rows(mysqli_query($conn,$check))==0){
        $sql="INSERT INTO users (username,userID,email, password,token)
            VALUES('".$username."','".$userID."','".$email."','".$password."','".$token."')";
       
        
        if(mysqli_query($conn, $sql)){
            sentRegMail($email,$token);
            echo "註冊成功!<br>";

            echo"沒收到驗證信請檢查垃圾郵件QQ";
            
            //echo "<a href='index.php'>未成功跳轉頁面請點擊此</a>";
            
  
            // header("refresh:3;url=index.php");
            // exit;
        }else{
            echo "Error creating table: " . mysqli_error($conn);
        }
    }
    else{
        echo "該帳號已有人使用!<br>3秒後將自動跳轉頁面<br>";
        echo "<a href='register.php'>未成功跳轉頁面請點擊此</a>";
        header('HTTP/1.0 302 Found');
        header("refresh:3;url=register.php",true);
        exit;
    }
}


mysqli_close($conn);

function function_alert($message) { 
      
    // Display the alert box  
    echo "<script>alert('$message');
     window.location.href='index.php';
    </script>"; 
    
    return false;
} 
?>
</body>
</html>
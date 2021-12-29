<?php 
//POST 後端 驗證註冊內容
$conn=require_once("../config.php");
require_once("sentRegisterEmail.php");
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST["username"];
    $userID=$_POST["userID"];
    $email=$userID.'@mail.ntou.edu.tw';
    $password=$_POST["password"];
    $token=md5($userID.$password.time());
    //檢查帳號是否重複
    $check="SELECT * FROM users WHERE userID='".$userID."'";
    if(mysqli_num_rows(mysqli_query($conn,$check))==0){
        $sql="INSERT INTO users (username,userID,email, password,token,status)
            VALUES('".$username."','".$userID."','".$email."','".$password."','".$token."',0)";
       
        
        if(mysqli_query($conn, $sql)){
            if(sentRegMail($email,$token)){
                require_once '../php-condiction/create_condition.php';
                create_condition($conn,$userID);
                echo "註冊成功!<br>";
                
                echo"沒收到驗證信請檢查垃圾郵件<br>";
                echo "<br>3秒後將自動跳轉回首頁<br>";
                echo "<a href='../index.php'>未成功跳轉頁面請點擊此</a>";
                
                header("refresh:3;url=../index.php",true);
            }else{
                $sql='delete from users where userID="'.$userID.'"';
                mysqli_query($conn, $sql);
                echo"郵件寄送失敗，請重試或請聯繫系統管理員";
            }
            
            
            
            //echo "<a href='index.php'>未成功跳轉頁面請點擊此</a>";
            
  
            // header("refresh:3;url=index.php");
            // exit;
        }else{
            echo "Error creating table: " . mysqli_error($conn);
        }
    }
    else{
        echo "該帳號已有人使用!<br>3秒後將自動跳轉頁面<br>";
        echo "<a href='signup-2.htm'>未成功跳轉頁面請點擊此</a>";
        header('HTTP/1.0 302 Found');
        // header("refresh:3;url=signup-2.htm",true);
        exit;
    }
}else{
    // header("location:signup-2.htm");
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
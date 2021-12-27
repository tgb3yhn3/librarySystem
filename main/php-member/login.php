<?php
//POST 後端 驗證登錄 
// Include config file
$conn=require_once "../config.php";
require_once "../php-blacklist/isblackList.php";
// Define variables and initialize with empty values

//增加hash可以提高安全性
// $password_hash=password_hash($password,PASSWORD_DEFAULT);
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    session_start();
    $userID=$_POST["userID"];
    $password=$_POST["password"];
    
    $sql = "SELECT * FROM users WHERE userID ='".$userID."'";
    $result=mysqli_query($conn,$sql);
    $row=$result ->fetch_assoc();
    $isblackList=isblackList($conn,$userID);
    
    if(mysqli_num_rows($result)==1 && $row['password']==$password&&$row['status']>=1){
    
        //這些是之後可以用到的session變數 包括是否登陸 以及使用者名子及學號 
        /*使用範例

        session_start();//必須要先call這個 才能使用session變數
        $username=$_SESSION["username"];
        echo $username;//這會印出目前登錄的使用者的名字
        */
        if($isblackList==null){
            $sql = "INSERT INTO `loginin` (`userID`, `time`, `ip`) VALUES ('$userID', current_timestamp(), ' ".$_SERVER['REMOTE_ADDR']." ')";
            $result=mysqli_query($conn,$sql);
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $row["username"];//使用者名稱
            $_SESSION["userID"] = $row["userID"];//使用者學號
            $_SESSION["email"]=$row["email"];//使用者email
            
            $_SESSION["status"]=$row["status"];//是否通過信箱認證
            $_SESSION["admin"]=($_SESSION["status"]==2);
            
            
            header("refresh=0;url=../index.php",false);//登陸完成跳轉回首頁
        }else{
            
            function_alert("您的帳號已被列為黑名單 ，故無法使用 原因  ".$isblackList);
        }
        
    }
    else if($row['status']==0&&$row['password']==$password){
        //帳號密碼都對但是還沒註冊=> stastus=0
        function_alert("您的帳號尚未通過信箱驗證 ，故無法使用");
        
    }else{//打錯密碼
        function_alert("帳號或密碼錯誤"); 
            
     }
}else{
    function_alert("請聯絡管理員，wrong request method");   
}

    // Close connection
    mysqli_close($link);

function function_alert($message) { 
    // window.location.href='index.php';
    // Display the alert box  
    echo "<script>alert('$message')</script>"; 
    return false;
} 
header("refresh:0;url=../index.php",false);
?>
<a href="index.php">若無跳轉請按此</a>

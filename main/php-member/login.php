<?php
// Include config file
$conn=require_once "config.php";
 
// Define variables and initialize with empty values
$username=$_POST["username"];
$password=$_POST["password"];
//增加hash可以提高安全性
$password_hash=password_hash($password,PASSWORD_DEFAULT);
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    session_start();
    $sql = "SELECT * FROM users WHERE username ='".$username."'";
    $result=mysqli_query($conn,$sql);
    $row=$result ->fetch_assoc();
    // function_alert(mysqli_fetch_assoc($result)['password']==$password);
    if(mysqli_num_rows($result)==1 && $row['password']==$password&&$row['status']==1){
        
        // Store data in session variables
        $_SESSION["loggedin"] = true;
        //這些是之後可以用到的變數
        $_SESSION["id"] = $row["id"];
        $_SESSION["username"] = $row["username"];
        echo $_SESSION['username'];
        header("location:welcome.php");
    }else if($row['status']==0&&$row['password']==$password){
        function_alert("您的帳號尚未通過信箱驗證 ，故無法使用");
        
    }
    
    else{
            function_alert("帳號或密碼錯誤"); 
            
        }
}
    else{
        function_alert("Something wrong"); 
        
    }

    // Close connection
    mysqli_close($link);

function function_alert($message) { 
    // window.location.href='index.php';
    // Display the alert box  
    echo "<script>alert('$message');
     
    </script>"; 
    return false;
} 
header("refresh:0;url=index.php",false);
?>
<a href="index.php">若無跳轉請按此</a>

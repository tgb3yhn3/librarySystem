<?php
//GET 後端 用來驗證忘記密碼token 
$token=$_GET["verify"];
$conn=require_once ("../config.php");
$sql="SELECT * FROM users WHERE forgettoken='".$token."'";
// echo $sql;
if(mysqli_num_rows(mysqli_query($conn,$sql))==1){
//     echo '<form name="resetPasswordForm" action="changePassword.php" method="POST" onsubmit="return validateForm()">
//     輸入新密碼<input type="password" name="password">
//     請再次輸入新密碼<input type="password" name="password_check">
//     <input type="hidden" value="'.$token.'" name=token>
//     <input type="submit">
// </form>';
}else{
    echo "validtoken 請聯繫管理員";
}

?>
<!DOCTYPE html>
<HTML>
<HEAD>
    <!-- <link rel="stylesheet" type="text/css" href="frontpage.css"> -->
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../frontpage.css"> 
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</HEAD>
<BODY>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> -->
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <a href="../index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <img width="50px" height="50px" src="ntou_logo.png">
            </a>
            <span class="fs-1">海大資工系圖書館系統<span class="fs-2">-修改密碼</span></span>
            <div class="col-md-3 text-end">
            <?php 
          session_start();
          if(isset($_SESSION['username'])){

            // echo ($_SESSION["status"]);
            // echo $_SESSION["admin"];
            echo $_SESSION['username'].'&emsp;你好&emsp;';
            
            echo '
            <div class="btn-group">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="../php-member/logout.php" class="text-decoration-none"><button type="button" class="dropdown-item ">登出</button></a>
                <a href="../php-member/change.php" class="text-decoration-none"><button type="button" class="dropdown-item ">修改密碼</button></a>
            </div>
          </div>
          ';
          }else{
            echo' <a href="../php-member/login-2.htm"><button type="button" class="btn btn-outline-primary me-2">Login</button></a>
            <a href="../php-member/signup-2.htm"><button type="button" class="btn btn-primary">Sign-up</button></a>
         ';
          } ?>
        </header>
    </div>
    <div class="container">
        <table border="0">
            <thead>
                <tr>
                    <th>
                        <label>
                            <p></p>
                            <form name="registerForm" method="post" action="changePassword.php" onsubmit="return validateForm()">
                            <input type="hidden" value="<?php echo $token?>" name=token>
                            <p>
                                &emsp;&emsp;&emsp;&emsp;密碼:
                                <input id="password" name="password" type="password" size="25" maxlength="30"required>  &emsp;
                            </p>
                            <p>
                                &emsp;&emsp;確認密碼:
                                <input id="password_check" name="password_check" type="password" size="25" maxlength="30"required>  &emsp;
                            </p>
                            <p>
                                &emsp;&emsp;&emsp;&emsp;&emsp;<input type="submit" value="確認修改" name="submit"> &emsp; <input type="reset" value="清除" name="submit">
                            </p>
                            <p></p>
                        </label>
                    </th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-muted">&copy; 2021 Company, Inc</p>


            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item"><a href="../index.php" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
            </ul>
        </footer>
    </div>

</BODY>
</HTML>
<?php
    if(isset($_POST['userID'])){
        $conn=require_once("../config.php");
        $userID=$_POST['userID'];
        $sql = "SELECT * FROM users WHERE userID ='".$userID."'";
        $result=mysqli_query($conn,$sql);
        $row=$result ->fetch_assoc();
        if($row['password']==$_POST['password']){
            $forgetToken=md5($userID.time());
            $sql="UPDATE users SET forgettoken='".$forgetToken."' WHERE userID=".$userID;
            mysqli_query($conn,$sql);
            header("refresh:0;url=http://grassr.ddns.net/main/php-member/validForget.php?verify=$forgetToken",true);
        }else{
            alertMsg("密碼錯誤");
            //ERROR
        }
        
    }
    function alertMsg($msg){
        echo "<script>
        window.alert('$msg');
        </script>";
    }
?>
<script>
        
        function validateForm() {
            var x = document.forms["resetPasswordForm"]["password"].value;
            var y = document.forms["resetPasswordForm"]["password_check"].value;
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

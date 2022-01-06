<!DOCTYPE html>
<HTML>
<HEAD>
    <!-- <link rel="stylesheet" type="text/css" href="frontpage.css"> -->
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
                <a href="login-2.htm"><button type="button" class="btn btn-outline-primary me-2">Login</button></a>
                <a href="signup-2.htm"><button type="button" class="btn btn-primary">Sign-up</button></a>
            </div>
        </header>
    </div>
    <div class="container">
        <div class="row border justify-content-center  " >
              <div class=" col-4 h-100 ">
                <br>
                
                <form action="change.php" name="book" method="POST" style="width:atuo; text-align:center;">
                    <input type="hidden" value=<?php echo "'$userID'" ?> name="userID">
                    &emsp;
                    請輸入原本密碼:<input id="password" name="password" type="password" >
                     &emsp;
                <br>
                <br>
                
                   
                <input type="submit"></button>
            </form>
              </div>
        </div>
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
            header("refresh:0.005;url=http://grassr.ddns.net/main/php-member/validForget.php?verify='.$token.'",true);
        }else{
            //ERROR
        }
        
    }
?>
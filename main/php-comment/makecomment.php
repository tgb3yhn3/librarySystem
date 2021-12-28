<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html> -->
<!DOCTYPE html>
<HTML>
<HEAD>
    <link rel="stylesheet" type="text/css" href="../php-book/frontpage.css">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Search!</title>
</HEAD>
<BODY>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> -->
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <a href="../index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <img width="50px" height="50px" src="../php-book/ntou_logo.png">
            </a>
            <span class="fs-1">海大資工系圖書館系統<span class="fs-2">-搜尋</span></span>

            <div class="col-md-3 text-end">
            <?php 
          session_start();
          if(isset($_SESSION['username'])){

            // echo ($_SESSION["status"]);
            // echo $_SESSION["admin"];
            echo $_SESSION['username'].'&emsp;你好&emsp;';
            
            echo '<a href="../php-member/logout.php"><button type="button" class="btn btn-primary">登出</button></a>';
          }else{
            echo' <a href="../php-member/login-2.htm"><button type="button" class="btn btn-outline-primary me-2">Login</button></a>
            <a href="../php-member/register.html"><button type="button" class="btn btn-primary">Sign-up</button></a>
         ';
          } ?>
            </div>
        </header>
    </div>
    <span id="tab-1">評論</span>
    <!-- <span id="tab-2">評分</span> -->
        <div id="tab">
            <ul>
                <li><a href="#tab-1">評論</a></li>
                <!-- <li><a href="#tab-2">評分</a></li> -->
            </ul>

            <!-- 頁籤的內容區塊 -->
            <div class="tab-content-1">
                <p>&emsp;</p>
                <form id="usform"action="sentComment.php" method="POST">
        請輸入評論 :<br>
         <textarea form="usform" name="context" type="text" maxlength="300" style="border-color:#84C1FF;height:125px;width:100%;"></textarea>
        <input type="hidden" name='username'value='<?php echo  $_SESSION['username'];?>'>
        <input type="hidden" name='ISBN'value='<?php echo  $_GET['book']?>'>
        <input type="hidden" name='num'value='<?php echo  $_GET['num']?>'>
        
    
                &emsp;&emsp;&emsp;&emsp;
                <p></p>
                &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="submit" >
                </form>
            </div>
            <div class="tab-content-2" margin:0 auto>
                <p></p>
                <p>&emsp;&emsp;&emsp;&emsp;&emsp;<input type="radio" name="star">一顆星</p>
                <p>&emsp;&emsp;&emsp;&emsp;&emsp;<input type="radio" name="star">二顆星</p>
                <p>&emsp;&emsp;&emsp;&emsp;&emsp;<input type="radio" name="star">三顆星</p>
                <p>&emsp;&emsp;&emsp;&emsp;&emsp;<input type="radio" name="star">四顆星</p>
                <p>&emsp;&emsp;&emsp;&emsp;&emsp;<input type="radio" name="star">五顆星</p>
                &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="submit" value="查詢">
            </div>
        </div>
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-muted">&copy; 2021 Company, Inc</p>


            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
            </ul>
        </footer>
    </div>
</BODY>
</HTML>
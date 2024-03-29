<?php
    require_once('bookAPI.php');
    $conn=require_once("config.php");
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $userID=$_POST["userID"];
        $bookuniqueID=$_POST["bookuniqueID"];
        $array = str_split($bookuniqueID);
        $ISBN = '';
        for($i=0;$i<13;$i++){
            $ISBN = $ISBN.$array[$i];
        }
        if(check_user_exist($userID,$conn)){//看有沒有這個學號
          if(strlen($bookuniqueID)!=15 && strlen($bookuniqueID)!=16){
            echo"<script>alert('書號輸入錯誤');history.go(-1);</script>";
            exit;
          }
          if($array[14]=='0'){
            echo"<script>alert('書號輸入錯誤');history.go(-1);</script>";
            exit;
          }
          if(check_book_exist($bookuniqueID,$conn)){//看有沒有此書
            if(check_reserve($userID,$ISBN,$conn)){//看是不是已被預約的書
              // echo "有預約<br>";
              adjust_book_status($bookuniqueID,1,$conn);//把此書登記為借出
              adjust_book_history_reserve($userID,$bookuniqueID,$ISBN,$conn);//把history已預約的狀態改成出借中
            }
            else{
              if(check_condition($userID,$conn)){//查user還有沒有扣打
                  if(check_late_return($userID,$conn)){//查user有沒有逾期還書
                      if(check_book_status($bookuniqueID,$conn)){//查此書有沒有被借走(理論上用不到)
                          // echo "正常借書<br>";
                          adjust_book_status($bookuniqueID,1,$conn);//把此書登記為借出
                          adjust_user_condition($userID,1,$conn);//user的renting_book_num+1
                          push_book_history($userID,$bookuniqueID,$conn,$ISBN);//將借書資訊放到history
                      }
                      else{
                          echo"<script>alert('此書已被借走');history.go(-1);</script>";
                          exit;
                      }
                  }
                  else{
                      echo"<script>alert('有逾期書籍未歸還');history.go(-1);</script>";
                      exit;
                  }
              }
              else{
                  echo"<script>alert('已達借書上限,不得借書');history.go(-1);</script>";
                  exit;
              }
            }
            // echo "借書成功";
          }
          else{
            echo"<script>alert('館藏無此書');history.go(-1);</script>";
            exit;
          }
        }
        else{
          echo"<script>alert('學號輸入錯誤');history.go(-1);</script>";
          exit;
        }
        
        
    }
    
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>資料匯出</title>
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> -->
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
          <a href="../welcome.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <img width="50px" height="50px"src="ntou_logo.png">
          </a>
          <span class="fs-1">海大資工系圖書館系統<span class="fs-2">-資料匯出</span></span>
    
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
          </div>
        </header>
    </div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="card text-center" style="width: 30rem;">
          <div class="card-body">
              <button id="html" type="button" class="btn btn-success btn-lg mx-4" >出借憑據</button>
              <button href="#" type="button" class="btn btn-success btn-lg" disabled>還書憑據</button>
              <br><br>
            <button href="#" type="button" class="btn btn-success btn-lg" disabled>罰金繳費單</button>
          </div>
          
      </div>
      </div>
        
    </div>
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
          <p class="col-md-4 mb-0 text-muted">&copy; 2021 Company, Inc</p>
          <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="../welcome.php" class="nav-link px-2 text-muted">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
          </ul>
        </footer>
    </div>

    <script>
        $(document).ready(function(){
            $("#html").click(function(){
                window.open("borrowReceipt.php?ISBN=<?=$ISBN?>&bookuniqueID=<?=$bookuniqueID?>&userID=<?=$userID?>","_blnk");
            });
        });
    </script>
  </body>
  
</html>
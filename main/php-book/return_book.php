<?php
    require_once('check_user_renting_book.php');
    require_once('adjust_book_status.php');
    require_once('adjust_user_condition.php');
    require_once('adjust_book_history.php');
    require_once('check_line_up.php');
    require_once('adjust_line_up.php');
    require_once('check_this_book_late_return.php');
    require_once('fine_API.php');
    $conn=require_once("config.php");
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $userID=$_POST["userID"];
        $bookuniqueID=$_POST["bookuniqueID"];
        $array = str_split($bookuniqueID);
        $ISBN = '';
        for($i=0;$i<13;$i++){
            $ISBN = $ISBN.$array[$i];
        }
        if(check_user_renting_book($userID,$bookuniqueID,$conn)){//查使用者有沒有借這本書
            if(check_line_up($ISBN,$conn)){//查有沒有人在預約這本書
                adjust_line_up($ISBN,$conn);//叫排第一個的來拿書
                adjust_book_status($bookuniqueID,2,$conn);//表使此書在圖書館但被預約
                // echo "管理員~有人預約此書";
            }
            else{
                adjust_book_status($bookuniqueID,0,$conn);//表使此書尚有庫存
            }
            adjust_user_condition($userID,-1,$conn);//user還書 可借數量++
            adjust_book_history($userID,$bookuniqueID,$conn);//調整歷史借書紀錄為已還書或遲還
        }
        else{
            echo"<script>alert('此使用者無借閱此書');history.go(-1);</script>";
            exit;
        }
    }
?>
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
            
            echo '<a href="../php-member/logout.php"><button type="button" class="btn btn-primary">登出</button></a>';
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
              <button href="#" type="button" class="btn btn-success btn-lg mx-4" disabled>出借憑據</button>
              <button id="html" type="button" class="btn btn-success btn-lg" >還書憑據</button>
              <br><br>
              <?php
                if($data = check_this_book_late_return($bookuniqueID,$conn)){//late
                  echo '<button id="fine" type="button" class="btn btn-success btn-lg">罰金繳費單</button>';
                  $late_total_date = late_total_day($data);
                  $start_rent_date = start_rent_date($data);
                  $return_date = return_date($data);
                  $book_name = book_name($data);
                  $lasting_return_date = lasting_return_date($data);
                  $book_fine = get_book_fine($userID,$conn);
                  $total_fine = total_fine($late_total_date,$book_fine);
                }
                else{//no late
                  echo '<button href="#" type="button" class="btn btn-success btn-lg" disabled>罰金繳費單</button>';
                }
              ?>
              
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
                window.open("returnReceipt.php?ISBN=<?=$ISBN?>&bookuniqueID=<?=$bookuniqueID?>&userID=<?=$userID?>","_blnk");
            });
        });
        $(document).ready(function(){
            $("#fine").click(function(){
                window.open("fineReceipt.php?ISBN=<?=$ISBN?>&bookuniqueID=<?=$bookuniqueID?>&userID=<?=$userID?>&late_total_date=<?=$late_total_date?>&start_rent_date=<?=$start_rent_date?>&return_date=<?=$return_date?>&book_name=<?=$book_name?>&lasting_return_date=<?=$lasting_return_date?>&book_fine=<?=$book_fine?>&total_fine=<?=$total_fine?>","_blnk");
            });
        });
    </script> 
  </body>
  
</html>
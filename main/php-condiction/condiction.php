<?php
  $conn=require_once("../config.php");
  session_start();
  if(!isset($_SESSION["admin"]) || $_SESSION["admin"]!=true){
    header("location:../index.php");
}
  $get_userID =  "SELECT * FROM user_condition";
  $result = mysqli_query($conn,$get_userID);
  if ($result) {
      // mysqli_num_rows方法可以回傳我們結果總共有幾筆資料
      if (mysqli_num_rows($result)>0) {
          // 取得大於0代表有資料
          // while迴圈會根據資料數量，決定跑的次數
          // mysqli_fetch_assoc方法可取得一筆值
          while ($row = mysqli_fetch_assoc($result)) {
              // 每跑一次迴圈就抓一筆值，最後放進data陣列中
              $datas[] = $row;
          }
      }
      // 釋放資料庫查到的記憶體
      mysqli_free_result($result);
  }
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    $book_num = $_POST["book_num"];
    $book_time = $_POST["book_time"];
    $book_fine = $_POST["book_fine"];
    $userID = $_POST["userID"];
    //檢查帳號是否重複
    $change = "UPDATE user_condition SET book_num = $book_num, book_time = $book_time, book_fine = $book_fine WHERE userID = $userID";
    mysqli_query($conn, $change);
    header("refresh:0.005;url=condiction.php",true);
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
    <title>使用者權限</title>
    <script>
      (function() {'use strict';
        window.addEventListener('load', function() {
          var forms = document.getElementsByClassName("needs-validation");
          var validation = Array.prototype.filter.call(forms, function(forms) {
            forms.addEventListener('submit', function(event) {
              if (forms.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
            forms.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
  </head>
  <body onbeforeunload="goodbye()">
  <script>
    
      window.onbeforeunload=function(e){     
        var e = (window.event||e);  
        e.returnValue=("確定離開當前頁面嗎？");
      } 
    
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> -->
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
          <a href="../welcome.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <img width="50px" height="50px"src="../ntou_logo.png">
          </a>
          <span class="fs-1">海大資工系圖書館系統<span class="fs-2">-使用者權限</span></span>
    
          <div class="col-md-3 text-end">
          <?php 
        
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
    
      <div class="container" >
        <table class="table align-middle">
            <thead class="table-dark">
              <tr>
                <th scope="col">學號</th>
                <th scope="col">可借/預約數量</th>
                <th scope="col">借書時間</th>
                <th scope="col">罰金倍率</th>
                <th scope="col">信用分數</th>
                <th scope="col">設定</th>
              </tr>
            </thead>
            <br>
            <tbody>
            
              <?php 
              for($i = 0;$i<count($datas);$i++){
                echo'
              <tr>
                <form action="condiction.php" method="POST" id="user'.$i.'" >
                <input type="hidden" name="userID" value='.$datas[$i]["userID"].'>
                <th scope="row"><input type="text" class="form-control" type="text" value="'.$datas[$i]["userID"].'" readonly></th>
                <td>
                  <input type="number"class="form-control" id="book_num'.$i.'"  name="book_num"  value="'.$datas[$i]["book_num"].'" onchange="change_color(this.id)" required>
                </td>
                <td>
                <input type="number"class="form-control" id="book_time'.$i.'" id="book_time'.$i.'" name="book_time" value="'.$datas[$i]["book_time"].'"onchange="change_color(this.id)"required>
                </td>
                <td>
                <input type="number"class="form-control" id="book_fine'.$i.'" name="book_fine" value="'.$datas[$i]["book_fine"].'" onchange="change_color(this.id)" required>
                </td>
                <td>
                  <input type="text" class="form-control" type="text" placeholder="'.$datas[$i]["credit"].'"onchange="change_color(this.id)" readonly>
                </td>
                <td>
                  <button class="btn btn-primary" onclick="window.document.body.onbeforeunload=null;return true;">設定</button>
                </td>
                </form>
              </tr>';
              }
            ?>
           
            </tbody>
          </table>
      
       </form>
      <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
          <p class="col-md-4 mb-0 text-muted">&copy; 2021 Company, Inc</p>
      
      
          <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
          </ul>
        </footer>
      </div>

      
  </body>
  <script>
            function change_color(id){
                console.log(id);
                document.getElementById(id).style = "background-color:#FFCC6E;"
            }
            function cancel_color(id){
                console.log(id);
                document.getElementById("book_num"+id).style = "background-color:#ffffff;"
                document.getElementById("book_time"+id).style = "background-color:#ffffff;"
                document.getElementById("book_fine"+id).style = "background-color:#ffffff;"
            }
        </script>
</html>
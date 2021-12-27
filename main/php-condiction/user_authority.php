<?php
	session_start();
	$_SESSION['unsave_id'] = '0';
    $conn=require_once("config.php");
    $get_userID =  "SELECT userID, book_num, book_time, book_fine, credit FROM user_condition";
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
	echo '<form action="index.php" method="POST" onsubmit="return validateForm()">';
    for($i = 0;$i<count($datas);$i++){
        echo '
            <input type="hidden" name="userID'.$i.'" value='.$datas[$i]["userID"].'>
            <table>
            <tr>
                <th colspan="4"><h1>'.$datas[$i]["userID"].'</h1></th>
                
            </tr>
            <tr>
                <td>數量</td>
                <td>時長</td>
                <td>倍率</td>
                <td>信用</td>
            </tr>
            <tr>
                <td><input type="text" name="book_num'.$i.'" id="book_num'.$i.'" value='.$datas[$i]["book_num"].' size = "5" onchange="change_color(this.id)"></td>
                <td><input type="text" name="book_time'.$i.'" id="book_time'.$i.'" value='.$datas[$i]["book_time"].' size = "5" onchange="change_color(this.id)"></td>
                <td><input type="text" name="book_fine'.$i.'" id="book_fine'.$i.'" value='.$datas[$i]["book_fine"].' size = "5" onchange="change_color(this.id)"></td>
                <td><a>'.$datas[$i]["credit"].'</a></td>
            </tr>
            </table>
        <br>';
    }
	echo '<input type="hidden" name="unsave_ornot" id="unsave_ornot" value = 0><input type="submit" id="submit'.$i.'" value="設定" onclick = "ChangeState();"></form>';
    if($_SERVER["REQUEST_METHOD"]=="POST"){
		for($i = 0;$i<count($datas);$i++){
			$book_num = $_POST["book_num$i"];
        	$book_time = $_POST["book_time$i"];
        	$book_fine = $_POST["book_fine$i"];
			$userID = $_POST["userID$i"];
			$change = "UPDATE user_condition SET book_num = $book_num, book_time = $book_time, book_fine = $book_fine WHERE userID = $userID";
        	mysqli_query($conn, $change);
		}
        //檢查帳號是否重複
        header("refresh:0.005;url=index.php",true);
    }
    mysqli_close($conn);
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
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> -->
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
          <a href="https://www.ntou.edu.tw/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <img width="50px" height="50px"src="ntou_logo.png">
          </a>
          <span class="fs-1">海大資工系圖書館系統<span class="fs-2">-使用者權限</span></span>
    
          <div class="col-md-3 text-end">
            <button type="button" class="btn btn-outline-primary me-2" disabled>小樺</button>
            <button type="button" class="btn btn-primary">登出</button>
          </div>
        </header>
    </div>

      <div class="container" >
        <table class="table align-middle">
            <thead class="table-dark">
              <tr>
                <th scope="col">學號</th>
                <th scope="col">姓名</th>
                <th scope="col">可借/預約數量</th>
                <th scope="col">借書時間</th>
                <th scope="col">罰金倍率</th>
              </tr>
            </thead>
            <br>
            <tbody>
              <tr>
                <th scope="row">00857002</th>
                <td>Mark</td>
                <td>
                  <select class="form-select" id="num" required>
                    <option value="">3</option>
                    <option>1</option>
                    <option>2</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
                </td>
                <td>
                  <select class="form-select" id="day" required>
                    <option value="">15</option>
                    <option>5</option>
                    <option>10</option>
                    <option>20</option>
                    <option>25</option>
                  </select>
                </td>
                <td>
                  <select class="form-select" id="money" required>
                    <option value="">1</option>
                    <option>1.5</option>
                    <option>2</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th scope="row">00857020</th>
                <td>Joe</td>
                <td>
                  <select class="form-select" id="num" required>
                    <option value="">3</option>
                    <option>1</option>
                    <option>2</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
                </td>
                <td>
                  <select class="form-select" id="day" required>
                    <option value="">15</option>
                    <option>5</option>
                    <option>10</option>
                    <option>20</option>
                    <option>25</option>
                  </select>
                </td>
                <td>
                  <select class="form-select" id="money" required>
                    <option value="">1</option>
                    <option>1.5</option>
                    <option>2</option>
                  </select>
                </td>
              </tr>
              <tr>
                <th scope="row">00857039</th>
                <td>Jack</td>
                <td>
                  <select class="form-select" id="num" required>
                    <option value="">3</option>
                    <option>1</option>
                    <option>2</option>
                    <option>4</option>
                    <option>5</option>
                  </select>
                </td>
                <td>
                  <select class="form-select" id="day" required>
                    <option value="">15</option>
                    <option>5</option>
                    <option>10</option>
                    <option>20</option>
                    <option>25</option>
                  </select>
                </td>
                <td>
                  <select class="form-select" id="money" required>
                    <option value="">1</option>
                    <option>1.5</option>
                    <option>2</option>
                  </select>
                </td>
              </tr>
            </tbody>
          </table>
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

      
  </body>
  
</html>
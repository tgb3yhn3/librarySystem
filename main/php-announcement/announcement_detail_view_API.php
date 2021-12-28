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
    <title><?php $page_title="公告";echo $page_title;?></title>
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> -->
    <div class="container">
      <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <a href="../index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
          <img width="50px" height="50px"src="../ntou_logo.png">
        </a>
        <span class="fs-1">海大資工系圖書館系統<span class="fs-2">-公告</span></span>
  
        <div class="col-md-3 text-end">
          <button type="button" class="btn btn-outline-primary me-2">Login</button>
          <button type="button" class="btn btn-primary">Sign-up</button>
        </div>
      </header>
    </div>
    <div class="container" >
        <?php 
            //announcement_detail_view_API.php
            $ID=$_GET["ID"];
            $conn = require_once("../config.php");//連線至資料庫
            if(!$conn){
                die("Fatal Error");//若未成功連線，終止程式並回報錯誤
            }


            $arr = array();//將所有資料存成陣列形式
            if($ID == "overdue_notice"){//若身分為使用者,可能會收到逾期通知
               session_start();
                /*取得使用者學號*/
                $userID = $_SESSION["userID"];
                $today = date('Y-m-d');
                $username = $_SESSION["username"];
                $sql = "select  user_book_history.book_unique_ID,book.bookName,user_book_history.lasting_return_date 
                        from 	user_book_history,book
                        WHERE 	SUBSTRING_INDEX(user_book_history.book_unique_ID, '_', 1) = book.ISBN and 
                                user_book_history.userID = '$userID' and 
                                user_book_history.start_rent_date <> '-' and 
                                user_book_history.return_date = '-' and 
                                user_book_history.lasting_return_date < '$today'
                        ORDER by user_book_history.lasting_return_date ";
                $result = mysqli_query($conn,$sql);//抓取的結果
                if (!$result) die("Fatal Error");//若抓取的結果不存在，終止程式並回報錯誤
                $rows = $result->num_rows;//抓取的結果中共有幾列資料
                $temparr = array();
                $overdue_notice = array(
                  'ID'         => "overdue_notice",
                  'title'      => "(逾期未還通知)".$username."(".$userID.")同學好，您有書籍未歸還且已超過還書期限，請盡速歸還",
                  'message'    => "",
                  'annouceTime'=> $today,
                  'sent_to'    => "",
                  );
                if($rows!=0){//有書逾期未還
                    for ($i = 1 ; $i <= $rows ; ++$i){
                        $result->data_seek($i-1);//查找第i列資料
                        $row = $result->fetch_assoc();//讀取第i列資料
                        $temp = "<br><br>".$i.".".
                                 "<br>書籍ID：" .$row['book_unique_ID'].
                                 "<br>書籍名稱：".$row['bookName'].
                                 "<br>應還日期：".$row['lasting_return_date'];   
                                 $overdue_notice['message'] = $overdue_notice['message'].$temp;      
                    }

                    array_push($arr,$overdue_notice);//將第i列資料存到陣列
                }
            }
            else{//一般通知
                /*從資料庫抓取資料*/
                $sql=  "select title,message
                FROM announcement
                where ID = '$ID'";
                $result = mysqli_query($conn,$sql);//抓取的結果
                if (!$result) die("Fatal Error");//若抓取的結果不存在，終止程式並回報錯誤

                /*將抓取的資料存到陣列*/
                $rows = $result->num_rows;//抓取的結果中共有幾列資料
                for ($i = 0 ; $i < $rows ; ++$i){
                $result->data_seek($i);//查找第i列資料
                $row = $result->fetch_assoc();//讀取第i列資料
                $arr[] = $row;//將第i列資料存到陣列
                }
            }
            
            //前端輸出區
            echo"
            <html>
                <body>
                    <h1>".$arr[0]["title"]."</h1><hr><hr>".$arr[0]["message"]."<br>
                </body>
            </html>
            ";

            echo "<a href='javascript:history.back()'>返回公告頁面</a>";

            $result->close();// 釋放抓取結果的記憶體
            $conn->close();//關閉與資料庫的連線
        ?> 
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
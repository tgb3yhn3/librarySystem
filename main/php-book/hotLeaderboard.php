<!DOCTYPE html>
<HTML>
<HEAD>
    <meta charset="utf-8">
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>熱門排行</title>
    <style>
        table {
            background-color: powderblue;
            border-collapse: collapse;
            border: 5px solid gray;
        }
        th {
            padding: 5px;
            border: 3px solid gray;
        }
        td {
            padding: 5px;
            border: 3px solid gray;
        }

        tr:nth-child(odd) {
            background-color: white;
        }
    </style>
</HEAD>
<BODY>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> -->
    <div class="container">
      <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <a href="../index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
          <img width="50px" height="50px"src="ntou_logo.png">
        </a>
        <span class="fs-1">海大資工系圖書館系統-熱門排行
        </span>
  
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
    <div class="container">
        <?php
            //hotLeaderboard.php
            //熱門排行

            $leaderboardAccordingTo = $_GET["leaderboardAccordingTo"];

            if($leaderboardAccordingTo == "discussion"){
                leaderboardAccordingToDiscussion();
            }
            

            function leaderboardAccordingToDiscussion(){//依照書籍討論度排行
                echo"<h1>討論度排行</h1><a href='../index.php'>返回首頁</a>";
                $conn = require_once("../config.php");//連線至資料庫
                if(!$conn){
                    die("Fatal Errorr");//若未成功連線，終止程式並回報錯誤
                }
                echo
                "<table>
                      <tr>
                          <th>討論度</th>
                          <th>書名</th>
                          <th>作者</th>
                          <th>ISBN</th>
                          
                      </tr>";
                //抓取討論度>0的書
                $sql = "SELECT book.bookName,book.author,book.ISBN,book.describeBook,book.publish_year,book.img_url,count(*) as commentnum 
                        FROM book,comment
                        where book.ISBN = comment.ISBN 
                        group by comment.ISBN
                        order by commentnum DESC";
                mysqli_query($conn,$sql);
                $result = mysqli_query($conn,$sql);//抓取的結果
                if (!$result) die("Fatal Error");//若抓取的結果不存在，終止程式並回報錯誤
                $arr = array();//將所有資料存成陣列形式
                $rows = $result->num_rows;//抓取的結果中共有幾列資料

                for ($i = 0 ; $i < $rows ; ++$i){
                    $result->data_seek($i);//查找第i列資料
                    $row = $result->fetch_assoc();//讀取第i列資料
                    echo
                    "<tr style='cursor:pointer;' onclick=location.href='book.php?search=".$row['ISBN']."'>
                        <td>".$row['commentnum']."</td>
                        <td>".$row['bookName']."</td>
                        <td>".$row['author']."</td>
                        <td>".$row['ISBN']."</td>
                    </tr>";  
                }
                //抓取討論度=0的書
                $sql = "SELECT book.bookName,book.author,book.ISBN,book.describeBook,book.publish_year,book.img_url,0 as commentnum 
                        FROM   book
                        where  book.ISBN not in (SELECT comment.ISBN FROM comment) AND
                            SUBSTRING_INDEX(book.bookUniqueID, '_', -1) ='0'";
                mysqli_query($conn,$sql);
                $result = mysqli_query($conn,$sql);//抓取的結果
                if (!$result) die("Fatal Error");//若抓取的結果不存在，終止程式並回報錯誤
                $arr = array();//將所有資料存成陣列形式
                $rows = $result->num_rows;//抓取的結果中共有幾列資料

                for ($i = 0 ; $i < $rows ; ++$i){
                    $result->data_seek($i);//查找第i列資料
                    $row = $result->fetch_assoc();//讀取第i列資料
                    echo
                    "<tr style='cursor:pointer;' onclick=location.href='book.php?search=".$row['ISBN']."'>
                        <td>".$row['commentnum']."</td>
                        <td>".$row['bookName']."</td>
                        <td>".$row['author']."</td>
                        <td>".$row['ISBN']."</td>
                    </tr>";  
                }
                echo"
              </table>";

            }
        ?>
    </div>
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top ">
          <p class="col-md-4 mb-0 text-muted">&copy; 2021 Company, Inc</p>
          <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="../index.php" class="nav-link px-2 text-muted">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
          </ul>
        </footer>
    </div>
</BODY>
</HTML>

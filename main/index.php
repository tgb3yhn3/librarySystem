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
    <title>首頁</title>
    <style>
      .carousel-caption {
        position: relative;
        top: -300px;
        margin-right: 25%;
      }
      .one_announcement:hover{
        text-decoration:underline;
        cursor:pointer;
      }
      #recommendNewBook1:hover{
        cursor:pointer;
      }
      #recommendNewBook2:hover{
        cursor:pointer;
      }
      #recommendNewBook3:hover{
        cursor:pointer;
      }
    </style>
</HEAD>
<BODY>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> -->
    <div class="container">
      <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <a href="index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
          <img width="50px" height="50px"src="ntou_logo.png">
        </a>
        <span class="fs-1">海大資工系圖書館系統</span>
  
        <div class="col-md-3 text-end">
          <?php 
          session_start();
          if(isset($_SESSION['username'])){

            // echo ($_SESSION["status"]);
            // echo $_SESSION["admin"];
            echo $_SESSION['username'].'&emsp;你好&emsp;';
            
            echo '<a href="php-member/logout.php"><button type="button" class="btn btn-primary">登出</button></a>';
          }else{
            echo' <a href="php-member/login-2.htm"><button type="button" class="btn btn-outline-primary me-2">Login</button></a>
            <a href="php-member/register.html"><button type="button" class="btn btn-primary">Sign-up</button></a>
         ';
          } ?>
          </div>
      </header>
    </div>
    <div class="container" >
        <div class="row justify-content-center">
            <div class="col-4">
              <form action="php-book/search_php.php" method="POST">
              <input name="search"class="form-control me-2" type="search" placeholder="請輸入書籍名稱" aria-label="書籍搜尋" required>
            </div>
            <div class="col-1">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </div>
           </form>
        </div>
    </div>
    <br>
    <div class="text-center">
        <div class="btn-group">
            <a href="php-book/search_php.php"><button  type="button" class="btn btn-secondary btn-lg">館藏查詢</button></a>
            <?php echo((isset($_SESSION['userID'])?'<a href="php-book/borrow_history.php" ><button type="button" class="btn btn-secondary btn-lg">借閱歷史</button></a>':''));?>
            <?php echo((isset($_SESSION['userID'])?'<a href="php-favorite/myFavoriteBook.php"><button  type="button" class="btn btn-secondary btn-lg">我的最愛</button></a>':''));?>
        </div>
    </div>
    <div class="container">
        <div  class="w-75 p-3 offset-2">
            <div><h3 style="display:inline;">系統公告&emsp;</h3><a href="php-announcement/announcement_visitor_user.html">更多</a></div>
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>公告內容</th>
                    <th>時間</th>
                  </tr>
                </thead>
                <tbody id = announcement_area>
                  
                </tbody>
              </table>
        </div>
    </div>
    <div class="container">
        <div  class="w-75 p-3 offset-2">
            <div><h3>新書推薦</h3></div>
        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div id="recommendNewBook1" class="carousel-item active" data-bs-interval="2000">
                <img id="recommendNewBook_img1" src="" class="d-block w-20" alt="...">
                <div class="carousel-caption">
                  <h5 id="recommendNewBook_bookName1"></h5>
                  <h5 id="recommendNewBook_author1"></h5>
                  <p id=""></p>
                </div>
              </div>
              <div id="recommendNewBook2"class="carousel-item" data-bs-interval="2000">
                <img id="recommendNewBook_img2" src="" class="d-block w-20" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  <h5 id="recommendNewBook_bookName2"></h5>
                  <h5 id="recommendNewBook_author3"></h5>
                  <p id=""></p>
                </div>
              </div>
              <div id="recommendNewBook3" class="carousel-item">
                <img id="recommendNewBook_img3" src="" class="d-block w-20" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  <h5 id="recommendNewBook_bookName3"></h5>
                  <h5 id="recommendNewBook_author3"></h5>
                  <p id=""></p>
                </div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
        
    </div>
    
    <div class="container">
        <div class="w-75 p-3 offset-2">
            <div><h3>熱門排行</h3></div>
        <div class="row">
            <div class="col">
              <div class="card h-100">
                <img src="mostview.png" class="card-img-top" >
                <div class="card-body">
                  <h4 class="card-title">借閱</h4>
                  <p class="card-text">依照最多人借閱書籍排行</p>
                  <button type="button" class="btn btn-outline-primary me-2">前往</button>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100">
                <img src="mostfavorite.png" class="card-img-top" >
                <div class="card-body">
                  <h4 class="card-title">評價</h4>
                  <p class="card-text">依照最高評價書籍排行</p>
                  <button type="button" class="btn btn-outline-primary me-2">前往</button>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card h-100">
                <img src="discuss.png" class="card-img-top">
                <div class="card-body">
                  <h4 class="card-title">討論度</h4>
                  <p class="card-text">依照討論度排行</p>
                  <form method="get" action="php-book/hotLeaderboard.php">
                      <input type="hidden"  name="leaderboardAccordingTo" value="discussion" />
                      <input class="btn btn-outline-primary me-2" type="submit" value="前往" />
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        
    </div>
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top ">
          <p class="col-md-4 mb-0 text-muted">&copy; 2021 Company, Inc</p>
          <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
          </ul>
        </footer>
    </div>
    <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
    <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script type="text/javascript">
        //將從資料庫抓到的資料輸出成新書推薦的項目
        var jsonUrl = "recommendNewBook.php";
        $.getJSON(jsonUrl, function (data) {
            let recommendCount = 3;//首頁顯示3本推薦的新書
            while(recommendCount>0){
              $("#recommendNewBook"+recommendCount).attr("onclick","location.href='php-book/book.php?search="+data[recommendCount-1].ISBN+"'");
              $("#recommendNewBook_bookName"+recommendCount).html(data[recommendCount-1].bookName);
              $("#recommendNewBook_author"+recommendCount).html("作者:"+data[recommendCount-1].author);
              $("#recommendNewBook_describeBook"+recommendCount).html("簡介:<br>"+data[recommendCount-1].describeBook);
              $imgurl = data[recommendCount-1].img_url;
              if($imgurl == ""){
                $imgurl = "recommendNewBook_no_Image.jfif";
              }
              $("#recommendNewBook_img"+recommendCount).attr("src",$imgurl);
              recommendCount-=1;
            }           
        });

        //將從資料庫抓到的資料輸出成首頁公告欄的項目
        jsonUrl = "php-announcement/announcement_view_API.php";
        // console.log(jsonUrl)
        $.getJSON(jsonUrl, function (data) {
          
            let announcementCount = 5;//首頁顯示前5個公告
            console.log(data)
            for (let item in data) {
              
                let content = 
                "<tr class='one_announcement' onclick=location.href='php-announcement/announcement_detail_view_API.php?ID="+data[item].ID+"';>"+
                    "<td style='width:75%; ' >"+
                        data[item].title+
                    "</td>"+
                    "<td style='width:25%; '>"+
                        data[item].annouceTime +
                    "</td>"+
                "</tr>";
                $("#announcement_area").append(content);
                announcementCount -= 1;
                if(announcementCount<=0){
                    break;
                }
            }
            while(announcementCount>0){//若公告數量未滿5個，則用空格補滿5個欄位
                let content = 
                "<tr>"+
                    "<td style='width:75%;' >&ensp;</td>"+
                    "<td style='width:25%;'>&ensp;</td>"+
                "</tr>";
                $("#announcement_area").append(content);
                announcementCount-=1;
            }

        });
    </script>
</BODY>
</HTML>

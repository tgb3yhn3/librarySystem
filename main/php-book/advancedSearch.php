
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
    <title>進階搜尋</title>
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
        <a href="../index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
          <img width="50px" height="50px"src="ntou_logo.png">
        </a>
        <span class="fs-1">海大資工系圖書館系統<span class="fs-2">-進階搜尋</span></span>
  
        <div class="col-md-3 text-end">
        <?php 
          session_start();
          if(isset($_SESSION['username'])){
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
        <p>請勾選並輸入搜尋條件(若無勾選任何條件則為無條件查詢)</p>
        <form action="search_php.php" method="POST">
            <div class="tab-content-2" margin:0 auto>
                <p><input name="bybookname"     type="checkbox">      <input name="adv_bookname"    placeholder="書名"      size="25" maxlength="30" style="border-color:#84C1FF;"></p>
                <p><input name="byauthor"       type="checkbox">      <input name="adv_author"      placeholder="作者"      size="25" maxlength="30" style="border-color:#84C1FF;"></p>
                <p><input name="byISBN"         type="checkbox">      <input name="adv_ISBN"        placeholder="ISBN"      size="25" maxlength="30" style="border-color:#84C1FF;"></p>
                <p><input name="bypublisher"    type="checkbox">      <input name="adv_publisher"   placeholder="出版社"    size="25" maxlength="30" style="border-color:#84C1FF;"></p>
                <p><input name="byclass"        type="checkbox">分類<select  name="adv_class"     maxlength="30" style="border-color:#84C1FF;"><option value="總類">總類</option><option value="哲學類">哲學類</option><option value="宗教類">宗教類</option><option value="自然科學類">自然科學類</option><option value="應用科學類">應用科學類</option><option value="社會科學類">社會科學類</option><option value="中國史地類">中國史地類</option><option value="外國史地類">外國史地類</option><option value="語文類">語文類</option><option value="美術類">美術類</option></select></p></p>
                <p><input name="bypublish_year" type="checkbox">出版日期在<input name="adv_publish_year" type="date" ><input  type="radio" name="adv_publish_year_before_after" value="before" checked>之前<input  type="radio" name="adv_publish_year_before_after" value="after">之後</p>
                <p><input name="bycreate_time"  type="checkbox">上架日期在<input name="adv_create_time" type="date" ><input  type="radio" name="adv_create_time_before_after" value="before" checked>之前<input  type="radio" name="adv_create_time_before_after" value="after">之後</p>
                <input  type="radio" name="inventory" value="" checked>全部
                <input  type="radio" name="inventory" value="inventory_in">尚有庫存(可借閱)
                <input  type="radio" name="inventory" value="inventory_not_in">暫無庫存(需預約)
                

                <input type="submit" name="advancedSearch" value="查詢">
            </div>
        </form>
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
    <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
    <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <script type="text/javascript">
        
    </script>
</BODY>
</HTML>

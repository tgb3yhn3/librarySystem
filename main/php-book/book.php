<?php 
//POST 前端 用來檢視所選(詳細顯示所選書籍的資訊)
session_start();
$conn=require_once("../config.php");
require_once("search.php");//包含config.php了
require_once("../php-comment/comment.php");
require_once("../php-favorite/isFavorite.php");
$search=$_GET["search"];
$book=get_search_book($search,2,1,$conn);
$comment=get_comment($search,$conn);
$isFavorite = false;
if(isset($_SESSION['userID'])){
    if($_SESSION["admin"]!=true){
        $isFavorite=isFavorite($conn,$search,$_SESSION['userID']);//使用者
    }
    else{
        $isFavorite=false;//管理員
    }
}
else{
    $isFavorite=false;//訪客
}
// echo $book;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>書籍資訊</title>
    <title>書籍資訊</title>
    <style>
    h1 {
        text-align: center;
        color: #000000;  
    }
    h2 {
        text-align: center;
        line-height: 6px;
     
        color: #000000;  
    }
    .bt_sure {
        background-image:url(sure.png);
        background-repeat: no-repeat;
        /* background-position: left; */
        background-size: 30px;
        background-position:10px 5px;
        border: none;
        background-color: #a5a5a5;
        color: white;
        font-size: 15px;
        padding: 10px;/*按鈕內邊距離*/
        width: 180px;/*按鈕寬*/
        border-radius: 5px;/*圓角*/
    }
    .bt_love {
        
        

        background-repeat: no-repeat;
        /* background-position: left; */
        background-size: 30px;
        background-position:10px 5px;
        border: none;
        background-color: #a5a5a5;
        color: white;
        font-size: 15px;
        padding: 10px;/*按鈕內邊距離*/
        width: 180px;/*按鈕寬*/
        border-radius: 5px;/*圓角*/
        <?php 
    if($isFavorite){
         echo 'background-image:url(loveed.png);' ;
    }else{
        echo 'background-image:url(love.png);' ;
    }?>
    }
    .bt_sure:hover{
        background-color: #000;
        color: #fff;
    }
    .bt_love:hover{
        background-color: #000;
        color: #fff;
    }table{
       
    }
    .comment{
        /* border:2px solid rgb(189, 234, 252); */
        border-bottom: solid rgb(189, 234, 252);
        
    }
    #context{
        word-break: break-all;
        width:100%;
    }
 
    .card {
        margin-right: 10px;
    }
    .scroll{
        max-height: 550px;
        overflow-y: auto;
    }
    .comment_scroll{
        max-height: 300px;
        overflow-y: auto;
    }
    @media (max-width: 768px) {
        .bt_sure {
            width: 150px;/*按鈕寬*/
        }
        .bt_love {
            width: 150px;/*按鈕寬*/    
        }
    }
    @media (max-width: 576px) {
        .bt_sure {    
            background-size: 25px;
            background-position:7px 7px;
            width: 130px;/*按鈕寬*/    
        }
        .bt_love {
            background-size: 25px;
            background-position:7px 7px;
            width: 130px;/*按鈕寬*/ 
        }
    }
    </style>
    <script>
            function reserve_post(){
                book.action = "reserve_book.php";
                book.submit();
            }
    </script>
</head>
<body>
<div class="container">
      <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <a href="../index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
          <img width="50px" height="50px"src="ntou_logo.png">
        </a>
        <span class="fs-1">海大資工系圖書館系統<span class="fs-2">-書籍資訊</span></span>
  
        <div class="col-md-3 text-end">
        <?php 
        //   session_start();
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
        <div class="row justify-content-center">
            <div class="card col-8">
                <div class="card-body">
                    <h3 class="card-title text-center"><?php echo $book[0]->bookName ?></h3>                
                </div>
            </div>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="card col-4 " >
                <img src="<?php echo $book[0]->img ?>" class="card-img">
                
                <div class="card-body text-center ">
                    <form name="book" method="POST" >
                        <input type = "hidden" id = "userID" name="userID" value = "<?php if(isset($_SESSION['userID'])){echo $_SESSION['userID'];} ?>"><br>
                        <input type = "hidden" id = "ISBN" name="ISBN" value = "<?php echo $book[0]->ISBN ?>"><br>
                    <?php echo($book[0]->num==0)?' <input type="button"  class ="btn bt_sure" value="預約租書" onClick="reserve_post()" >':''?>
                    </form>
                </div>
                <div class="card-body text-center">
                    <form action="../php-favorite/favoriteBook_API.php" method="POST">
                        <input type="hidden" name="ISBN"value="<?php echo $search;  ?>"/>
                        <input type="hidden" name="bookName"value="<?php echo $book[0]->bookName;  ?>"/>
                        <input  type ="submit" class="bt_love" value="<?php echo($isFavorite?'移除':'加入') ?>最愛"></input>
                    </form>  
                </div>
            </div>
            <div class="card col-4 ">
                <div class="card-body scroll" >
                    <p>作者： <?php echo $book[0]->author ?>
                        <br> 
                       出版社：<?php echo $book[0]->publisher ?>
                        <br>  
                       出版日期：<?php echo $book[0]->publish_year ?>
                        <br> 
                       ISBN:    <?php echo $book[0]->ISBN ?>
                        <br>
                       內容:
                        <br>
                        <?php echo $book[0]->describeBook ?>  
            </div>
            <div class="card-footer bg-transparent text-center">剩餘: <?php echo $book[0]->num ?></div>
        </div>
    </div>
        <br>
        <div class="row justify-content-center">    
            <div class="card col-8 comment_scroll">
                    <div class="list-group list-group-flush">
                    <?php 
                        for($i=0;$i<count($comment);$i++){
                    echo'
                      <a class="list-group-item">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                          <strong class="mb-1">'.$comment[$i]->username.'</strong>
                          <small class="text-muted"></small>
                        </div>
                        <div class="col-10 mb-1 small">'.$comment[$i]->context.'</div>
                      </a>
                      ';
                        }
                      ?>
    
    
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
    
</body>
     
</html>

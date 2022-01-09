<?php
session_start();
$conn=require_once("../config.php");
require("search.php");
$book=new stdClass();
if(array_key_exists(("search"),$_POST)){
  
  $book=get_search_book($_POST['search'],1,1,$conn);
}else{
  $book=get_search_book("",0,1,$conn);
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
    <title>Search_result!</title>
    <script>
            function reserve_post(){
                book.action = "reserve_book.php";
                book.submit();
            }
    </script>
  </head>
  <body>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> -->
    <div class="container">
      <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <a href="../index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
          <img width="50px" height="50px"src="ntou_logo.png">
        </a>
        <span class="fs-1">海大資工系圖書館系統<span class="fs-2">-搜尋結果</span></span>
  
        <div class="col-md-3 text-end">
        <?php 
        //   session_start();
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
    <div class="container" >
    <form action="search_php.php" method="POST">
      <div class="row justify-content-center">
       
          <div class="col-4">
            <input class="form-control me-2" name="search"type="search" placeholder="Search" required  aria-label="Search">
          </div>
          <div class="col-1">
          <input class="btn btn-outline-success" type="submit"value="Search"></input>
          </div>
          
      </div>
      </form>
      <br>
      <div style}>
         <!-- 開始 -->
         <?php
         for($i=0;$i<count($book);$i++){
           echo'<div class="card mb-3 offset-2" style="max-width: 650px;">
           <div class="row">
             <div class="col-md-3"><a style="text-decoration:none;"href="book.php?search='.$book[$i]->ISBN.'">
             <img src="'.$book[$i]->img.'" class="img-fluid rounded-start"></a>
              </div>
              <div class="col-md-7">
                <div class="card-body">
                 
                  <h4 class="card-title"><a style="text-decoration:none;"href="book.php?search='.$book[$i]->ISBN.'">'.$book[$i]->bookName.'</a></h4>
                  <p class="card-text">'.mb_substr(strip_tags ($book[$i]->describeBook),0,80).'</p>
                  <p class="card-text"><small class="text-muted">publish at&emsp;'.$book[$i]->publish_year.'</small></p>
                </div>
              </div>
              <div class="col-md-2 row align-items-center">
                <div class="d-grid gap-5">
                '.(isset($_SESSION['admin'])&&$_SESSION['admin']==true?'<button  class="btn btn-danger " id="delete_'.$book[$i]->ISBN.'">刪除此書</button>
                <script>
          $("#delete_'.$book[$i]->ISBN.'").click(function(){
                $.ajax({
                    type: "POST",
                    url: "delete.php",
                    data : {delete : "'.$book[$i]->ISBN.'"},
                    success:function(data){
                        alert("刪除成功")
                        location.reload();
                    }
                })
            })
        ;


</script>':'').'<form name="book" method="POST" action="reserve_book.php">
                 '.($book[$i]->num==0&&isset($_SESSION["userID"])?'<button type="submit" class="btn btn-primary mr-1" >預約租書</button>':'').' 
                 
                        <input type = "hidden" id = "userID" name="userID" value = "'.(isset($_SESSION["userID"])?$_SESSION["userID"]:"").'"><br>
                        <input type = "hidden" id = "ISBN" name="ISBN" value = "'.$book[$i]->ISBN .'"><br>

                  <button type="button" class="btn btn-secondary " disabled>'.($book[$i]->num==0?'無庫存':'剩餘'.$book[$i]->num.'本').'</button>
                </form>
                  </div>
              </div>
            </div>
        </div>';
         }
         ?>
        
    <div class="container">
      <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-4 mb-0 text-muted">&copy; 2021 Kamel, Inc</p>
    
    
        <ul class="nav col-md-4 justify-content-end">
          <li class="nav-item"><a href="../index.php" class="nav-link px-2 text-muted">Home</a></li>
          <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
        </ul>
      </footer>
    </div>
  </body>
  

</html>
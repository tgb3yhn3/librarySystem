<?php
session_start();
$conn=require_once("../config.php");
require("search.php");
$book=new stdClass();
$leaderboardAccordingTo = "";
if(isset($_POST['advancedSearch'])){//進階搜尋
  if(isset($_POST['adv_bookname'])){//書名
      $adv_bookname = $_POST['adv_bookname'];
  }
  else{
      $adv_bookname = "";
  }
  if(isset($_POST['adv_author'])){//作者
      $adv_author = $_POST['adv_author'];
  }
  else{
      $adv_author = "";
  }
  if(isset($_POST['adv_ISBN'])){//ISBN
      $adv_ISBN = $_POST['adv_ISBN'];
  }
  else{
      $adv_ISBN = "";
  }
  if(isset($_POST['adv_publisher'])){//出版社
      $adv_publisher = $_POST['adv_publisher'];
  }
  else{
      $adv_publisher = "";
  }
  if(isset($_POST['adv_publish_year_s'])){//出版日期
      $adv_publish_year_s = $_POST['adv_publish_year_s'];
  }
  else{
      $adv_publish_year_s = "";
  }
  if(isset($_POST['adv_publish_year_g'])){//出版日期
      $adv_publish_year_g = $_POST['adv_publish_year_g'];
  }
  else{
      $adv_publish_year_g = "";
  }
  if(isset($_POST['adv_create_time_s'])){//上架日期
      $adv_create_time_s = $_POST['adv_create_time_s'];
  }
  else{
      $adv_create_time_s = "";
  }
  if(isset($_POST['adv_create_time_g'])){//上架日期
      $adv_create_time_g = $_POST['adv_create_time_g'];
  }
  else{
      $adv_create_time_g = "";
  }
  if(isset($_POST['adv_class'])){//分類
      $adv_class = $_POST['adv_class'];
  }
  else{
      $adv_class = "";
  }
  if(isset($_POST['inventory'])){//有無庫存的篩選
      $adv_inventory = $_POST['inventory'];
  }
  else{
      $adv_inventory = "";
  }
  //清除所有進階搜尋session，避免搜尋結果出錯 
  unset($_SESSION['adv_bookname']);
  unset($_SESSION['adv_author']); 
  unset($_SESSION['adv_ISBN']);
  unset($_SESSION['adv_publisher']);  
  unset($_SESSION['adv_publish_year_s']); 
  unset($_SESSION['adv_publish_year_g']);
  unset($_SESSION['adv_create_time_s']);
  unset($_SESSION['adv_create_time_g']);
  unset($_SESSION['adv_class']); 
  unset($_SESSION['adv_inventory']); 
  //如果條件並且有輸入東西，則session才會被建立，session是給search.php進階搜尋時用的
  if($adv_bookname != ""){
      $_SESSION['adv_bookname'] = $adv_bookname;
  }
  if($adv_author !=""){
      $_SESSION['adv_author'] = $adv_author;
  }
  if($adv_ISBN != ""){
      $_SESSION['adv_ISBN'] = $adv_ISBN;
  }
  if($adv_publisher != ""){
      $_SESSION['adv_publisher'] = $adv_publisher;
  }
  if($adv_publish_year_s != ""){
      $_SESSION['adv_publish_year_s'] = $adv_publish_year_s;
  }
  if($adv_publish_year_g != ""){
      $_SESSION['adv_publish_year_g'] = $adv_publish_year_g;
  }
  if($adv_create_time_s != ""){
      $_SESSION['adv_create_time_s'] = $adv_create_time_s;
  }
  if($adv_create_time_g != ""){
      $_SESSION['adv_create_time_g'] = $adv_create_time_g;
  }
  if($adv_class != ""){
      $_SESSION['adv_class'] = $adv_class;
  }
  if($adv_inventory != ""){
    $_SESSION['adv_inventory'] = $adv_inventory;
  }
  $book=get_search_book("",10,1,$conn);
  /*print_r($_SESSION);
  echo "<hr>";*/
}
else if(isset($_GET["leaderboardAccordingTo"])){//熱門排行搜尋結果
  $leaderboardAccordingTo = $_GET["leaderboardAccordingTo"];
  if($leaderboardAccordingTo == "discussion"){//討論度排行
    $book=get_search_book("",7,1,$conn);
  }
  else if($leaderboardAccordingTo == "borrow"){//借閱數排行
    $book=get_search_book("",8,1,$conn);
  }
  else if($leaderboardAccordingTo == "star"){//評分排行
    $book=get_search_book("",9,1,$conn);
  }
  else{
    $book=get_search_book("",0,1,$conn);
  }
}
else{//一般搜尋(按書名)
  if(array_key_exists(("search"),$_POST)){
      $book=get_search_book($_POST['search'],1,1,$conn);
  }
  else{
      $book=get_search_book("",0,1,$conn);
  }
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
              <form action="search_php.php" method="POST">
              <input name="search"class="form-control me-2" type="search" placeholder="請輸入書籍名稱" aria-label="書籍搜尋" required>
            </div>
            <div class="col-1">
              <button class="btn btn-outline-success" type="submit">🔍</button>
           </form>
           </div>
           <div class="col-1">
             <form action="advancedSearch.php" method="POST">
              <button class="btn btn-outline-danger" type="submit">進階搜尋</button>
              </form>
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
                <div class="card-body">';
                    if($leaderboardAccordingTo == "discussion"){
                        echo'<p class="card-text"><a class="text-muted"><span style="color:red">討論度:&emsp;'.$book[$i]->commentnum.'</span></a></p>';
                    }
                    else if($leaderboardAccordingTo == "borrow"){
                        echo'<p class="card-text"><a class="text-muted"><span style="color:red">借閱總人次:&emsp;'.$book[$i]->borrownum.'</span></a></p>';
                    }
                    else if($leaderboardAccordingTo == "star"){
                        if($book[$i]->star == 0){
                            echo'<p class="card-text"><a class="text-muted"><span style="color:red">暫無評價</span></a></p>';
                        }
                        else{
                            echo'<p class="card-text"><a class="text-muted"><span style="color:red">'.sprintf('%.1f', $book[$i]->star).'★</span></a></p>';
                        }

                    }
             echo'<h4 class="card-title"><a style="text-decoration:none;"href="book.php?search='.$book[$i]->ISBN.'">'.$book[$i]->bookName.'</a></h4>';
                  if(strlen($book[$i]->describeBook)>=75){
                      echo'<p class="card-text">'.mb_substr(strip_tags ($book[$i]->describeBook),0,75).'......</p>';
                  }
                  else{
                      echo'<p class="card-text">'.$book[$i]->describeBook.'</p>';
                  }
             
             echo'<p class="card-text"><small class="text-muted">publish at&emsp;'.$book[$i]->publish_year.'</small></p>
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
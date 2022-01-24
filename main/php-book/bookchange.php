<?php
session_start();
if(!isset($_SESSION["admin"]) || $_SESSION["admin"]!=true){
  header("location:../index.php");
}
?>
<!DOCTYPE html>
<HTML>
<HEAD>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <TITLE>館藏調整</TITLE>
    <style>
    .inputt{
        width: 35%;
        height: 32px;
        border: 1px solid #84C1FF;
        /*设置边框圆角*/
        border-radius: 5px;
        padding-left: 10px;
    }
    .inputt_double{
        width: 65%;
        height: 32px;
        border: 1px solid #84C1FF;
        /*设置边框圆角*/
        border-radius: 5px;
        padding-left: 10px;
    }
    .panel-control {
        position:absolute;
        opacity:0;
    }
    .tab-group label {
        width:17.5%;
        display:inline-block;
        padding: 10px 0px;
        border:1px solid #ccc;
        border-bottom:none;
        background-color: gray;
        bottom:-6px;
        position:relative;
    }
    .content-group {
        border:1px solid #ccc;
        padding: 20px;
    }
    .content{display:none;}
    #radio1:checked ~ .tab-group [for="radio1"],
    #radio2:checked ~ .tab-group [for="radio2"],
    #radio3:checked ~ .tab-group [for="radio3"],
    #radio4:checked ~ .tab-group [for="radio4"]{background-color: #fff;}
    #radio1:checked ~ .content-group .content1,
    #radio2:checked ~ .content-group .content2,
    #radio3:checked ~ .content-group .content3,
    #radio4:checked ~ .content-group .content4 {display:block}
    .center{
        text-align:center;
    }
    @media (max-width: 767px) {
        .rwd_word{
            font-size:5px;
        }
    }
    @media (max-width: 575px) {
        .rwd_word{
            font-size:3px;
        }
        .inputt{
            width: 35%;
            height: 24px;
            border: 1px solid #84C1FF;
            /*设置边框圆角*/
            border-radius: 5px;
            padding-left: 10px;
        }
        .inputt_double{
            width: 65%;
            height: 24px;
            border: 1px solid #84C1FF;
            /*设置边框圆角*/
            border-radius: 5px;
            padding-left: 10px;
        }
    }
    @media (max-width: 420px) {
        .crawll{
            /* text-indent:-9999px; */
            width: 80%;
           
    }
    </style>
</HEAD>
<BODY>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
          <a href="../welcome.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <img width="50px" height="50px"src="../ntou_logo.png">
          </a>
          <span class="fs-1">海大資工系圖書館系統<span class="fs-2">-館藏調整</span></span>
    
          <div class="col-md-3 text-end">
          <?php 
        
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
    
    <div id="rwd_a" class="panel-group container" style="width:60%;">
        <input type="radio" name="panel-radio" id="radio1" class="panel-control" checked>
        <input type="radio" name="panel-radio" id="radio2" class="panel-control">
        <input type="radio" name="panel-radio" id="radio3" class="panel-control">
        <input type="radio" name="panel-radio" id="radio4" class="panel-control">
        <div class="tab-group">
          <label for="radio1" class="active rwd_word">上架書籍</label>
          <label for="radio2" class="rwd_word">下架書籍</label>
          <label for="radio3" class="rwd_word">館藏調整</label>
          <label for="radio4" class="rwd_word">刪除書籍</label>
        </div>
        <div class="content-group"style="background-color: #fff;" >
            <!-- 上架書籍-->
            <div class="content content1" style="height:500px;" >
                <form action="create.php" method="post" enctype="multipart/form-data">
                    <p class="rwd_word">&emsp;&emsp;&emsp;&ensp;&thinsp;ISBN：<input  class="inputt" name="ISBN" id="ISBN"type="text">&emsp;<button  type="button" id="crawl" class="crawll">自動爬取書籍資料</button></p>
                    <p class="rwd_word">&emsp;&emsp;&emsp;&emsp;書名：<input class="inputt" name="bookName" id="bookName" type="text" ></p>
                    <p class="rwd_word">&emsp;&emsp;&ensp;&ensp;&ensp;&ensp;分類：<select class="inputt" id="class" name="class" maxlength="30" ><option value="總類">總類</option><option value="哲學類">哲學類</option><option value="宗教類">宗教類</option><option value="自然科學類">自然科學類</option><option value="應用科學類">應用科學類</option><option value="社會科學類">社會科學類</option><option value="中國史地類">中國史地類</option><option value="外國史地類">外國史地類</option><option value="語文類">語文類</option><option value="美術類">美術類</option></select></p>
                    <p class="rwd_word">&emsp;&emsp;&emsp;&emsp;作者：<input class="inputt" name="author" id="author"type="text"></p>
                    <p class="rwd_word">&emsp;&emsp;&ensp;&ensp;&ensp;&ensp;數量：<input class="inputt" name="num" type='number' min='0'value='1' onkeyup="value=value.replace(/^(0+)|[^\d]+/g,'')"></p>
                    <p class="rwd_word">&emsp;&emsp;&emsp;出版社：<input class="inputt" name="publisher"id="publisher" type="text"></p>
                    <p class="rwd_word">&emsp;&emsp;出版日期：<input class="inputt" name="publish_year" id="publish_year" type="text" ></p>
                    <p class="rwd_word">&emsp;&emsp;&emsp;&emsp;簡介：<input class="inputt_double" name="describeBook" id="describeBook" type="text" ></p>
                    <p class="rwd_word">書籍圖片網址：<input class="inputt_double" name="img_url" id="img_url" type="text"></p>
                    <p class="rwd_word">&emsp;&emsp;書籍圖片：<input name="image" type="file" accept="image/png, image/jpeg,image/gif"></p>
                    <p class="rwd_word center"><input type="submit" value="上架"/>&emsp;&emsp;&emsp;<input type="reset" value="清除"></p>
                </form>
            </div>
            <div class="content content2" style="height:500px;">
                <!--下架書籍 -->
                <form action="delete.php" method="POST">
                    <p class="rwd_word">&emsp;&emsp;&emsp;&ensp;&thinsp;ISBN：<input name="ISBN" class="inputt" id="takeoff_ISBN"type="text">&emsp;<button id='takeoff'type="button">館內搜尋</button>&emsp;<input type="reset" value="清除"></p>
                    
                
                    <p class="rwd_word">&emsp;&emsp;&emsp;&ensp;書名為:<div id="takeoff_name"></div>&emsp;</p>
                    <p class="rwd_word">&emsp;&emsp;&emsp;&ensp;作者為:<div id="takeoff_author"></div>&emsp;</p>
                    <p class="rwd_word center"><input type="submit" value="下架">&emsp;&emsp;&emsp;</p>
                </form>
            </div>
            <div class="content content3" style="height:500px;">
                <form action="update.php" method="POST">
                    <p class="rwd_word">&emsp;&emsp;&emsp;&ensp;&thinsp;ISBN：<input class="inputt" name="ISBN"id="update_ISBN" type="text">&emsp;<button type="button" id="update">館內搜尋</button></p>
                    <p class="rwd_word">&emsp;&emsp;&emsp;&emsp;書名：<input class="inputt" id="update_bookName" name="bookName" type="text" ></p>
                    <p class="rwd_word">&emsp;&emsp;&ensp;&ensp;&ensp;&ensp;分類：<select class="inputt" id="update_class" name="class" maxlength="30" style="border-color:#84C1FF;"><option id="update_總類" value="總類">總類</option><option id="update_哲學類" value="哲學類">哲學類</option><option value="宗教類">宗教類</option><option value="自然科學類">自然科學類</option><option value="應用科學類">應用科學類</option><option value="社會科學類">社會科學類</option><option value="中國史地類">中國史地類</option><option value="外國史地類">外國史地類</option><option value="語文類">語文類</option><option value="美術類">美術類</option></select></p>
                    <p class="rwd_word">&emsp;&emsp;&emsp;&emsp;作者：<input class="inputt" name="author"id="update_author" type="text" ></p>
                    <p class="rwd_word">&emsp;&emsp;&ensp;&ensp;&ensp;&ensp;數量：<input class="inputt" name="num"id="update_num" type='number' min='0' onkeyup="value=value.replace(/^(0+)|[^\d]+/g,'')"></p>
                    <p class="rwd_word">&emsp;&emsp;&emsp;出版社：<input class="inputt" name="publisher"id="update_publisher" type="text" ></p>
                    <p class="rwd_word">&emsp;&emsp;出版日期：<input class="inputt" name="publish_year"id="update_publish_year" type="text" ></p>
                    <p class="rwd_word">&emsp;&emsp;&emsp;&emsp;簡介：<input class="inputt_double" name="describeBook" id="update_describeBook"type="text" ></p>
                    <p class="rwd_word">書籍圖片網址：<input class="inputt_double" name="img_url" id="update_img_url" type="text"></p>
                    <p class="rwd_word">&emsp;&emsp;書籍圖片：<input name="image" type="file" accept="image/png, image/jpeg,image/gif"></p>
                    
                    <p class="rwd_word" style="text-align:center;"><input type="submit" value="送出修改">&emsp;<input type="submit" value="清除"></p>
                </form>
            </div>
            <div class="content content4" style="height:500px;">
                <form action="delete_lost_book.php" method="POST">
                    <p class="rwd_word">&emsp;&emsp;&emsp;&emsp;書號：<input class="inputt" id="bookuniqueID" name="bookuniqueID" type="text">&emsp;<input type="submit" value="刪除此書"></p>
                </form>
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
</BODY>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script >
    $(document).ready(function(){
            $('#crawl').click(function(){
                $.ajax({
                    type: "POST",
                    url: "search_ISBN.php",
                    data : {ISBN : $('#ISBN').val()},
                    success:function(data){
                        
                        var data = JSON.parse(data);
                        document.getElementById("bookName").value = data.book_name;
                        document.getElementById("author").value = data.author;
                        document.getElementById("describeBook").value = data.text;
                        document.getElementById("publisher").value = data.company;
                        document.getElementById("publish_year").value = data.date;
                        document.getElementById("img_url").value = data.img_url;
                    }
                })
            })
            $('#takeoff').click(function(){
                $.ajax({
                    type: "POST",
                    url: "search.php",
                    data : {search : $('#takeoff_ISBN').val(),modeNum:4},
                    success:function(data){
                        
                        var data = JSON.parse(data)
                        //console.log(document.getElementById("takeoff_bookNames").innerHTML);
                        
                        //document.getElementById("takeoff_bookNames").innerHTML = data.author;
                        if(data.bookName!=""){
                            document.getElementById("takeoff_name").innerHTML = "&emsp;&emsp;&emsp;&ensp;"+data.bookName;
                        }
                        if(data.author!=""){
                            document.getElementById("takeoff_author").innerHTML="&emsp;&emsp;&emsp;&ensp;"+data.author;
                        }
                        
                        
                    },
                    error:function(e){
                        alert(e);
                    }
                })
            })
            $('#update').click(function(){
                $.ajax({
                    type: "POST",
                    url: "search.php",
                    data : {search : $('#update_ISBN').val(),modeNum:5},
                    success:function(data){
                        try{
                           var data = JSON.parse(data)
                        //console.log(document.getElementById("takeoff_bookNames").innerHTML);
                        
                        //document.getElementById("takeoff_bookNames").innerHTML = data.author;
                        document.getElementById("update_bookName").value = data.bookName;
                        document.getElementById("update_author").value=data.author;
                        document.getElementById("update_class").value=data.class;
                        document.getElementById("update_publisher").value=data.publisher;
                        document.getElementById("update_publish_year").value=data.publish_year;
                        document.getElementById("update_num").value=data.num;
                        document.getElementById("update_img_url").value=data.img;
                        document.getElementById("update_describeBook").value=data.describeBook; 
                        }catch{
                            alert("查無此書");
                        }
                        
                        
                    },
                    error:function(){
                        alert("查無此書");
                    }
                })
            })
        });
</script>
<script>
    rwd();
    window.addEventListener('resize', rwd);
    function rwd(){
        if(false){
            

        }
        else if(document.documentElement.clientWidth>=768 && document.documentElement.clientWidth<1268){
            var sizePercentage = 60+(1368-document.documentElement.clientWidth)/20;
            document.getElementById('rwd_a').setAttribute("style","width:"+sizePercentage+"%;");
        }
        else if(document.documentElement.clientWidth>=576 && document.documentElement.clientWidth<768){ 
            document.getElementById('rwd_a').setAttribute("style","width:90%;");
        }
        else if(document.documentElement.clientWidth<576){ 
            document.getElementById('rwd_a').setAttribute("style","width:90%;");
        }
        else{//document.documentElement.clientWidth>1368
            document.getElementById('rwd_a').setAttribute("style","width:60%;");
        }
    }
</script>

</HTML>

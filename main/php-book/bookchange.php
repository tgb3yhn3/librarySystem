<!DOCTYPE html>
<HTML>
<HEAD>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="frontpage.css?v=<?=time()?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <TITLE>館藏查詢</TITLE>
</HEAD>
<BODY>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <a href="https://www.ntou.edu.tw/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <img width="50px" height="50px" src="ntou_logo.png">
            </a>
            <span class="fs-1">海大資工系圖書館系統<span class="fs-2">-上下架</span></span>

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
    <span id="tab-1">上架</span>
    <span id="tab-2">下架</span>
    <span id="tab-3">館藏調整</span>
    
    
       

    
    
    <div id="tab">
        <ul>
            <li><a href="#tab-1">上架</a></li>
            <li><a href="#tab-2">下架</a></li>
            <li><a href="#tab-3">館藏調整</a></li>
        </ul>

        <!-- 頁籤的內容區塊 -->
        <div class="tab-content-1">
            <!-- create Book -->
            <form action="create.php" method="post" enctype="multipart/form-data">
            <br>
            <p>書名:&emsp;<input name="bookName" id="bookName" type="text" size="20" maxlength="30" style="border-color:#84C1FF;">&emsp;分類:&emsp;<input name="class" type="text" size="3" maxlength="30" style="border-color:#84C1FF;">&emsp;</p>
            <p>作者:&emsp;<input name="author" id="author"type="text" size="12" maxlength="30" style="border-color:#84C1FF;">&emsp;ISBN:&emsp;<input name="ISBN" id="ISBN"type="text" size="10" maxlength="30" style="border-color:#84C1FF;">&emsp;</p>
            <p>出版日期:<input name="publish_year" id="publish_year" type="text" size="10" maxlength="30" style="border-color:#84C1FF;">出版社:<input name="publisher"id="publisher" type="text" size="5" maxlength="30" style="border-color:#84C1FF;"></p>
            <p>數量:<input name="num" type="text"value="1" size="1" maxlength="30" style="border-color:#84C1FF;">簡介:&emsp;<input name="describeBook" id="describeBook" type="text" size="20" maxlength="30" style="border-color:#84C1FF;"></p>
            <p>書籍圖片網址<input name="img_url" id="img_url" type="text" size="30" maxlength="30" style="border-color:#84C1FF;"></p>
            <p>書籍圖片&emsp;<input name="image" type="file" accept="image/png, image/jpeg,image/gif" size="1" maxlength="30" style="border-color:#84C1FF;"></p>
            
           <p><input type="submit" value="上架"/>&emsp;&emsp;&emsp;<input type="reset" value="清除">&emsp;<button type="button"id="crawl">自動爬取書籍資料</button></p>
            
            
        </form>
        
        </div>
        <div class="tab-content-2" margin:0 auto>
            <form action="delete.php" method="POST">
                <br>
                <!--Delete Book  -->
           <p>ISBN:&emsp;<input name="ISBN"  id="takeoff_ISBN"type="text" size="10" maxlength="30" style="border-color:#84C1FF;">&emsp;<button id='takeoff'type="button">館內搜尋</button>&emsp;<input type="reset" value="清除"></p>
            
            
        
           <p>書名為:<div id="takeoff_name"></div>&emsp;</p>
            <p>作者為:<div id="takeoff_author"></div>&emsp;</p>
            <p>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="submit" value="刪除">&emsp;&emsp;&emsp;</p>
        </form>
    </div>
    <div class="tab-content-3">
        <!-- updateBook -->
        <form action="update.php" method="POST">
            <br>
            <p>書名:&emsp;<input id="update_bookName" name="bookName" type="text" size="20" maxlength="30" style="border-color:#84C1FF;">&emsp;分類:&emsp;<input name="class"id="update_class" type="text" size="3" maxlength="30" style="border-color:#84C1FF;">&emsp;</p>
            <p>作者:&emsp;<input name="author"id="update_author" type="text" size="12" maxlength="30" style="border-color:#84C1FF;">&emsp;ISBN:&emsp;<input name="ISBN"id="update_ISBN" type="text" size="10" maxlength="30" style="border-color:#84C1FF;">&emsp;</p>
            <p>出版日期:<input name="publish_year"id="update_publish_year" type="text" size="5" maxlength="30" style="border-color:#84C1FF;">出版社:<input name="publisher"id="update_publisher" type="text" size="5" maxlength="30" style="border-color:#84C1FF;">&emsp;<button type="button" id="update">館內搜尋</button></p>
            <p>數量:<input name="num"id="update_num" type="text" size="1" maxlength="30" style="border-color:#84C1FF;">簡介:&emsp;<input name="describeBook" id="update_describeBook"type="text" size="20" maxlength="30" style="border-color:#84C1FF;"></p>
            <p>書籍圖片網址<input name="img_url" id="update_img_url" type="text" size="30" maxlength="30" style="border-color:#84C1FF;"></p>
            <p>書籍圖片&emsp;<input name="image" type="file" accept="image/png, image/jpeg,image/gif" size="1" maxlength="30" style="border-color:#84C1FF;"></p>
            
            <p>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="submit" value="送出修改">&emsp;&emsp;&emsp;<input type="submit" value="清除"></p>
        </form>
        </div>
        
       
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
                        document.getElementById("takeoff_name").innerHTML = data.bookName;
                        document.getElementById("takeoff_author").innerHTML=data.author;
                        
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
</HTML>

<?php 
session_start();
if(!isset($_SESSION["admin"]) || $_SESSION["admin"]!=true){
  header("location:../index.php");
}
?>
<!DOCTYPE html>
<HTML>
<HEAD>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>系統公告</title>
</HEAD>
<BODY>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> -->
    <div class="container">
      <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <a href="../welcome.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
          <img width="50px" height="50px"src="../ntou_logo.png">
        </a>
        <span class="fs-1">海大資工系圖書館系統<span class="fs-2">-編輯系統公告</span></span>
  
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
    <div class="container">
        <div class="row ">
            <div class="text-right col-11">
                <button id="addNew"  class="btn btn-info col-2 ">新增</button>
            </div>
        </div>
    </div>
    
    <br>
    <div class="container">
        <div class="row justify-content-center">    
            <div class="card col-10 comment_scroll">
                <div id="announcement_area" class="list-group list-group-flush">
          
                </div>
            </div>   
        </div>
    </div>
    
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top ">
          <p class="col-md-4 mb-0 text-muted">&copy; 2021 Company, Inc</p>
          <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="../welcome.php" class="nav-link px-2 text-muted">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
          </ul>
        </footer>
    </div>
    <div id="delete_formlist"></div>
    <div id="edit_formlist"></div>
    <div id="addWindow" title="新增公告">
            <form method="post" action="announcement_API.php">
                <input name="action" value="add" type="hidden">
                公告標題：<br><input    name="title" type="text" required="required" style="width:100%;"><br>
                公告內容：<br><textarea name="message" required="required" style="min-height:80%;max-height:80%;min-width:100%;max-width:100%;"></textarea><br>
                傳送給<input  name="sent_to"   value="" placeholder="請輸入使用者學號，若要傳送給全體使用者，則不用輸入" type="text"  style="width:35%;">
                <input class="btn btn-primary" onClick="javascript: return confirm('確認新增公告?');" value="送出" type="submit" >
            </form>
        </div>
    <div id="editWindow" title="修改公告">
        <form method="post" action="announcement_API.php">
            <input name="action" value="edit" type="hidden">
            <input id="input_edit_ID" name="ID" value="" type="hidden">
            公告標題：<br><input    id="input_edit_titie" name="title"   value="" type="text" required="required" style="width:100%;"><br>
            公告內容：<br><textarea id="input_edit_message" name="message"  required="required" style="min-height:80%;max-height:80%;min-width:100%;max-width:100%;"></textarea><br>
            傳送給<input  name="sent_to" id="input_edit_sent_to" value="" placeholder="請輸入使用者學號，若要傳送給全體使用者，則不用輸入" type="text"  style="width:35%;">
            <input class="btn btn-primary" onClick="javascript: return confirm('確認修改公告?');" value="送出" type="submit" >
        </form>
    </div>
    <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
        <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
        <script type="text/javascript">
            //將從資料庫抓到的資料輸出成公告欄的項目
            const jsonUrl = "announcement_view_API.php";
            $.getJSON(jsonUrl, function (data) {
                for (let item in data) {
                    let content =
                    "<div class='d-flex w-100 align-items-center justify-content-between' class='list-group-item'>" +
                            "<a href='announcement_detail_view_API.php?ID="+data[item].ID+"' class='list-group-item col-10'>"+ 
                                "<div class='d-flex w-100 align-items-center justify-content-between'>" +
                                    "<strong class='mb-1' >"+data[item].title+"</strong>"+
                                    "<small class='text-muted'>"+data[item].annouceTime+"</small>"+
                                "</div>"+
                            "</a>"+
                            "<input id='edit"+data[item].ID+"' type='button' value='編輯' class='btn btn-outline-success btn-sm col-1 mr-2'>"+
                            "<input onClick=\"javascript: return confirm('確認刪除公告?');\" type='submit' value='刪除' form=delete_"+data[item].ID+" class='btn btn-outline-danger btn-sm col-1'>"+
                    "</div>";
                    $("#announcement_area").append(content);
                        
                    let content2 = 
                    "<form action='announcement_API.php' method='post' id=delete_"+data[item].ID+">"+
                        "<input name='action' value='delete' type='hidden'>" +
                        "<input name='ID' value="+data[item].ID+" type='hidden'>" +
                    "</form>";
                    $("#delete_formlist").append(content2);

                    //「修改公告」按鈕按下去後，會打開「修改公告小視窗」
                    $( "#edit"+data[item].ID ).click(function() {
                        $( "#editWindow" ).dialog( "open" );
                        $( "#input_edit_ID" ).val(data[item].ID);
                        $( "#input_edit_titie" ).val(data[item].title);
                        $( "#input_edit_message" ).html(data[item].message);
                        $( "#input_edit_sent_to" ).val(data[item].sent_to);

                    });
                }
            });
            //「新增公告小視窗」預設為隱藏
            $(function() {
                    $( "#addWindow" ).dialog({autoOpen: false,height:window.innerHeight*0.99,width:window.innerWidth*0.99});
                });

                //「修改公告小視窗」預設為隱藏
                $(function() {
                    $( "#editWindow" ).dialog({autoOpen: false,height:window.innerHeight*0.99,width:window.innerWidth*0.99});
                });

                //「新增公告」按鈕按下去後，會打開「新增公告小視窗」
                $( "#addNew" ).click(function() {
                        $( "#addWindow" ).dialog( "open" );
                });

        </script>
</BODY>
</HTML>
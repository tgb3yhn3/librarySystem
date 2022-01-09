<?php
session_start();
if(!isset($_SESSION["admin"]) || $_SESSION["admin"]!=true){
  header("location:../index.php");
}
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
    <title>黑名單</title>
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> -->
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
          <a href="../welcome.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <img width="50px" height="50px"src="../ntou_logo.png">
          </a>
          <span class="fs-1">海大資工系圖書館系統<span class="fs-2">-黑名單</span></span>
    
          <div class="col-md-3 text-end">
            <button type="button" class="btn btn-outline-primary me-2" disabled><?php echo $_SESSION['username']?></button>
           <?php echo '
            <div class="btn-group">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="../php-member/logout.php" class="text-decoration-none"><button type="button" class="dropdown-item ">登出</button></a>
                <a href="../php-member/change.php" class="text-decoration-none"><button type="button" class="dropdown-item ">修改密碼</button></a>
            </div>
          </div>
          ';?>
          </div>
        </header>
    </div>

      <div class="container" id="formlist">
        <table class="table align-middle">
            <thead class="table-dark">
              <tr>
                <th scope="col">學號</th>
                <th scope="col">姓名</th>
                <th scope="col">原因</th>
                <th scope="col">編輯</th>
              </tr>
            </thead>
            <br>
            <tbody  id="menu">
              <!-- <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td><button type="button" class="btn btn-outline-primary me-2">刪除</button></td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td><button type="button" class="btn btn-outline-primary me-2">刪除</button></td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Larry the Bird</td>
                <td>@twitter</td>
                <td><button type="button" class="btn btn-outline-primary me-2">刪除</button></td>
              </tr> -->

            </tbody>
          </table>
          <div class="d-grid gap-2">
            <button class="btn btn-outline-primary me-2" type="button" id="addNew">新增</button>
          </div>
      </div>
      <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
          <p class="col-md-4 mb-0 text-muted">&copy; 2021 Kamel, Inc</p>
      
      
          <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="../welcome.php" class="nav-link px-2 text-muted">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
          </ul>
        </footer>
      </div>
      <div id="addWindow" title="新增使用者到黑名單">
          <form method="post" action="blackList_API.php">
              <input name="action" type="hidden" value="add"><br>
              使用者學號:<br><input name="userID" type="text" required="required" style="width:25%;"placeholder="請輸入使用者學號"><br>
              原因:<br><input name="reason" type="text" style="width:100%;"placeholder="請輸入該使用者被加入黑名單原因"><br><br>
              <input  class="btn btn-primary" type="submit" value="加入到黑名單">
          </form>
     </div> 
     <div id="editWindow" title="編輯使用者被加入黑名單原因">
          <form method="post" action="blackList_API.php">
              <input  name="action" type="hidden" value="edit">
              <input id="userID_edit1" name="userID" type="hidden" value="">
              使用者：<span id="username_edit"></span>(<span id="userID_edit2"></span>)<br><br>
              原因:<br><input id="reason_edit" name="reason" type="text" style="width:100%;" placeholder="請輸入該使用者被加入黑名單原因"><br><br>
              <input  class="btn btn-primary" type="submit" value="確認修改">
          </form>
     </div>   
      
  </body>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
  <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
  <script type="text/javascript">
        
    /*將從資料庫抓到的資料輸出成html的table*/
    const jsonUrl = "view_blackList_API.php";
    $.getJSON(jsonUrl, function (data) {
        for (let item in data) {
            let content =
                "<tr>" +
                "<td>" + data[item].userID + "</td>" +
                "<td>" + data[item].username + "</td>" +
                "<td>" + data[item].reason +"</td>" +
                "<td>" + "<input type='button' class='btn btn-outline-success btn-sm ' id='editReason"+data[item].userID+"' value='編輯原因'>&emsp;" + "<input type='submit' class='btn btn-outline-danger btn-sm ' value='刪除' form="+data[item].userID+">" +"</td>" +
                "</tr>";
            $("#menu").append(content);

            let content2 =  "<form action='blackList_API.php' method='post' id="+data[item].userID+">"+
                            "<input name='userID'   type='hidden' value="+data[item].userID   +">"+
                            "<input name='username' type='hidden' value="+data[item].username +">"+
                            "<input name='reason'   type='hidden' value="+data[item].reason   +">"+
                            "<input name='action'   type='hidden' value='delete'>"+
                            "</form>";
            $("#formlist").append(content2);

            //「修改公告」按鈕按下去後，會打開「修改公告小視窗」
            $( "#editReason"+data[item].userID).click(function() {
                $( "#editWindow" ).dialog( "open" );
                $( "#userID_edit1" ).val(data[item].userID);
                $( "#userID_edit2" ).html(data[item].userID);
                $( "#username_edit" ).html(data[item].username);
                $( "#reason_edit" ).val(data[item].reason);
            });
        }
    });

    //「新增黑名單小視窗」預設為隱藏
    $(function() {
        $( "#addWindow" ).dialog({autoOpen: false,height:window.innerHeight*0.7,width:window.innerWidth*0.7});
    });

    //「編輯使用者被加入黑名單原因」預設為隱藏
    $(function() {
        $( "#editWindow" ).dialog({autoOpen: false,height:window.innerHeight*0.7,width:window.innerWidth*0.7});
    });

    //「新增」按鈕按下去後，會打開「新增黑名單小視窗」
        $( "#addNew" ).click(function() {
            $( "#addWindow" ).dialog( "open" );
    });
</script>
</html>
<?php
//myFavoriteBook.php
session_start();
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
    <title>我的最愛</title>
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
          <span class="fs-1">海大資工系圖書館系統<span class="fs-2">-我的最愛</span></span>
    
          <div class="col-md-3 text-end">
            <button type="button" class="btn btn-outline-primary me-2" disabled><?php echo $_SESSION['username']?></button>
            <a href="../php-member/logout.php"><button type="button" class="btn btn-primary">登出</button></a>
          </div>
        </header>
    </div>

      <div class="container" id="formlist">
        <table class="table align-middle">
            <thead class="table-dark" >
              <tr>
                <th style="text-align:center;" scope="col">書名</th>
                <th style="text-align:center;" scope="col">ISBN</th>
                <th style="text-align:center;" scope="col">編輯</th>
              </tr>
            </thead>
            <br>
            <tbody id="menu"  >

            </tbody>
          </table>
          <a></a>
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
  </body>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
  </script>
  <script type="text/javascript">
        
     /*將從資料庫抓到的資料輸出成html的table*/
     const jsonUrl = "viewFavoriteBook_API.php";
        var odd = 1;
        var color_controller;
        $.getJSON(jsonUrl, function (data) {

            for (let item in data) {
                if(odd==1){
                    color_controller = "#FFF6D9";
                    console.log(odd);
                }
                else{
                    color_controller = "#EEE6D9";
                    console.log(odd);
                }
                let content =
                    "<tr bgcolor="+color_controller+">" +
                    "<td style='border-right:2px white solid;'><a href='../php-book/book.php?search="+data[item].ISBN+"'>" + data[item].bookName + "</a></td>" +
                    
                    "<td style='border-right:2px white solid; text-align:center;'>" + data[item].ISBN + "<input type='hidden' name='ISBN' value="+data[item].ISBN+" form="+data[item].ISBN+">" + "</td>" +
                    "<td style=' text-align:center;'>" + "<input type='submit' class='btn btn-outline-primary'  value='從最愛清單刪除' form="+data[item].ISBN+">" + "</td>" +
                    "</tr>";
                $("#menu").append(content);
                let content2 = "<form action='favoriteBook_API.php' method='post' id="+data[item].ISBN+"></form>"
                $("#formlist").append(content2);
                if(odd==1){
                    odd=0;
                }
                else{
                    odd=1;
                }
            }
        });

</script>
</html>
<?php
session_start();
         
if(!isset($_SESSION["admin"]) || $_SESSION["admin"]!=true){
  header("location:../index.php");
}
?>
<!DOCTYPE html>
<HTML>
<HEAD>
    <script>
        function rent_post(){
            book.action = "rent_book.php";
            book.submit();
        }
        function return_post(){
            book.action = "return_book.php";
            book.submit();
        }
    </script>
    <!-- <link rel="stylesheet" type="text/css" href="frontpage.css"> -->
    <!-- Required meta tags -->
    <meta charset="utf-8">

   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" rel="preload" as="style" onload="this.rel='stylesheet';this.onload=null"
    href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
  <!-- <link rel="stylesheet" rel="preload" as="style" onload="this.rel='stylesheet';this.onload=null"
    href="https://unpkg.com/normalize.css@8.0.0/normalize.css">
  <link rel="stylesheet" rel="preload" as="style" onload="this.rel='stylesheet';this.onload=null"
    href="https://unpkg.com/milligram@1.3.0/dist/milligram.min.css"> -->
    <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
 <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
 <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Borrow_return!</title>
</HEAD>
<BODY>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> -->
    <div class="container">
        
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <a href="../welcome.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <img width="50px" height="50px" src="ntou_logo.png">
            </a>
            <span class="fs-1">海大資工系圖書館系統<span class="fs-2">-借還書</span></span>
            
            <div class="  col-md-3 text-end">
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
    <br><br>
            
           
    <div class="container">
        <div class="row border justify-content-center  " >
              <div class=" col-4 h-100 ">
                <br>
                

      <div class="container">
        <video id="video" width="300" height="200" style="border: 1px solid gray"></video>
      </div>

                <form name="book" method="POST" style="width:atuo; text-align:center;">
                
                    &emsp;學號:
                    <input name="userID" type="text"id="IDresult" >
                     &emsp;
                <br>
                <br>
                
                    &emsp;書號:
                    <input name="bookuniqueID" type="text" id="result">  &emsp;
                    <br>
                    <br>
                  &emsp;<input type="submit" value="出借" onClick="rent_post()">&emsp;<input type="reset" value="還書" onClick="return_post()">
                
            </form>
              </div>
        </div>
    </div>
    <br>
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

<script type="text/javascript" src="https://unpkg.com/@zxing/library@latest/umd/index.min.js"></script>
  <script type="text/javascript">
    window.addEventListener('load', function () {
      let selectedDeviceId;
      const codeReader = new ZXing.BrowserMultiFormatReader()
      console.log('ZXing code reader initialized')
      codeReader.listVideoInputDevices()
        .then((videoInputDevices) => {
        //   const sourceSelect = document.getElementById('sourceSelect')
          selectedDeviceId = videoInputDevices[0].deviceId
        //   if (videoInputDevices.length >= 1) {
        //     videoInputDevices.forEach((element) => {
        //       const sourceOption = document.createElement('option')
        //       sourceOption.text = element.label
        //       sourceOption.value = element.deviceId
        //     //   sourceSelect.appendChild(sourceOption)
        //     })

        //     // sourceSelect.onchange = () => {
        //     //   selectedDeviceId = sourceSelect.value;
        //     // };

        //     // const sourceSelectPanel = document.getElementById('sourceSelectPanel')
        //     // sourceSelectPanel.style.display = 'block'
        //   }

          
            codeReader.decodeFromVideoDevice(selectedDeviceId, 'video', (result, err) => {
              if (result) {
                console.log(result)
                if(result.text.includes("_"))
                document.getElementById('result').value = result.text
                else
                document.getElementById('IDresult').value = result.text
              }
              if (err && !(err instanceof ZXing.NotFoundException)) {
                console.error(err)
                document.getElementById('result').textContent = err
              }
            })
            console.log(`Started continous decode from camera with id ${selectedDeviceId}`)
          
      
        })
        .catch((err) => {
          console.error(err)
        })
    })
  </script>
</HTML>
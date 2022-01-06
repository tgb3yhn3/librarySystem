<?php
  require_once ("html2pdf_query_API.php");
  $conn = require_once 'config.php';
  $ISBN = $_GET["ISBN"];
  $bookuniqueID = $_GET["bookuniqueID"];
  $userID = $_GET["userID"];
  $datas = BorrowReturnBook_query_API($bookuniqueID,$conn);
  $userName = userName_query_API($userID,$conn);
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <title>HTML2PDF</title>
        <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js" defer></script>
        <script src="./script.js" defer></script>
        <script type="text/javascript">
            function main() {
                var view = document.getElementById("view");
                var exportPDF = document.getElementById("export-pdf");
                var options = { filename: "還書憑據_<?php echo $userName[0]['username']?>.pdf"};
                exportPDF.onclick = (e) => html2pdf(view,options);
            }
        </script>
        <style>
          .pdf_btn{
            position:absolute;
            text-align: center;
            left: 47%;
          }
        </style>
    </head>

    <body onload="main()">
    <div class="container">
      <div class="row justify-content-center">
        <div id="view">
          <div class="card  ">
            <div class="card-header text-center"><h4>還書憑據</h4></div>
            <div class="card-body">
              <h>名字 : <?php echo $userName[0]['username']?></h>
              <br>
              <h>學號 : <?php echo $datas[0]['userID']?></h>
              <br>
              <h>書名 : <?php echo $datas[0]['book_name']?></h>
              <br>
              <h>借書日期:<?php echo $datas[0]['start_rent_date']?></h>
              <br>
              <h>還書日期:<?php echo date("Y-m-d H:i:s");?></h>
            </div>
          </div>
        </div> 
      </div>
      <br> 
    </div>  <button id="export-pdf" class="pdf_btn">Export PDF</button>
    </body>

</html>

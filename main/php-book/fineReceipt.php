<?php
  require_once ("html2pdf_query_API.php");
  $conn = require_once 'config.php';
  $ISBN = $_GET["ISBN"];
  $bookuniqueID = $_GET["bookuniqueID"];
  $userID = $_GET["userID"];
  $late_total_date = $_GET["late_total_date"];
  $start_rent_date = $_GET["start_rent_date"];
  $return_date = $_GET["return_date"];
  $book_name = $_GET["book_name"];
  $lasting_return_date = $_GET["lasting_return_date"];
  $book_fine = $_GET["book_fine"];
  $total_fine = $_GET["total_fine"];
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
                var options = { filename: '罰款憑據<?php echo $userName[0]['username']?>.pdf'};
                exportPDF.onclick = (e) => html2pdf(view,options);
            }
        </script>
    </head>

    <body onload="main()" >
      <div id="view">
      <div style="border-width:3px;border-style:dashed;border-color:#FFAC55;padding:5px;">
      <div style="border-width:3px;border-style:dashed;border-color:#FFAC55;padding:5px;">
      <div style="border-width:3px;border-style:dashed;border-color:#FFAC55;padding:5px;">
      <div class="card " style="max-width: 760px;">
      <div class="row g-0">
        
        <div class="col-md-7">
          <div class="card-body">
            <h4 class="card-title text-center">*****罰款憑據*****</h4>
            <p class="card-text">
            <h>名字 : <?php echo $userName[0]['username']?></h>
            <br>
            <h>學號 : <?php echo $userID?></h>
            <br>
            <h>書名 : <?php echo $book_name?></h>
            <br>
            <h>總遲還天數 : <?php echo $late_total_date?></h>
            <br>
            <h>倍率 : <?php echo $book_fine?></h>
            <br>
            <h>最晚還書日期 : <?php echo $lasting_return_date?></h>
            <br>
            <h>借書日期:<?php echo $start_rent_date?></h>
            <br>
            <h>還書日期:<?php echo $return_date?></h>
            <br>
            <h>金額:<?php echo $total_fine?></h></p>
          </div>
        </div>
        <div class="col-md-5">
          <img src="001.png" class="img-fluid rounded-start" style="max-width: 340px;" >
        </div>
      </div>
      </div>
      </div>
      </div>
      </div>
      </div>
      <br>
      <button id="export-pdf">Export PDF</button>
        
    </body>
    
</html>

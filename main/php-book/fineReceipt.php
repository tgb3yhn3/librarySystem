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
        <p>出借憑據</p>
        <br>
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
        <h>金額:<?php echo $total_fine?></h>
      </div>
      <br>
      <button id="export-pdf">Export PDF</button>
        
    </body>
    
</html>

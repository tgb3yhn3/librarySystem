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
    </head>

    <body onload="main()">
      <div id="view">
        <p>還書憑據</p>
        <br>
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
      <br>
      <button id="export-pdf">Export PDF</button>
        
    </body>

</html>
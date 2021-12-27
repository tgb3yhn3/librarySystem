
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
                var options = { filename: '罰金憑據.pdf'};
                exportPDF.onclick = (e) => html2pdf(view,options);
            }
        </script>
    </head>

    <body onload="main()" align="center">
      <div id="view">
        <h>罰金憑據</h>
        <br>
        <h>名字:</h>
        <br>
        <h>學號:</h>
        <br>
        <h>書名:</h>
        <br>
        <h>逾期天數:</h>
        <br>
        <h>罰金金額:</h>
      </div>
      <button id="export-pdf">Export PDF</button>
        
    </body>

</html>

<?php
    require_once('bookAPI.php');
    $conn=require_once("config.php");
    require_once("html2pdf_query_API.php");
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $bookuniqueID=$_POST["bookuniqueID"];
        $array = str_split($bookuniqueID);
        $ISBN = '';
        for($i=0;$i<13;$i++){
            $ISBN = $ISBN.$array[$i];
        }
        if(check_book_exist($bookuniqueID,$conn)){//看這個書存不存在
            if(check_book_status($bookuniqueID,$conn)){//查看此書是否在圖書館內
                delete_the_book($bookuniqueID,$conn);//刪掉TODO
                if(get_book_name($ISBN,$conn)){
                    adjust_book_num($ISBN,-1,$conn);//調整數量
                }
                else{} 
                echo"<script>alert('刪除成功');history.go(-1);</script>";
                exit;        
            }
            else{
                $userID = adjust_special_user_book_history($bookuniqueID,$conn);//調整user_book_history
                adjust_user_condition($userID,-1,$conn);//調整使用者正在借閱的數量//調整user的renting_book_num 
                adjust_credit($userID,-1,$conn);//調整user的credit
                delete_the_book($bookuniqueID,$conn);//刪掉TODO
                if(get_book_name($ISBN,$conn)){
                    adjust_book_num($ISBN,-1,$conn);//調整數量
                    echo"<script>alert('刪除成功');history.go(-1);</script>";
                    exit;
                }
                else{}
            }
        }
        else{
            echo"<script>alert('館藏無此書');history.go(-1);</script>";
            exit;
        }

    }
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
                var options = { filename: '罰款憑據.pdf'};
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
            <h>名字 : <?php $name = userName_query_API($userID,$conn); echo $name[0]['username']?></h>
            <br>
            <h>學號 : <?php echo $name[0]['userID']?></h>
            <br>
            <h>書名 : <?php $bookname = get_book_name($ISBN,$conn);echo $bookname?></h>
            <br>
            <h>今日日期 : <?php date_default_timezone_set('Asia/Taipei'); $d1 = date("Y").'-'.date("m").'-'.date("d"); echo $d1;?></h>
            <br>
            <h>金額:<?php echo '1000'?></h>
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
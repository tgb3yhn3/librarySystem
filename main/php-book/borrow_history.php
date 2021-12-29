<?php
    session_start();
    $conn=require_once("config.php");
    $userID = $_SESSION["userID"];//TODO
    $get_book_history =  "SELECT * FROM user_book_history WHERE userID = '".$userID."'";
    $res = mysqli_query($conn,$get_book_history);
    $get_user_data = "SELECT * FROM user_condition WHERE userID = '".$userID."'";
    $result = mysqli_query($conn,$get_user_data);
    $reserve = 0;
    $res_count = 0;
    $uncomment = 0;
    if ($res) {
        if (mysqli_num_rows($res)>0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $res_datas[] = $row;
                $res_count++;
            }
        }
        mysqli_free_result($res);
    }
    if ($result) {
        if (mysqli_num_rows($result)>0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $result_datas[] = $row;
            }
        }
        mysqli_free_result($result);
    }
    for($i=0;$i<$res_count;$i++){
        if($res_datas[$i]['book_status']=='已預約'){
            $reserve++;
        }
        if($res_datas[$i]['comment_status']=='未評論'){
            $uncomment++;
        }
    }
    $_SESSION['reserve'] = $reserve;
    $_SESSION['uncomment'] = $uncomment;
    $_SESSION['unreturn'] = $result_datas[0]['renting_book_num'];
    $_SESSION['book_num'] = $result_datas[0]['book_num'];
    $_SESSION['book_time'] = $result_datas[0]['book_time'];

?>
<HTML>
<HEAD>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Borrow_history!</title>
    <style>
        .myblank{
            margin: 0 auto;
            width: 900px;
            /* height: 250px; */
            text-align: center;
        }
    </style>
</HEAD>
<BODY>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> -->
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <a href="../index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <img width="50px" height="50px" src="ntou_logo.png">
            </a>
            <span class="fs-1">海大資工系圖書館系統<span class="fs-2">-借閱歷史</span></span>

            <div class="col-md-3 text-end">
            <?php 
            //   session_start();
            if(isset($_SESSION['username'])){

                // echo ($_SESSION["status"]);
                // echo $_SESSION["admin"];
                echo $_SESSION['username'].'&emsp;你好&emsp;';
                
                echo '<a href="../php-member/logout.php"><button type="button" class="btn btn-primary">登出</button></a>';
            }else{
                echo' <a href="../php-member/login-2.htm"><button type="button" class="btn btn-outline-primary me-2">Login</button></a>
                <a href="../php-member/register.html"><button type="button" class="btn btn-primary">Sign-up</button></a>
            ';
            } ?>
                <p><font size="1" color="gray">可借/預約:<?php  echo $_SESSION["book_num"];?>&ensp;可借天數:<?php  echo $_SESSION["book_time"];?></font></p>
            </div>
        </header>
    </div>
    <p></p>   
    <?php
    echo "<div class='myblank' >
            <table border='1' RULES=ALL style='border-color:black;'>
            <div style='float: right '>
            未還書:".$_SESSION["unreturn"]."&ensp;已預約:".$_SESSION["reserve"]."&ensp;未評論:".$_SESSION["uncomment"]."
            </div>
            <p>&ensp;</p>
                <thead bgcolor='#84C1FF'>
                    <tr style='height:30px'>
                        <th style='width:150px;border:1px black solid; text-align:center;'><font color='#000093'>書名</font></th>
                        <th style='width:150px;border:1px black solid; text-align:center;'><font color='#000093'>借閱日期</font></th>
                        <th style='width:150px;border:1px black solid; text-align:center;'><font color='#000093'>還書日期</font></th>
                        <th style='width:150px;border:1px black solid; text-align:center;'><font color='#000093'>書籍狀態</font></th>
                        <th style='width:150px;border:1px black solid; text-align:center;'><font color='#000093'>評論狀態</font></th>
                        <th style='width:150px;border:1px black solid; text-align:center;'><font color='#000093'>最晚還書日期</font></th>
                    </tr>
                </thead>
                <tbody bgcolor='#D2E9FF'>";
    for($i=0;$i<$res_count;$i++){
                echo "<tr style='height:30px'>
                        <th style='width:150px;border:1px black solid; text-align:center;'>".$res_datas[$i]['book_name']."</th>
                        <th style='width:150px;border:1px black solid; text-align:center;'>".$res_datas[$i]['start_rent_date']."</th>
                        <th style='width:150px;border:1px black solid; text-align:center;'>".$res_datas[$i]['return_date']."</th>
                        <th style='width:150px;border:1px black solid; text-align:center;'> ".(($res_datas[$i]['book_status']=='已預約')?'<a target="" href="cancel_reserve_book.php?book='.$res_datas[$i]['ISBN'].'&num='.$res_datas[$i]['numbering'].'&userID='.$res_datas[$i]['userID'].'">已預約</a>':$res_datas[$i]['book_status'])."</th>
                        <th style='width:150px;border:1px black solid; text-align:center;'>".(($res_datas[$i]['comment_status']=='未評論')?'<a target="" href="../php-comment/makecomment.php?book='.$res_datas[$i]['ISBN'].'&num='.$res_datas[$i]['numbering'].'">未評論</a>':$res_datas[$i]['comment_status'])."</th>

                        <th style='width:150px;border:1px black solid; text-align:center;'>".$res_datas[$i]['lasting_return_date']."</th>
                    </tr>";
    }
    echo "      </tbody>
            </table>
        </div>";
        
    ?>
    
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-muted">&copy; 2021 Company, Inc</p>


            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item"><a href="../index.php" class="nav-link px-2 text-muted">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
            </ul>
        </footer>
    </div>
</BODY>
</HTML>

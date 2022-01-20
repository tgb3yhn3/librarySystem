<?php

//function 後端 發送預約已到的email

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/PHPMailer/src/Exception.php';
require '../PHPMailer/PHPMailer/src/PHPMailer.php';
require '../PHPMailer/PHPMailer/src/SMTP.php';
//Load Composer's autoloader

function sentCanBorrowMail($userID,$ISBN,$lasting_time,$conn){//發送預約已到信件
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();           
        $mail->SMTPSecure = "ssl";                                  //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'camellibrarysoft';                     //SMTP username
        $mail->Password   = '1101soft';         
        $mail->CharSet = "utf-8"; //郵件編碼                      //SMTP password
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('camellibrarysoft@gmail.com', '海大資工系圖書館');

        //從資料庫抓取目標使用者
        $sql =" SELECT username,userID,email
                FROM users
                where status<> 2 and userID ='$userID' limit 1";
        $result = mysqli_query($conn,$sql);//抓取的結果
        if (!$result) {die("Fatal Error");}//若抓取的結果不存在，終止程式並回報錯誤
        $result->data_seek(0);//查找第i列資料
        $row = $result->fetch_assoc();//讀取第i列資料
        $username = $row['username'];
        $email = $row['email'];
        $sql =" SELECT book.*
                FROM book
                where ISBN = '$ISBN'";
        $result = mysqli_query($conn,$sql);//抓取的結果
        if (!$result) {die("Fatal Error");}//若抓取的結果不存在，終止程式並回報錯誤
        $result->data_seek(0);//查找第i列資料
        $row = $result->fetch_assoc();//讀取第i列資料
        $bookname = $row['bookName'];               
        $mail->addAddress($email);//收件信箱位置
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = "【預約已到通知】".$username."(".$userID.")同學好，您有預約的書籍現可借閱";
        $mail->Body    = 
        '<p>同學您好！您預約的書籍：</p>
        <p style="font-weight:bold;">書名：《'.$bookname.'》
        <br>ISBN碼：'.$ISBN.'</p>
        <p>現可借閱!<br>
        敬請於<span style="color:red; font-size:25px;">'.$lasting_time.'前</span>至圖書館借閱，否則將取消預約資格
        </p><br><br><br><br>※此為系統自動發信，請勿直接回復！※';
        $mail->send();
        //echo $email."<br>";
        $mail->ClearAddresses();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>
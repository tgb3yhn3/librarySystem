<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer/src/Exception.php';
require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';
//Load Composer's autoloader

function sentRegMail($mailto,$token){
    $mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();           
    $mail->SMTPSecure = "ssl";                                  //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'camellibrarysoft';                     //SMTP username
    $mail->Password   = '1101soft';         
    $mail->CharSet = "utf-8"; //郵件編碼                      //SMTP password
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('camellibrarysoft@gmail.com', 'AutoMailer');
    $mail->addAddress($mailto);     //Add a recipient
                  //Name is optional
   

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Camel 註冊驗證信';
    $mail->Body    = '<p>同學您好：<p>

    <p>歡迎你加入成為我們平臺的新使用者！</p>
    
    
    <p>請於收到此信件的24小時內<br>點選「<a href="http://grassr.ddns.net/main/validReg.php?verify='.$token.'">這裡</a>」進行驗證以完成註冊。</p>
    
    <p>若連結無法啟用，請在瀏覽器上貼上以下網址：<br>
    http://grassr.ddns.net/main/validReg.php?verify='.$token.'</p>
    
    感謝您的使用，祝你期中期末all pass!
    <br><br><br><br>
    ※此為系統自動發信，請勿直接回復！※
    
    
    ';
    

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
//Create an instance; passing `true` enables exceptions

?>
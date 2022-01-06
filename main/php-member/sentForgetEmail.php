<?php
//function 後端 發送忘記密碼的email

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/PHPMailer/src/Exception.php';
require '../PHPMailer/PHPMailer/src/PHPMailer.php';
require '../PHPMailer/PHPMailer/src/SMTP.php';
//Load Composer's autoloader

function sentForgetMail($mailto,$token){
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
    $mail->Subject = 'Kamel 忘記密碼驗證信';
    $mail->Body    = '<p>同學您好：</p>

    <p>請點選「<a href="http://grassr.ddns.net/main/php-member/validForget.php?verify='.$token.'">這裡</a>」以重設您的密碼</p>
    
    <p>若連結無法啟用，請在瀏覽器上貼上以下網址：
    <br>http://grassr.ddns.net/main/php-member/validForget.php?verify='.$token.'</p>
    <p>祝您有美好的一天!</p>
    
    <p>提醒您，為維護您的權益，請儘速取得您的密碼或變更密碼。</p>
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
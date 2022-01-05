<?php
echo "<script>
    if(!confirm('確定發送？')){
        window.location.replace('../welcome.php');
    };
</script>";

//function 後端 發送逾期通知的email

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/PHPMailer/src/Exception.php';
require '../PHPMailer/PHPMailer/src/PHPMailer.php';
require '../PHPMailer/PHPMailer/src/SMTP.php';
//Load Composer's autoloader

function sentOverdueMail(){
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
    $mail->setFrom('camellibrarysoft@gmail.com', '海大資工系圖書館');
   

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    $conn = require_once("../config.php");//連線至資料庫
    if(!$conn){
        return false;//若未成功連線，終止程式並回報錯誤
    }
    $today = date('Y-m-d');

    //從資料庫抓取所有使用者
    $sql =" SELECT username,userID,email
            FROM users
            where status<> 2";
    $resultt = mysqli_query($conn,$sql);//抓取的結果
    if (!$resultt) return false;//若抓取的結果不存在，終止程式並回報錯誤
    $rowss = $resultt->num_rows;//抓取的結果中共有幾列資料
    if($rowss==0){
        return true;
    }
    for ($j = 1 ; $j <= $rowss ; ++$j){
        $resultt->data_seek($j-1);//查找第i列資料
        $roww = $resultt->fetch_assoc();//讀取第i列資料
        $userID = $roww['userID'];
        $username = $roww['username'];
        $email = $roww['email'];
        $mail->addAddress($email);//收件信箱位置
        $sql = "select  user_book_history.book_unique_ID,book.bookName,user_book_history.lasting_return_date 
            from 	user_book_history,book
            WHERE 	SUBSTRING_INDEX(user_book_history.book_unique_ID, '_', 1) = book.ISBN and 
                    user_book_history.userID = '$userID' and 
                    user_book_history.start_rent_date <> '-' and 
                    user_book_history.return_date = '-' and 
                    user_book_history.lasting_return_date < '$today'
            ORDER by user_book_history.lasting_return_date ";
        $result = mysqli_query($conn,$sql);//抓取的結果
        if (!$result) return false;//若抓取的結果不存在，終止程式並回報錯誤
        $rows = $result->num_rows;//抓取的結果中共有幾列資料
        if($rows!=0){//有書逾期未還
            $allOverdueBookmessage ="";
            for ($i = 1 ; $i <= $rows ; ++$i){
                $result->data_seek($i-1);//查找第i列資料
                $row = $result->fetch_assoc();//讀取第i列資料
                $oneOverdueBookmessage = 
                "<p>".
                    "<br>".$i.".".
                    "<br>書籍ID：" .$row['book_unique_ID'].
                    "<br>書籍名稱：".$row['bookName'].
                    "<br>應還日期：".$row['lasting_return_date'].
                "</p>";   
                $allOverdueBookmessage = $allOverdueBookmessage.$oneOverdueBookmessage; 
            }
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = "【逾期未還通知】".$username."(".$userID.")同學好，您有書籍未歸還且已超過還書期限，請盡速歸還";
            $mail->Body    = '<h1>同學您好！以下是您未歸還且已超過還書期限的書籍，請盡速歸還</h1><br>'.$allOverdueBookmessage.'<br><br><br><br>※此為系統自動發信，請勿直接回復！※';
            //$mail->send();
            //echo $email."<br>";
            $mail->ClearAddresses();
        }

    }
    return true;
} catch (Exception $e) {
    return false;
}
}
//sentOverdueMail();
if(sentOverdueMail()==true){//發送成功
    echo "<script>alert('發送成功!');window.location.replace('../welcome.php');</script>";
}
else{//發送失敗
    echo "<script>alert('發送失敗!');window.location.replace('../welcome.php');</script>";
}
//Create an instance; passing `true` enables exceptions

?>
<?php
$txt = "First line of textnSecond line of text";

// Use wordwrap() if lines are longer than 70 characters
$txt = wordwrap($txt,70);

// Send email
if(mail("wys899195@gmail.com","電子郵件測試",$txt)){
echo"成功寄出去!";
}
else{
    echo"失敗!";
}
?>
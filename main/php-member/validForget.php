
 <script>
        
        function validateForm() {
            var x = document.forms["resetPasswordForm"]["password"].value;
            var y = document.forms["resetPasswordForm"]["password_check"].value;
            if(x.length<6){
                alert("密碼長度不足");
                return false;
            }
            if (x != y) {
                alert("請確認密碼是否輸入正確");
                return false;
            }
        }
    </script>

<?php
$token=$_GET["verify"];
$conn=require_once "config.php";
$sql="SELECT * FROM users WHERE forgettoken='".$token."'";
// echo $sql;
if(mysqli_num_rows(mysqli_query($conn,$sql))==1){
    echo '<form name="resetPasswordForm" action="changePassword.php" method="POST" onsubmit="return validateForm()">
    輸入新密碼<input type="password" name="password">
    請再次輸入新密碼<input type="password" name="password_check">
    <input type="hidden" value="'.$token.'" name=token>
    <input type="submit">
</form>';
}else{
    echo "validtoken 請聯繫管理員";
}

?>
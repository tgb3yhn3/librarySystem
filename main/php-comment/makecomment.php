<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="sentComment.php" method="POST">
        請輸入評論 : <input type="text" name='context'>
        <input type="hidden" name='username'value='<?php session_start(); echo  $_SESSION['username'];?>'>
        <input type="hidden" name='ISBN'value='<?php echo  $_GET['book']?>'>
        <input type="hidden" name='num'value='<?php echo  $_GET['num']?>'>
        <input type='submit'>
    </form>
</body>
</html>
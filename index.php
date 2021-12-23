<html>
    <head>
        <script>
            function reserve_post(){
                book.action = "reserve_book.php";
                book.submit();
            }
        </script>
    </head>
    <body>
        <form name="book" method="POST" >
            學號:<input type = "text" id = "userID" name="userID"><br>
            ISBN:<input type = "text" id = "ISBN" name="ISBN"><br>
            <input type="submit"  value="預約" onClick="reserve_post()">
        </form>
    </body>
</html>
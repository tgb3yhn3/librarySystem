<html>
    <head>
        <script>
            function rent_post(){
                book.action = "rent_book.php";
                book.submit();
            }
            function return_post(){
                book.action = "return_book.php";
                book.submit();
            }
        </script>
    </head>
    <body>
        <form name="book" method="POST" >
            學號:<input type = "text" id = "userID" name="userID"><br>
            書號:<input type = "text" id = "bookuniqueID" name="bookuniqueID"><br>
            <input type="submit"  value="借書" onClick="rent_post()">
            <input type="submit"  value="還書" onClick="return_post()">
        </form>
    </body>
</html>
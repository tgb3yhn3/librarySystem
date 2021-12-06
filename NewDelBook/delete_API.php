<?php
    require_once("login.php");
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die("Fatal Error");

    if (
      isset($_POST['bookName']) &&
      isset($_POST['author']) &&
      isset($_POST['ISBN']) &&
      isset($_POST['describeBook']) &&
      isset($_POST['class']) &&
      isset($_POST['publish_year']) &&
      isset($_POST['publisher']) &&
      isset($_POST['num'])
    ) 
    {
      $author = get_post($conn, 'author');
      $bookName = get_post($conn, 'bookName');
      $ISBN = get_post($conn, 'ISBN');
      $describeBook = get_post($conn, 'describeBook');
      $class = get_post($conn, 'class');
      $publish_year = get_post($conn, 'publish_year');
      $publisher = get_post($conn, 'publisher');
      $num = get_post($conn, 'num');


        $query    = "DELETE FROM test.tt WHERE bookName='$bookName' and author='$author' and
                     ISBN='$ISBN' and describeBook='$describeBook' and class='$class' and 
                     publish_year='$publish_year' and publisher='$publisher' and num='$num'";
        $result   = $conn->query($query);
        if (!$result) echo "DELETE failed<br><br>";
        else echo "Successful delete a book.";
    }

    $conn->close();

    function get_post($conn, $var)
    {
      return $conn->real_escape_string($_POST[$var]);
    }
?>
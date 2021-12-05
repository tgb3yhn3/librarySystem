<?php
    require_once("login.php");
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die("Fatal Error");

    if (
        isset($_POST['author'])   &&
        isset($_POST['title'])    &&
        isset($_POST['category']) &&
        isset($_POST['year'])     &&
        isset($_POST['isbn'])
      ) 
    {
        $author   = get_post($conn, 'author');
        $title    = get_post($conn, 'title');
        $category = get_post($conn, 'category');
        $year     = get_post($conn, 'year');
        $isbn     = get_post($conn, 'isbn');


        $query    = "DELETE FROM test.tt WHERE author='$author' and
                     title='$title' and category='$category' and year='$year' and isbn='$isbn'";
        $result   = $conn->query($query);
        if (!$result) echo "DELETE failed<br><br>";
        else echo "Successful delete a book (author: $author).";
    }

    $conn->close();

    function get_post($conn, $var)
    {
      return $conn->real_escape_string($_POST[$var]);
    }
?>
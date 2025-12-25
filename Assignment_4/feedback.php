<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "Name: " . $_POST['name'] . "<br>";
    echo "Rating: " . $_POST['rating'] . "<br>";
    echo "Comment: " . $_POST['comment'] . "<br><br>";

    echo "IP: " . $_SERVER['REMOTE_ADDR'] . "<br>";
    echo "Browser: " . $_SERVER['HTTP_USER_AGENT'] . "<br>";
    echo "Server: " . $_SERVER['SERVER_NAME'] . "<br>";
}
?>

<form method="POST">
    Name: <input type="text" name="name"><br><br>
    Rating: <input type="number" name="rating" min="1" max="5"><br><br>
    Comment: <textarea name="comment"></textarea><br><br>
    <button>Submit</button>
</form>

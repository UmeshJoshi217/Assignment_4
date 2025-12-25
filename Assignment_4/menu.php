<?php
$page = $_GET['page'] ?? 'home';
?>

<a href="?page=home">Home</a> |
<a href="?page=about">About</a> |
<a href="?page=contact">Contact</a>

<hr>

<?php
if ($page == "home") {
    echo "This is Home Page.";
} elseif ($page == "about") {
    echo "This is About Page.";
} elseif ($page == "contact") {
    echo "This is Contact Page.";
} else {
    echo "Page not found!";
}
?>

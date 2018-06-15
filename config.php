
<?php
//index.php
$connect = mysqli_connect("localhost", "root", "", "royal_db");
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
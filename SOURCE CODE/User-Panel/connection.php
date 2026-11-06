<?php

$con = mysqli_connect('localhost', 'root', '', 'bookstoredatabase');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
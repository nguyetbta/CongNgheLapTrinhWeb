<?php
$connect = mysqli_connect("localhost", "root", "", "tintuc");

if (!$connect) {
    die("Khong the ket noi Database: " . mysqli_connect_error());
}

mysqli_set_charset($connect, "utf8mb4");
?>
<?php
$conn = mysqli_connect("localhost", "root", "", "QLHocPhan");

if (!$conn) {
    die("Ket noi that bai: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");
?>
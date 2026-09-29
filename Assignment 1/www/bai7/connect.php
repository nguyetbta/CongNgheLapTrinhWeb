
<?php
$connect = mysqli_connect(
    "localhost",
    "root",
    "",
    "tintuc"
);

if (!$connect) {
    die("Loi ket noi: " . mysqli_connect_error());
}

mysqli_set_charset($connect, "utf8");
?>

<?php
include("connect.php");

// Lay ma giang vien can xoa
$idgv = $_GET["id"] ?? "";

if ($idgv == "") {
    die("Khong tim thay ma giang vien!");
}

// Xoa giang vien trong CSDL
$sql = "DELETE FROM GiangVien WHERE IDGV = ?";
$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "s", $idgv);

if (mysqli_stmt_execute($stmt)) {
    header("Location: index.php");
    exit();
} else {
    echo "Xoa giang vien that bai!";
}
?>

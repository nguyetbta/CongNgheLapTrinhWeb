
<?php
include_once("../connect.php");

$id = (int)($_GET["idTL"] ?? 0);

if ($id <= 0) {
    die("ID khong hop le.");
}

// Lấy tên ảnh trước khi xóa
$sql = "SELECT icon FROM theloai WHERE idTL = ?";
$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$row = mysqli_fetch_assoc(
    mysqli_stmt_get_result($stmt)
);
mysqli_stmt_close($stmt);

if (!$row) {
    die("Khong tim thay the loai.");
}

// Xóa dữ liệu
$sql = "DELETE FROM theloai WHERE idTL = ?";
$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    if ($row["icon"] != "") {
        $path = "../image/" . basename($row["icon"]);
        if (is_file($path)) {
            unlink($path);
        }
    }

    echo "<script>
        alert('Xoa thanh cong');
        location.href='theloai.php';
    </script>";
} else {
    echo "Loi: " . mysqli_error($connect);
}

mysqli_stmt_close($stmt);
mysqli_close($connect);
?>
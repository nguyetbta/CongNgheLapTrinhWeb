
<?php
include_once("../connect.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: theloai_them.php");
    exit;
}

$theloai = trim($_POST["TenTL"] ?? "");
$thutu = (int)($_POST["ThuTu"] ?? 0);
$an = (int)($_POST["AnHien"] ?? 1);
$icon = "";

if ($theloai == "") {
    die("Vui long nhap ten the loai.");
}

// Upload ảnh nếu có chọn
if (isset($_FILES["image"]) &&
    $_FILES["image"]["error"] == UPLOAD_ERR_OK) {

    $tmp = $_FILES["image"]["tmp_name"];
    $original = basename($_FILES["image"]["name"]);
    $ext = strtolower(pathinfo($original, PATHINFO_EXTENSION));

    $allowed = ["jpg", "jpeg", "png", "gif", "webp"];

    if (!in_array($ext, $allowed)) {
        die("Chi chap nhan file anh.");
    }

    if (!getimagesize($tmp)) {
        die("File khong phai anh hop le.");
    }

    $icon = uniqid("icon_") . "." . $ext;
    $destination = "../image/" . $icon;

    if (!move_uploaded_file($tmp, $destination)) {
        die("Upload anh that bai.");
    }
}

$sql = "INSERT INTO theloai
        (TenTL, ThuTu, AnHien, icon)
        VALUES (?, ?, ?, ?)";

$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param(
    $stmt, "siis",
    $theloai, $thutu, $an, $icon
);

if (mysqli_stmt_execute($stmt)) {
    echo "<script>
        alert('Them thanh cong');
        location.href='theloai.php';
    </script>";
} else {
    echo "Loi: " . mysqli_error($connect);
}

mysqli_stmt_close($stmt);
mysqli_close($connect);
?>
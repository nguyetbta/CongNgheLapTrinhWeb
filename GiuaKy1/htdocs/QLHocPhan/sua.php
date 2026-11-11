
<?php
include("connect.php");

$thongbao = "";
$idgv = $_GET["id"] ?? "";

// Lay thong tin giang vien
$sql = "SELECT * FROM GiangVien WHERE IDGV = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $idgv);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("Khong tim thay giang vien!");
}

// Xu ly khi nhan nut cap nhat
if (isset($_POST["capnhat"])) {

    $fullname = $_POST["Fullname"];
    $sumclass = $_POST["SumClass"];
    $tenanh = $row["Image"];

    // Neu co chon anh moi
    if (isset($_FILES["Image"]) && $_FILES["Image"]["error"] == 0) {

        $duoianh = strtolower(
            pathinfo($_FILES["Image"]["name"], PATHINFO_EXTENSION)
        );

        if (!in_array($duoianh, ["jpg", "jpeg", "png"])) {
            $thongbao = "Chi chap nhan anh JPG, JPEG, PNG!";
        } else {

            $tenanh = uniqid("gv_") . "." . $duoianh;
            $duongdan = "images/" . $tenanh;

            if (!move_uploaded_file(
                $_FILES["Image"]["tmp_name"], $duongdan
            )) {
                $thongbao = "Khong the tai anh len!";
            }
        }
    }

    // Cap nhat du lieu neu khong co loi
    if ($thongbao == "") {

        $sql = "UPDATE GiangVien
                SET Fullname = ?, Image = ?, SumClass = ?
                WHERE IDGV = ?";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param(
            $stmt, "ssis",
            $fullname, $tenanh, $sumclass, $idgv
        );

        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php");
            exit();
        } else {
            $thongbao = "Cap nhat that bai!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa giảng viên</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h2>SỬA GIẢNG VIÊN</h2>

    <p style="color:red;">
        <?php echo htmlspecialchars($thongbao); ?>
    </p>

    <form method="POST" enctype="multipart/form-data">

        <label>Mã giảng viên:</label>
        <input type="text"
               value="<?php echo htmlspecialchars($row['IDGV']); ?>"
               disabled>

        <label>Họ và tên:</label>
        <input type="text" name="Fullname"
               value="<?php echo htmlspecialchars($row['Fullname']); ?>"
               required>

        <label>Hình ảnh hiện tại:</label>
        <img src="images/<?php echo htmlspecialchars($row['Image']); ?>"
             width="100" alt="Anh giang vien">

        <label>Chọn hình ảnh mới:</label>
        <input type="file" name="Image"
               accept=".jpg,.jpeg,.png">

        <label>Tổng số lớp:</label>
        <input type="number" name="SumClass"
               min="0"
               value="<?php echo htmlspecialchars($row['SumClass']); ?>"
               required>

        <button type="submit" name="capnhat">
            Cập nhật
        </button>

        <a href="index.php">Quay lại</a>

    </form>
</div>

</body>
</html>

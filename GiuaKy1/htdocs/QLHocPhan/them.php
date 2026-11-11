
<?php
include("connect.php");

$thongbao = "";

if (isset($_POST["them"])) {

    $idgv = $_POST["IDGV"];
    $fullname = $_POST["Fullname"];
    $sumclass = $_POST["SumClass"];

    // Kiem tra anh
    if (isset($_FILES["Image"]) && $_FILES["Image"]["error"] == 0) {

        $tenanh = basename($_FILES["Image"]["name"]);
        $duongdan = "images/" . $tenanh;

        // Kiem tra dinh dang anh
        $duoianh = strtolower(pathinfo($tenanh, PATHINFO_EXTENSION));

        if (!in_array($duoianh, ["jpg", "jpeg", "png"])) {
            $thongbao = "Chi chap nhan anh JPG, JPEG, PNG!";
        } else {

            // Kiem tra ma giang vien
            $check = mysqli_prepare($conn, 
                "SELECT IDGV FROM GiangVien WHERE IDGV = ?"
            );

            mysqli_stmt_bind_param($check, "s", $idgv);
            mysqli_stmt_execute($check);
            $result = mysqli_stmt_get_result($check);

            if (mysqli_num_rows($result) > 0) {
                $thongbao = "Ma giang vien da ton tai!";
            } else {

                if (move_uploaded_file($_FILES["Image"]["tmp_name"], $duongdan)) {

                    $sql = "INSERT INTO GiangVien
                            (IDGV, Fullname, Image, SumClass)
                            VALUES (?, ?, ?, ?)";

                    $stmt = mysqli_prepare($conn, $sql);

                    mysqli_stmt_bind_param(
                        $stmt, "sssi",
                        $idgv, $fullname, $tenanh, $sumclass
                    );

                    if (mysqli_stmt_execute($stmt)) {
                        $thongbao = "Them giang vien thanh cong!";
                    } else {
                        $thongbao = "Loi them du lieu!";
                    }

                } else {
                    $thongbao = "Khong the tai anh len!";
                }
            }
        }
    } else {
        $thongbao = "Vui long chon anh!";
    }
}
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm giảng viên</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h2>THÊM GIẢNG VIÊN</h2>

    <p style="color:green;">
        <?php echo $thongbao; ?>
    </p>

    <form method="POST" enctype="multipart/form-data">

        <label>Mã giảng viên:</label>
        <input type="text" name="IDGV" required>

        <label>Họ và tên:</label>
        <input type="text" name="Fullname" required>

        <label>Hình ảnh:</label>
        <input type="file" name="Image"
               accept=".jpg,.jpeg,.png" required>

        <label>Tổng số lớp:</label>
        <input type="number" name="SumClass"
               min="0" required>

        <button type="submit" name="them">
            Thêm giảng viên
        </button>

        <a href="index.php">Quay lại</a>

    </form>
</div>

</body>
</html>
<?php
// Ket noi database
$link = mysqli_connect("localhost", "root", "", "udn");

if (!$link) {
    die("Khong the ket noi database: " . mysqli_connect_error());
}

// Nhan tu khoa tim kiem
if (isset($_REQUEST["term"])) {

    $sql = "SELECT * FROM hocphan WHERE tenhp LIKE ?";

    $stmt = mysqli_prepare($link, $sql);

    if ($stmt) {

        // Gan tham so tim kiem
        $param_term = $_REQUEST["term"] . '%';

        mysqli_stmt_bind_param($stmt, "s", $param_term);

        // Thuc thi cau lenh
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        // Hien thi ket qua
        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<p>" . htmlspecialchars($row["tenhp"]) . "</p>";
            }

        } else {
            echo "<p>Khong tim thay ket qua nao</p>";
        }

        mysqli_stmt_close($stmt);
    }
}

// Dong ket noi
mysqli_close($link);
?>
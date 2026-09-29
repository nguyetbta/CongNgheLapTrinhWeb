
<?php
include_once("../connect.php");

$sql = "SELECT * FROM theloai ORDER BY ThuTu ASC";
$result = mysqli_query($connect, $sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý thể loại</title>
    <style>
        body {
            font-family: Arial;
            margin: 30px;
            background: #f5f5f5;
        }
        h2 {
            color: #333;
            text-align: center;
        }
        table {
            width: 800px;
            margin: auto;
            border-collapse: collapse;
            background: white;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: center;
        }
        th {
            background: #f5b942;
        }
        a {
            text-decoration: none;
            color: #075db5;
        }
        .add {
            display: inline-block;
            margin: 20px 0;
            padding: 10px 18px;
            background: #f5b942;
            color: black;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<h2>QUẢN LÝ THỂ LOẠI</h2>

<div style="text-align:center">
    <a class="add" href="theloai_them.php">
        + Thêm thể loại
    </a>
</div>

<table>
    <tr>
        <th>Tên thể loại</th>
        <th>Thứ tự</th>
        <th>Ẩn / Hiện</th>
        <th>Biểu tượng</th>
        <th>Sửa</th>
        <th>Xóa</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td>
            <?php echo htmlspecialchars($row["TenTL"]); ?>
        </td>
        <td><?php echo $row["ThuTu"]; ?></td>
        <td>
            <?php
            echo $row["AnHien"] == 1 ? "Hiện" : "Ẩn";
            ?>
        </td>
        <td>
            <?php if ($row["icon"] != "") { ?>
                <img
                    src="../image/<?php echo rawurlencode($row["icon"]); ?>"
                    width="40" height="40"
                    alt="Icon"
                >
            <?php } ?>
        </td>
        <td>
            <a href="theloai_sua.php?idTL=<?php
                echo $row["idTL"];
            ?>">Sửa</a>
        </td>
        <td>
            <a href="theloai_xoa.php?idTL=<?php
                echo $row["idTL"];
            ?>"
            onclick="return confirm('Ban co chac muon xoa?')">
                Xóa
            </a>
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>

<?php
mysqli_close($connect);
?>
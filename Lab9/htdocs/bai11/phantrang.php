<?php
// Ket noi co so du lieu
$conn = mysqli_connect("localhost", "root", "", "phantrang");

if (!$conn) {
    die("Khong the ket noi CSDL: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");

// Lay so trang hien tai
if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}

// Khong cho so trang nho hon 1
if ($page < 1) {
    $page = 1;
}

// So tin tuc hien thi tren moi trang
$limit = 10;

// Vi tri bat dau lay du lieu
$start = ($page - 1) * $limit;

// Dem tong so tin tuc
$count_query = mysqli_query($conn, "SELECT * FROM tintuc");
$total_title = mysqli_num_rows($count_query);

// Tinh tong so trang
$total_page = ceil($total_title / $limit);

// Neu trang vuot qua tong so trang thi dua ve trang cuoi
if ($total_page > 0 && $page > $total_page) {
    $page = $total_page;
    $start = ($page - 1) * $limit;
}

// Lay du lieu theo trang
$query = "SELECT * FROM tintuc LIMIT $start, $limit";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Phan trang trong PHP</title>

    <style type="text/css">
        body {
            background: #ecf0f1;
            font-family: Arial, sans-serif;
        }

        a:link, a:visited {
            text-decoration: none;
        }

        a:hover {
            color: #f00;
        }

        .title, .pagination {
            width: 600px;
            margin: 0 auto;
            margin-bottom: 20px;
        }

        .title {
            background: #3498db;
            padding: 20px;
            line-height: 1.5;
        }

        .title a {
            color: #fff;
            display: block;
        }

        .title a:hover {
            color: #e67e22;
        }

        .pagination {
            text-align: center;
        }

        .pagination a {
            display: inline-block;
            padding: 8px 12px;
            margin: 3px;
            background: #3498db;
            color: white;
            border-radius: 4px;
        }

        .pagination a:hover {
            background: #e67e22;
        }

        .pagination .active {
            background: #e67e22;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h2 style="text-align:center;">DANH SACH TIN TUC</h2>

    <div class="title">
        <?php
        while ($row = mysqli_fetch_array($result)) {
            echo '<a href="#">' . $row['id'] . '. '
                . htmlspecialchars($row['title']) . '</a>';
        }
        ?>
    </div>

    <div class="pagination">

        <?php
        // Nut trang truoc
        if ($page > 1) {
            echo '<a href="phantrang.php?page=' . ($page - 1) . '">Truoc</a>';
        }

        // Cac so trang
        for ($i = 1; $i <= $total_page; $i++) {
            if ($i == $page) {
                echo '<a class="active" href="phantrang.php?page='
                    . $i . '">' . $i . '</a>';
            } else {
                echo '<a href="phantrang.php?page='
                    . $i . '">' . $i . '</a>';
            }
        }

        // Nut trang tiep theo
        if ($page < $total_page) {
            echo '<a href="phantrang.php?page=' . ($page + 1) . '">Tiep</a>';
        }
        ?>

    </div>

    <p style="text-align:center;">
        Trang <?php echo $page; ?> / <?php echo $total_page; ?>
    </p>

</body>
</html>

<?php
mysqli_close($conn);
?>
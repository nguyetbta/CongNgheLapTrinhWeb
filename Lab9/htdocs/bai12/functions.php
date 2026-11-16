<?php
// Ket noi co so du lieu
$conn = mysqli_connect("localhost", "root", "", "rating");

if (!$conn) {
    die("Khong the ket noi toi CSDL: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");


// Ham lay thong tin danh gia cua san pham
function getRatingInfo($id) {
    global $conn;

    $id = (int)$id;

    $query = "SELECT * FROM rating_info WHERE product_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    $return = '<div class="rating-info">';
    $return .= '<strong>Danh gia</strong>';
    $return .= '<ul id="rating-info">';

    if ($row) {
        for ($i = 5; $i >= 1; $i--) {
            $return .= '<li><strong>' . $i . '</strong>: '
                    . $row['rate_' . $i] . '</li>';
        }
    } else {
        for ($i = 5; $i >= 1; $i--) {
            $return .= '<li><strong>' . $i . '</strong>: 0</li>';
        }
    }

    $return .= '</ul>';
    $return .= '</div>';

    mysqli_stmt_close($stmt);

    return $return;
}


// Ham cap nhat so luot danh gia
function setRatingInfo($id, $rate) {
    global $conn;

    $id = (int)$id;
    $rate = (int)$rate;

    // Chi chap nhan diem tu 1 den 5
    if ($rate < 1 || $rate > 5) {
        return;
    }

    $column = "rate_" . $rate;

    $query = "UPDATE rating_info
              SET $column = $column + 1
              WHERE product_id = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
}


// Ham lay thong tin mot san pham
function getProduct($id) {
    global $conn;

    $id = (int)$id;

    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    if (!$row) {
        return "<p>Khong tim thay san pham.</p>";
    }

    $title = htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8');
    $img = htmlspecialchars($row['img_url'], ENT_QUOTES, 'UTF-8');

    $rating_info = getRatingInfo($id);

    $return = '<div id="product-img">';
    $return .= '<img src="' . $img . '" alt="' . $title . '">';
    $return .= '</div>';

    $return .= $rating_info;
    $return .= '<div class="clear-fx"></div>';
    $return .= '<h2>' . $title . '</h2>';

    return $return;
}


// Ham lay danh sach tat ca san pham
function listProduct() {
    global $conn;

    $query = "SELECT * FROM products";
    $result = mysqli_query($conn, $query);

    $return = "";

    while ($row = mysqli_fetch_assoc($result)) {
        $id = (int)$row['id'];

        $title = htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8');
        $img = htmlspecialchars($row['img_url'], ENT_QUOTES, 'UTF-8');

        $rating_info = getRatingInfo($id);

        $return .= '<div class="product-info">';

        $return .= '<div id="product-img">';
        $return .= '<img src="' . $img . '" alt="' . $title . '">';
        $return .= '</div>';

        $return .= $rating_info;

        $return .= '<div class="clear-fx"></div>';

        $return .= '<h2>';
        $return .= '<a href="index.php?id=' . $id . '">';
        $return .= $title;
        $return .= '</a>';
        $return .= '</h2>';

        $return .= '</div>';
    }

    return $return;
}
?>
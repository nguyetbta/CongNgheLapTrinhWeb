<?php
include("functions.php");

// Neu nguoi dung chon san pham
if (isset($_GET['id'])) {

    $id = (int)$_GET['id'];

    // Xu ly khi nguoi dung gui danh gia
    if (isset($_POST['rate_submit'])) {

        if (isset($_POST['rate'])) {
            $rate = (int)$_POST['rate'];

            if ($rate >= 1 && $rate <= 5) {
                setRatingInfo($id, $rate);
            }
        }

        // Chuyen ve trang chi tiet de tranh gui lai form
        header("Location: index.php?id=" . $id);
        exit();
    }

    $html = getProduct($id);

    include("template/view-product.php");

} else {

    // Hien thi danh sach san pham
    $html = listProduct();

    include("template/list-products.php");
}
?>
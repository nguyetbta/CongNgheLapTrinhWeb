<?php
require('../model/database.php');
require('../model/category.php');
require('../model/category_db.php');
require('../model/product.php');
require('../model/product_db.php');

// Create database access objects
$category_db = new CategoryDB();
$product_db = new ProductDB();

$action = filter_input(INPUT_POST, 'action');

if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');

    if ($action == NULL) {
        $action = 'list_products';
    }
}

if ($action == 'list_products') {
    $category_id = filter_input(
        INPUT_GET,
        'category_id',
        FILTER_VALIDATE_INT
    );

    if ($category_id == NULL || $category_id == FALSE) {
        $category_id = 1;
    }

    // Get category and product data
    $current_category = $category_db->getCategory($category_id);
    $categories = $category_db->getCategories();
    $products = $product_db->getProductsByCategory($category_id);

    // Display the product list
    include('product_list.php');

} else if ($action == 'view_product') {
    // Get all categories
    $categories = $category_db->getCategories();

    // Get the selected product ID
    $product_id = filter_input(
        INPUT_GET,
        'product_id',
        FILTER_VALIDATE_INT
    );

    // Get the product details
    $product = $product_db->getProduct($product_id);

    if ($product == null) {
        $error = "Product not found.";
        include('../errors/error.php');
    } else {
        // Display the product details
        include('product_view.php');
    }
}
?>

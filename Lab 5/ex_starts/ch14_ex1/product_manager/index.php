<?php
require('../model/database.php');
require('../model/category.php');
require('../model/category_db.php');
require('../model/product.php');
require('../model/product_db.php');

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

    // Get product and category data
    $current_category = $category_db->getCategory($category_id);
    $categories = $category_db->getCategories();
    $products = $product_db->getProductsByCategory($category_id);

    // Display the product list
    include('product_list.php');

} else if ($action == 'delete_product') {
    // Get the IDs
    $product_id = filter_input(
        INPUT_POST,
        'product_id',
        FILTER_VALIDATE_INT
    );

    $category_id = filter_input(
        INPUT_POST,
        'category_id',
        FILTER_VALIDATE_INT
    );

    // Delete the product
    $product_db->deleteProduct($product_id);

    // Return to the product list
    header("Location: .?category_id=$category_id");
    exit();

} else if ($action == 'show_add_form') {
    $categories = $category_db->getCategories();

    include('product_add.php');

} else if ($action == 'add_product') {
    $category_id = filter_input(
        INPUT_POST,
        'category_id',
        FILTER_VALIDATE_INT
    );

    $code = trim(filter_input(INPUT_POST, 'code') ?? '');
    $name = trim(filter_input(INPUT_POST, 'name') ?? '');
    $price = filter_input(INPUT_POST, 'price');

    if (
        $category_id == NULL ||
        $category_id == FALSE ||
        $code == '' ||
        $name == '' ||
        $price == NULL ||
        !is_numeric($price) ||
        $price < 0
    ) {
        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php');

    } else {
        // Get the selected category
        $current_category = $category_db->getCategory($category_id);

        if ($current_category == null) {
            $error = "The selected category does not exist.";
            include('../errors/error.php');
        } else {
            // Create a Product object without constructor arguments
            $product = new Product();

            // Set product properties
            $product->setCategory($current_category);
            $product->setCode($code);
            $product->setName($name);
            $product->setPrice($price);

            // Add the product
            $product_db->addProduct($product);

            // Return to the product list
            header("Location: .?category_id=$category_id");
            exit();
        }
    }
}
?>
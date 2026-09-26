
<?php
require('../model/database.php');
require('../model/product_db.php');
require('../model/category_db.php');

$action = filter_input(INPUT_POST, 'action');

if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');

    if ($action == NULL) {
        $action = 'list_products';
    }
}

// List Products
if ($action == 'list_products') {

    $category_id = filter_input(
        INPUT_GET,
        'category_id',
        FILTER_VALIDATE_INT
    );

    if ($category_id == NULL || $category_id == FALSE) {
        $category_id = 1;
    }

    $category_name = get_category_name($category_id);
    $categories = get_categories();
    $products = get_products_by_category($category_id);

    include('product_list.php');

// Delete Product
} else if ($action == 'delete_product') {

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

    if ($category_id == NULL || $category_id == FALSE ||
        $product_id == NULL || $product_id == FALSE) {

        $error = "Missing or incorrect product id or category id.";
        include('../errors/error.php');

    } else {

        delete_product($product_id);

        header("Location: .?category_id=$category_id");
        exit();
    }

// Show Add Product Form
} else if ($action == 'show_add_form') {

    $categories = get_categories();
    include('product_add.php');

// Add Product
} else if ($action == 'add_product') {

    $category_id = filter_input(
        INPUT_POST,
        'category_id',
        FILTER_VALIDATE_INT
    );

    $code = trim(filter_input(INPUT_POST, 'code') ?? '');
    $name = trim(filter_input(INPUT_POST, 'name') ?? '');
    $price = filter_input(INPUT_POST, 'price');

    if ($category_id == NULL || $category_id == FALSE ||
        $code == '' || $name == '' ||
        $price == NULL || !is_numeric($price) ||
        $price < 0) {

        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php');

    } else {

        add_product($category_id, $code, $name, $price);

        header("Location: .?category_id=$category_id");
        exit();
    }

// Exercise 5-1: List Categories
} else if ($action == 'list_categories') {

    $categories = get_categories();
    include('category_list.php');

// Exercise 5-1: Add Category
} else if ($action == 'add_category') {

    $category_name = trim(
        filter_input(INPUT_POST, 'category_name') ?? ''
    );

    if ($category_name == '') {

        $error = "Invalid category name.";
        include('../errors/error.php');

    } else {

        add_category($category_name);

        header('Location: .?action=list_categories');
        exit();
    }

// Exercise 5-1: Delete Category
} else if ($action == 'delete_category') {

    $category_id = filter_input(
        INPUT_POST,
        'category_id',
        FILTER_VALIDATE_INT
    );

    if ($category_id == NULL || $category_id == FALSE) {

        $error = "Missing or incorrect category id.";
        include('../errors/error.php');

    } else {

        delete_category($category_id);

        header('Location: .?action=list_categories');
        exit();
    }
}
?>

<?php
require('util/main.php');

require('model/database.php');
require('model/product_db.php');

/*********************************************
 * Select some products
 **********************************************/

// Category ID of Guitars
$cat_id = 1;

// Get the products
$products = get_products_by_category($cat_id);

/*********************************************
 * Delete a product
 **********************************************/

// Sample data
$product_name = 'Fender Telecaster';

// Find the product by name
$product = get_product_by_name($product_name);

// Delete the product and display a message
if ($product) {
    $product_id = $product['productID'];
    $row_count = delete_product($product_id);

    if ($row_count > 0) {
        $delete_message = "Product '$product_name' was deleted.";
    } else {
        $delete_message = "No rows were deleted.";
    }
} else {
    $delete_message = "Product '$product_name' was not found.";
}

/*********************************************
 * Insert a product
 **********************************************/

// Sample data
$category_id = 1;
$code = 'tele';
$name = 'Fender Telecaster';
$description = 'NA';
$price = 949.99;
$discount_percent = 0;

// Insert the product
$product_id = add_product(
    $category_id,
    $code,
    $name,
    $description,
    $price,
    $discount_percent
);

// Display an appropriate message
if ($product_id) {
    $insert_message = "Product '$name' was inserted successfully.";
} else {
    $insert_message = "No rows were inserted. The product code may already exist.";
}

include 'home.php';
?>

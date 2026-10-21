
<?php
function get_products_by_category($category_id) {
    global $db;

    $query = 'SELECT * FROM products
              WHERE categoryID = :category_id
              ORDER BY productID';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();

        $result = $statement->fetchAll();

        $statement->closeCursor();

        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_product($product_id) {
    global $db;

    $query = 'SELECT *
              FROM products
              WHERE productID = :product_id';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':product_id', $product_id);
        $statement->execute();

        $result = $statement->fetch();

        $statement->closeCursor();

        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

/*********************************************
 * Get a product by name
 **********************************************/
function get_product_by_name($product_name) {
    global $db;

    $query = 'SELECT *
              FROM products
              WHERE productName = :product_name';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':product_name', $product_name);
        $statement->execute();

        $product = $statement->fetch();

        $statement->closeCursor();

        return $product;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

/*********************************************
 * Add a product
 **********************************************/
function add_product(
    $category_id,
    $code,
    $name,
    $description,
    $price,
    $discount_percent
) {
    global $db;

    $query = 'INSERT INTO products
                 (categoryID, productCode, productName, description,
                  listPrice, discountPercent, dateAdded)
              VALUES
                 (:category_id, :code, :name, :description, :price,
                  :discount_percent, NOW())';

    try {
        $statement = $db->prepare($query);

        $statement->bindValue(':category_id', $category_id);
        $statement->bindValue(':code', $code);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':discount_percent', $discount_percent);

        $statement->execute();
        $statement->closeCursor();

        // Get the automatically generated product ID
        $product_id = $db->lastInsertId();

        return $product_id;
    } catch (PDOException $e) {
        // Handle duplicate product code
        if ($e->getCode() == '23000') {
            return false;
        }

        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

/*********************************************
 * Update a product
 **********************************************/
function update_product(
    $product_id,
    $code,
    $name,
    $description,
    $price,
    $discount_percent,
    $category_id
) {
    global $db;

    $query = 'UPDATE Products
              SET productName = :name,
                  productCode = :code,
                  description = :description,
                  listPrice = :price,
                  discountPercent = :discount_percent,
                  categoryID = :category_id
              WHERE productID = :product_id';

    try {
        $statement = $db->prepare($query);

        $statement->bindValue(':name', $name);
        $statement->bindValue(':code', $code);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':discount_percent', $discount_percent);
        $statement->bindValue(':category_id', $category_id);
        $statement->bindValue(':product_id', $product_id);

        $statement->execute();

        $row_count = $statement->rowCount();

        $statement->closeCursor();

        return $row_count;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

/*********************************************
 * Delete a product
 **********************************************/
function delete_product($product_id) {
    global $db;

    $query = 'DELETE FROM products
              WHERE productID = :product_id';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':product_id', $product_id);

        $statement->execute();

        $row_count = $statement->rowCount();

        $statement->closeCursor();

        return $row_count;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
?>

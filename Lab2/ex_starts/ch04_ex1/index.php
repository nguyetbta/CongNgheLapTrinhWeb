<?php
require_once('database.php');
// Get category ID
$category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
if ($category_id == NULL || $category_id == FALSE) {
    $category_id = 1;
}

// Get categories
$query = 'SELECT *
          FROM categories
          ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();

// Get products
$query = 'SELECT *
          FROM products
          WHERE categoryID = :category_id
          ORDER BY productID';
$statement = $db->prepare($query);
$statement->bindValue(':category_id', $category_id);
$statement->execute();
$products = $statement->fetchAll();
$statement->closeCursor();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet"
          type="text/css"
          href="main.css">
</head>
<body>
<header>
    <h1>Product Manager</h1>
</header>
<main>
    <h1>Product List</h1>
    <aside>
        <h2>Categories</h2>
        <nav>
            <ul>
                <?php foreach ($categories as $category) : ?>
                <li>
                    <a href="?category_id=<?php
                        echo $category['categoryID'];
                    ?>">
                        <?php
                        echo htmlspecialchars(
                            $category['categoryName']
                        );
                        ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </aside>
    <section>
        <h2>
            <?php
            foreach ($categories as $category) {

                if ($category['categoryID'] == $category_id) {

                    echo htmlspecialchars(
                        $category['categoryName']
                    );
                }
            }
            ?>
        </h2>
        <table>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th class="right">Price</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($products as $product) : ?>
            <tr>
                <td>
                    <?php
                    echo htmlspecialchars(
                        $product['productCode']
                    );
                    ?>
                </td>
                <td>
                    <?php
                    echo htmlspecialchars(
                        $product['productName']
                    );
                    ?>
                </td>
                <td class="right">
                    <?php
                    echo number_format(
                        $product['listPrice'],
                        2
                    );
                    ?>
                </td>
                <td>
                    <form action="delete_product.php"
                          method="post">

                        <input type="hidden"
                               name="product_id"
                               value="<?php
                               echo $product['productID'];
                               ?>">
                        <input type="hidden"
                               name="category_id"
                               value="<?php
                               echo $category_id;
                               ?>">
                        <input type="submit"
                               value="Delete">
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <!-- Add Product -->
        <p>
            <a href="add_product_form.php">
                Add Product
            </a>
        </p>
        <!-- List Categories -->
        <p>
            <a href="category_list.php">
                List Categories
            </a>
        </p>
    </section>
</main>
<footer>
    <p>
        &copy; <?php echo date("Y"); ?>
        My Guitar Shop, Inc.
    </p>
</footer>
</body>
</html>
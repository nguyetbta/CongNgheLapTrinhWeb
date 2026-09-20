<?php
require_once('database.php');
// Get categories
$query = 'SELECT * FROM categories
          ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet"
          type="text/css"
          href="main.css" />
</head>
<body>
<header>
    <h1>Product Manager</h1>
</header>
<main>
    <h1>Add Product</h1>
    <form action="add_product.php"
          method="post">
        <label>Category:</label>
        <select name="category_id">
            <?php foreach ($categories as $category) : ?>
            <option value="<?php
                echo $category['categoryID'];
            ?>">
                <?php
                echo htmlspecialchars(
                    $category['categoryName']
                );
                ?>
            </option>
            <?php endforeach; ?>
        </select>
        <br><br>
        <label>Code:</label>
        <input type="text"
               name="code">
        <br><br>
        <label>Name:</label>
        <input type="text"
               name="name">
        <br><br>
        <label>List Price:</label>
        <input type="text"
               name="price">
        <br><br>
        <input type="submit"
               value="Add Product">
    </form>
    <br>
    <p>
        <a href="index.php">
            List Products
        </a>
    </p>
</main>
<footer>
    <p>
        &copy; <?php echo date("Y"); ?>
        My Guitar Shop, Inc.
    </p>
</footer>
</body>
</html>
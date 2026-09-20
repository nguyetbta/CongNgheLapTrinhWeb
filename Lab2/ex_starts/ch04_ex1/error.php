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
    <h1>Error</h1>
    <p>
        <?php echo $error; ?>
    </p>
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
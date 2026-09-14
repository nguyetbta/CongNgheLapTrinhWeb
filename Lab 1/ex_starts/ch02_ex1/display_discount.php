<?php
$product_description = filter_input(INPUT_POST, 'product_description');
$list_price = filter_input(INPUT_POST, 'list_price', FILTER_VALIDATE_FLOAT);
$discount_percent = filter_input(INPUT_POST, 'discount_percent', FILTER_VALIDATE_FLOAT);

$discount_amount = $list_price * $discount_percent / 100;

$discount_price = $list_price - $discount_amount;

$list_price = '$' . number_format($list_price, 2);
$discount_percent = number_format($discount_percent, 2) . '%';
$discount_amount = '$' . number_format($discount_amount, 2);
$discount_price = '$' . number_format($discount_price, 2);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Discount Calculator</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <main>
        <h1>Product Discount Calculator</h1>

        <p>
            <span>Product Description:</span>
            <?php echo htmlspecialchars($product_description); ?>
        </p>

        <p>
            <span>List Price:</span>
            <?php echo htmlspecialchars($list_price); ?>
        </p>

        <p>
            <span>Discount Percent:</span>
            <?php echo htmlspecialchars($discount_percent); ?>
        </p>

        <p>
            <span>Discount Amount:</span>
            <?php echo htmlspecialchars($discount_amount); ?>
        </p>

        <p>
            <span>Discount Price:</span>
            <?php echo htmlspecialchars($discount_price); ?>
        </p>
    </main>
</body>
</html>
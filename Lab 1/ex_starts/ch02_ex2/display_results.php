<?php

$investment = filter_input(INPUT_POST, 'investment',
    FILTER_VALIDATE_FLOAT);

$interest_rate = filter_input(INPUT_POST, 'interest_rate',
    FILTER_VALIDATE_FLOAT);

$years = filter_input(INPUT_POST, 'years',
    FILTER_VALIDATE_INT);

if ($investment === FALSE || $investment === NULL) {

    $error_message = 'Investment amount must be a valid number.';

} else if ($investment <= 0) {

    $error_message = 'Investment amount must be greater than 0.';

} else if ($interest_rate === FALSE || $interest_rate === NULL) {

    $error_message = 'Interest rate must be a valid number.';

} else if ($interest_rate <= 0) {

    $error_message = 'Interest rate must be greater than 0.';

} else if ($interest_rate > 15) {

    $error_message = 'Interest rate must be less than or equal to 15.';

} else if ($years === FALSE || $years === NULL) {

    $error_message = 'Number of years must be a valid integer.';

} else if ($years <= 0) {

    $error_message = 'Number of years must be greater than 0.';

} else {

    $future_value = $investment;

    for ($i = 1; $i <= $years; $i++) {

        $future_value = $future_value +
            ($future_value * $interest_rate * 0.01);

    }
    
    $future_value = number_format($future_value, 2);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Future Value Calculator</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>

    <main>

        <h1>Future Value Calculator</h1>

        <?php if (!empty($error_message)) : ?>

            <!-- Hi?n th? thông báo l?i -->
            <p class="error">
                <?php echo $error_message; ?>
            </p>

        <?php else : ?>

            <!-- Hi?n th? k?t qu? -->

            <p>
                <strong>Investment Amount:</strong>
                <?php echo '$' . number_format($investment, 2); ?>
            </p>

            <p>
                <strong>Yearly Interest Rate:</strong>
                <?php echo $interest_rate . '%'; ?>
            </p>

            <p>
                <strong>Number of Years:</strong>
                <?php echo $years; ?>
            </p>

            <p>
                <strong>Future Value:</strong>
                <?php echo '$' . $future_value; ?>
            </p>

        <?php endif; ?>


        <!-- Nút quay l?i trang nh?p d? li?u -->
        <p>
            <a href="index.php" class="back-button">Back</a>
        </p>


        <!-- Exercise 2-2:
             Hi?n th? ngày th?c hi?n phép tính -->
        <p class="date">
            This calculation was done on
            <?php echo date('n/j/Y'); ?>.
        </p>

    </main>

</body>
</html>

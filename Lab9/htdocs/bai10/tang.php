<?php
session_start();

// Tang bien dem
if (!isset($_SESSION['count'])) {
    $_SESSION['count'] = 1;
} else {
    $_SESSION['count']++;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tang Dem</title>
</head>
<body>

<h2>So lan truy cap: <?php echo $_SESSION['count']; ?></h2>

<a href="dem.php">Back</a>

</body>
</html>
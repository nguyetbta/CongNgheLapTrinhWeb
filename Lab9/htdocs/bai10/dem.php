<?php
session_start();

// Neu chua co bien count
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
    <title>Dem Session</title>
</head>
<body>

<h2>So lan truy cap: <?php echo $_SESSION['count']; ?></h2>

<a href="tang.php">Next</a>

</body>
</html>
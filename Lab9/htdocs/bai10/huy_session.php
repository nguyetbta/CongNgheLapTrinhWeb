<?php
session_start();

// Xoa bien SESSION name
unset($_SESSION['name']);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Huy Session</title>
</head>
<body>

<?php
if (isset($_SESSION['name'])) {
    echo "Chao ban " . $_SESSION['name'];
} else {
    echo "SESSION name da bi xoa!";
}

echo "<br>";

if (isset($_SESSION['age'])) {
    echo "Tuoi cua ban la: " . $_SESSION['age'];
}
?>

<br>
<a href="session.php">Quay lai</a>

</body>
</html>
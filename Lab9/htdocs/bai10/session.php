<?php
session_start(); // Khoi dong session

// Neu chua co session name thi khoi tao
if (!isset($_SESSION['name'])) {
    $_SESSION['name'] = "hocweb.com.vn";
    $_SESSION['age'] = 120;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Session</title>
</head>
<body>

<?php
echo "Ten ban la: " . $_SESSION['name'] . "<br>";
echo "So tuoi cua ban: " . $_SESSION['age'] . "<br>";
?>

<a href="test_session.php">Click here!</a>

</body>
</html>
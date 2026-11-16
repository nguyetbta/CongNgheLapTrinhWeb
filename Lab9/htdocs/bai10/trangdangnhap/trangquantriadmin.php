<?php
session_start();

// Kiem tra SESSION
if (!isset($_SESSION['username']) ||
    !isset($_SESSION['password'])) {

    echo "<script>
            alert('Ban chua dang nhap!');
            location.href='index.php';
          </script>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Trang Quan Tri</title>
</head>
<body>

<h2>Trang Quan Tri</h2>

<?php
echo "Xin chao: " . htmlspecialchars($_SESSION['username']);
?>

<br><br>

<a href="logout.php">Logout</a>

</body>
</html>
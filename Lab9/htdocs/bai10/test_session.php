<?php
session_start(); // Khoi dong session
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Test Session</title>
</head>
<body>

<?php
echo "Chao ban " . $_SESSION['name'];
echo " co tuoi la: " . $_SESSION['age'];
?>

<br>

<a href="huy_session.php">Huy session</a>

</body>
</html>
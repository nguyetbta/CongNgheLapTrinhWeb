<?php
session_start();
include("../connect.php");

if (isset($_POST['cancel'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['login'])) {
    $name = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM users WHERE Uername = ? AND Password = ?";
    $stmt = mysqli_prepare($connect, $sql);

    mysqli_stmt_bind_param($stmt, "ss", $name, $pass);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['username'] = $name;
        $_SESSION['password'] = $pass;

        header("Location: trangquantriadmin.php");
        exit();
    } else {
        echo "<script>
            alert('Login Failed!');
            location.href='index.php';
        </script>";
    }

    mysqli_stmt_close($stmt);
}
?>
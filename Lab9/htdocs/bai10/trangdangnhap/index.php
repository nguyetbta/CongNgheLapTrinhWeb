<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

<h1>Dang Nhap</h1>

<form action="dangnhap_xuly.php" method="post">

    <table>
        <tr>
            <td>Username:</td>
            <td>
                <input type="text" name="username" required>
            </td>
        </tr>

        <tr>
            <td>Password:</td>
            <td>
                <input type="password" name="password" required>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <input type="checkbox" name="remember">
                Remember
            </td>
        </tr>

        <tr>
            <td>
                <input type="submit" name="login" value="Login">
            </td>
            <td>
                <input type="submit" name="cancel" value="Cancel">
            </td>
        </tr>
    </table>

</form>

</body>
</html>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Form gửi email</title>
</head>
<body>
    <h2>FORM GUI EMAIL</h2>

    <form action="mail.php" method="POST" enctype="multipart/form-data">
        <p>
            <label>Email người nhận:</label><br>
            <input type="email" name="email" required>
        </p>

        <p>
            <label>Tiêu đề:</label><br>
            <input type="text" name="title" required>
        </p>

        <p>
            <label>Nội dung:</label><br>
            <textarea name="content" rows="6" cols="40" required></textarea>
        </p>

        <p>
            <label>File đính kèm:</label><br>
            <input type="file" name="file">
        </p>

        <button type="submit" name="send">Gửi email</button>
    </form>
</body>
</html>

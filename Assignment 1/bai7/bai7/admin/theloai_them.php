
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm thể loại</title>
    <style>
        body {
            font-family: Arial;
            margin: 40px;
            background: #f5f5f5;
        }
        form {
            width: 420px;
            margin: auto;
            padding: 25px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin-top: 15px;
        }
        input, select {
            width: 100%;
            padding: 9px;
            margin-top: 6px;
            box-sizing: border-box;
        }
        button {
            margin-top: 20px;
            padding: 10px 18px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<form action="theloai_them_xl.php"
      method="post"
      enctype="multipart/form-data">

    <h2>THÊM THỂ LOẠI</h2>

    <label>Tên thể loại</label>
    <input type="text" name="TenTL" required>

    <label>Thứ tự</label>
    <input type="number" name="ThuTu" value="0" required>

    <label>Ẩn / Hiện</label>
    <select name="AnHien">
        <option value="0">Ẩn</option>
        <option value="1" selected>Hiện</option>
    </select>

    <label>Icon</label>
    <input type="file" name="image" accept="image/*">

    <button type="submit" name="Them">Thêm</button>
    <button type="reset">Hủy</button>

    <p>
        <a href="theloai.php">Quay lại danh sách</a>
    </p>
</form>

</body>
</html>
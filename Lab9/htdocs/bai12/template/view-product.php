<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Chi tiet san pham</title>
    <link href="template/css.css" type="text/css" rel="stylesheet">
</head>

<body>
    <div id="container">

        <header>
            <h1>
                <a href="index.php">COMPUTER ABC</a>
            </h1>
        </header>

        <div id="main-wrapper">

            <div id="product-info">
                <?php echo $html; ?>
            </div>

            <div id="rating">

                <form action="" method="POST">

                    <h3>Danh gia san pham</h3>

                    <label>
                        <input type="radio" name="rate" value="5" checked>
                        5 sao
                    </label>

                    <label>
                        <input type="radio" name="rate" value="4">
                        4 sao
                    </label>

                    <label>
                        <input type="radio" name="rate" value="3">
                        3 sao
                    </label>

                    <label>
                        <input type="radio" name="rate" value="2">
                        2 sao
                    </label>

                    <label>
                        <input type="radio" name="rate" value="1">
                        1 sao
                    </label>

                    <br>

                    <input type="submit"
                           name="rate_submit"
                           value="Rate"
                           id="submit-button">

                </form>

            </div>

            <p>
                <a href="index.php">Quay lai danh sach san pham</a>
            </p>

        </div>

        <footer>
            <p>Trang danh gia san pham</p>
        </footer>

    </div>
</body>
</html>
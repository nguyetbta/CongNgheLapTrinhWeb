<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Upload hình ảnh</title>
</head>
<body>

    <form action="" method="post" enctype="multipart/form-data">

        <input type="hidden" name="MAX_FILE_SIZE" value="5000000">

        <label>Upload
            <input type="file" name="ufile" id="ufile">
        </label>

        <p>
            <input type="submit" name="upload" value="Up load">
        </p>

    </form>

    <?php
    // Thu muc de upload hinh anh
    $target_path = "uploads/";

    // Kiem tra nguoi dung da nhan nut upload
    if (isset($_POST['upload'])) {

        // Kiem tra da chon file chua
        if (isset($_FILES['ufile']) && $_FILES['ufile']['error'] == 0) {

            // Lay ten file
            $file_name = basename($_FILES['ufile']['name']);

            // Duong dan luu file
            $target_file = $target_path . $file_name;

            // Kiem tra dinh dang file
            if (!preg_match('/\.(jpg|gif)$/i', $file_name)) {

                echo "Khong phai file anh!";

            } 
            // Kiem tra file trung ten
            elseif (file_exists($target_file)) {

                echo $file_name . " already exists.";

            } 
            // Tien hanh upload file
            elseif (move_uploaded_file(
                $_FILES['ufile']['tmp_name'],
                $target_file
            )) {

                echo "The file " . $file_name . " has been uploaded";

            } else {

                echo "There was an error uploading the file!";
            }

        } else {

            echo "Vui long chon file!";
        }
    }
    ?>

</body>
</html>

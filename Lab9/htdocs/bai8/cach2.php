<?php
// Include the CKEditor class.
include_once "ckeditor/ckeditor.php";

// Create a class instance.
$CKEditor = new CKEditor();

// Path to the CKEditor directory.
$CKEditor->basePath = '/bai8/ckeditor/';

// Replace all textarea elements.
$CKEditor->replaceall();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CKEditor - Cach 2</title>

<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
</head>

<body>

<form action="" method="post">

    <textarea name="tomtat" cols="50" rows="5"></textarea>

    <textarea name="tomtat1" cols="50" rows="5"></textarea>

    <input name="ok" type="submit" value="Ok" />

</form>

<?php
if(isset($_POST["tomtat"]))
    echo stripslashes($_POST["tomtat"]) . "<br><br>";

if(isset($_POST["tomtat1"]))
    echo $_POST["tomtat1"];
?>

</body>
</html>

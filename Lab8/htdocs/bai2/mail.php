
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if (isset($_POST['send'])) {
    $email = trim($_POST['email']);
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        // Thay bang Gmail cua ban
        $mail->Username = 'GMAIL_CUA_BAN@gmail.com';

        // Thay bang mat khau ung dung Gmail
        $mail->Password = 'MAT_KHAU_UNG_DUNG';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        $mail->CharSet = 'UTF-8';

        $mail->setFrom(
            'GMAIL_CUA_BAN@gmail.com',
            'Lab 8 PHP'
        );

        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = $title;
        $mail->Body = nl2br(htmlspecialchars($content));

        // Neu co chon file thi dinh kem
        if (
            isset($_FILES['file']) &&
            $_FILES['file']['error'] === UPLOAD_ERR_OK
        ) {
            $mail->addAttachment($_FILES['file']['tmp_name'],
                                 $_FILES['file']['name']);
        }

        $mail->send();
        echo "Gui email thanh cong!";
    } catch (Exception $e) {
        echo "Gui email that bai: " . $mail->ErrorInfo;
    }
} else {
    echo "Vui long gui thong tin tu form.";
}
?>

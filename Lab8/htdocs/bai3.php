
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    // Cau hinh SMTP Gmail
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    // Gmail cua nguoi gui
    $mail->Username = 'GMAIL_CUA_BAN@gmail.com';

    // Mat khau ung dung Gmail
    $mail->Password = 'MAT_KHAU_UNG_DUNG';

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;
    $mail->CharSet = 'UTF-8';

    $mail->setFrom('GMAIL_CUA_BAN@gmail.com', 'Lab 8 PHP');

    // Danh sach email nguoi nhan, cach nhau bang dau phay
    $recipients = 'nguoinhan1@gmail.com,nguoinhan2@gmail.com,nguoinhan3@gmail.com';

    // Tach danh sach email thanh mang
    $emails = explode(',', $recipients);

    // Gui email cho tung nguoi
    foreach ($emails as $email) {
        $email = trim($email);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mail->addAddress($email);
        }
    }

    $mail->isHTML(true);
    $mail->Subject = 'Email test bai 3';
    $mail->Body = '<h3>Xin chao!</h3><p>Day la email thu nghiem gui cho nhieu nguoi.</p>';

    $mail->send();

    echo 'Gui email thanh cong!';
} catch (Exception $e) {
    echo 'Gui email that bai: ' . $mail->ErrorInfo;
}
?>

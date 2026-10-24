
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

// Tao doi tuong PHPMailer
$mail = new PHPMailer(true);

try {
    // Cau hinh SMTP Gmail
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    // Gmail dung de gui
    $mail->Username = 'GMAIL_PHU_CUA_BAN@gmail.com';

    // Dien mat khau ung dung sau khi tao duoc
    $mail->Password = 'MAT_KHAU_UNG_DUNG';

    // SSL, cong 465
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    $mail->CharSet = 'UTF-8';

    // Email nguoi gui
    $mail->setFrom(
        'GMAIL_PHU_CUA_BAN@gmail.com',
        'Lab 8 PHP'
    );

    // Email nguoi nhan
    $mail->addAddress('EMAIL_NHAN@gmail.com');

    // Noi dung email
    $mail->isHTML(true);
    $mail->Subject = 'Test email from PHP';
    $mail->Body = '
        <h3>Gui email thanh cong!</h3>
        <p>Day la email thu nghiem tu PHP.</p>
    ';

    // Gui email
    $mail->send();

    echo 'Email sent successfully!';

} catch (Exception $e) {
    echo 'Khong gui duoc email: ' . $mail->ErrorInfo;
}

?>

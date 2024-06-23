<?php
require_once('../../config/config.php');
require_once('../../config/csrf.php');
require_once('../../plugins/encryptor.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once('../../plugins/phpmailer/src/Exception.php');
require_once('../../plugins/phpmailer/src/PHPMailer.php');
require_once('../../plugins/phpmailer/src/SMTP.php');

$token = generateCSRFToken();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['occ_id']) && isset($_POST['email'])) {
        if (isset($_POST['token']) && verifyCSRFToken($_POST['token'])) {
            $occupantsID = filter_input(INPUT_POST, 'occ_id', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

            $today = date('Y-m-d H:i:s');
            $stmt = $pdo->prepare('UPDATE applications SET application_status = ?, updated_at = ? WHERE occ_id = ?');
            $stmt->execute(['2', $today, $occupantsID]);

            if ($stmt) {
                // get content for email template
                ob_start();
                require('reject_email.php');
                $html = ob_get_contents();
                ob_clean();

                // phpmailer
                $mail = new PHPMailer(true);
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'ekokedikvks@gmail.com';
                $mail->Password = 'fgtonplogarkcsvj';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->setFrom('e-kokedikvks@kvkualaselangor.com', 'KOLEJ KEDIAMAN, KV KUALA SELANGOR');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'PERMOHONAN PENEMPATAN KOLEJ KEDIAMAN BAGI SESI 2024';
                $mail->Body = $html;
                $mail->send();
                echo 'ok';
                exit;
            } else {
                echo 'notok';
                exit;
            }
        } else {
            echo 'tokenerr';
            exit;
        }
    } else {
        echo 'iderr';
        exit;
    }

}
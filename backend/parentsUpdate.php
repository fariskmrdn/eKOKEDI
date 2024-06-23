<?php
require('../config/config.php');
require('../config/csrf.php');
require_once('../config/redirectifAuthenticated.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once('../plugins/phpmailer/src/Exception.php');
require_once('../plugins/phpmailer/src/PHPMailer.php');
require_once('../plugins/phpmailer/src/SMTP.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['token']) && verifyCSRFToken($_POST['token'])) {
        // Father's data
        $occ_father = filter_input(INPUT_POST, 'occ_father', FILTER_SANITIZE_SPECIAL_CHARS);
        $occ_father_notel = filter_input(INPUT_POST, 'occ_father_notel', FILTER_SANITIZE_NUMBER_INT);
        $occ_father_job = filter_input(INPUT_POST, 'occ_father_job', FILTER_SANITIZE_SPECIAL_CHARS);
        $occ_father_salary = filter_input(INPUT_POST, 'occ_father_salary', FILTER_SANITIZE_NUMBER_FLOAT);
        $occ_father_dependants = filter_input(INPUT_POST, 'occ_father_dependants', FILTER_SANITIZE_NUMBER_INT);

        // Mother's data
        $occ_mother = filter_input(INPUT_POST, 'occ_mother', FILTER_SANITIZE_SPECIAL_CHARS);
        $occ_mother_notel = filter_input(INPUT_POST, 'occ_mother_notel', FILTER_SANITIZE_NUMBER_INT);
        $occ_mother_job = filter_input(INPUT_POST, 'occ_mother_job', FILTER_SANITIZE_SPECIAL_CHARS);
        $occ_mother_salary = filter_input(INPUT_POST, 'occ_mother_salary', FILTER_SANITIZE_NUMBER_FLOAT);
        $occ_mother_dependants = filter_input(INPUT_POST, 'occ_mother_dependants', FILTER_SANITIZE_NUMBER_INT);

        $occ_father_file_extension = strtolower(pathinfo($_FILES["occ_father_slip"]["name"], PATHINFO_EXTENSION));
        $occ_mother_file_extension = strtolower(pathinfo($_FILES["occ_mother_slip"]["name"], PATHINFO_EXTENSION));

        // $allowed_extensions = ["png", "jpg", "jpeg", "pdf"];

        // if (!in_array($occ_father_file_extension, $allowed_extensions) || !in_array($occ_mother_file_extension, $allowed_extensions)) {
        //     $_SESSION['title'] = 'Muat Naik Gagal!';
        //     $_SESSION['icon'] = 'error';
        //     $_SESSION['text'] = 'Sila muat naik slip gaji dengan format png/jpg/jpeg/pdf sahaja!';
        //     header('Location: /parents.php');
        //     exit();
        // }

        $dir = "../payslips/";

        $newFileName1 = uniqid('father_') . '_' . uniqid() . '.' . $occ_father_file_extension;
        $newFileName2 = uniqid('mother_') . '_' . uniqid() . '.' . $occ_mother_file_extension;
        $occ_father_payslip = $newFileName1;
        $occ_mother_payslip = $newFileName2;

        if ($_FILES["occ_father_slip"]["size"] > 5 * 1024 * 1024) {
            $_SESSION['title'] = 'Muat Naik Gagal!';
            $_SESSION['icon'] = 'error';
            $_SESSION['text'] = 'Sila muat naik slip gaji bapa tidak melebihi 5MB';
            header('Location: /parents.php');
            exit();
        }

        if ($_FILES["occ_mother_slip"]["size"] > 5 * 1024 * 1024) {
            $_SESSION['title'] = 'Muat Naik Gagal!';
            $_SESSION['icon'] = 'error';
            $_SESSION['text'] = 'Sila muat naik slip gaji ibu tidak melebihi 5MB';
            header('Location: /parents.php');
            exit();
        }


        if (
            move_uploaded_file($_FILES["occ_father_slip"]["tmp_name"], $dir . $occ_father_payslip) &&
            move_uploaded_file($_FILES["occ_mother_slip"]["tmp_name"], $dir . $occ_mother_payslip)
        ) {
            try {
                $updateParentsProfile = $pdo->prepare(
                    "UPDATE occupants_profiles SET
                    father_name = ?, father_telno = ?, father_job = ?, father_monthly_salary = ?, father_dependants = ?, father_slip = ?,
                    mother_name = ?, mother_telno = ?, mother_job = ?, mother_monthly_salary = ?, mother_dependants = ?, mother_slip = ?
                    WHERE occ_id = ?"
                );

                $updateParentsProfile->execute([
                    $occ_father, $occ_father_notel, $occ_father_job, $occ_father_salary, $occ_father_dependants, $occ_father_payslip,
                    $occ_mother, $occ_mother_notel, $occ_mother_job, $occ_mother_salary, $occ_mother_dependants, $occ_mother_payslip, $student['occ_id']
                ]);

                if ($updateParentsProfile) {
                    $today = date('Y-m-d H:i:s');
                    $sendApplication = $pdo->prepare("INSERT INTO applications (occ_id, application_status, updated_at) VALUES (?,?, ?)");
                    $sendApplication->execute([$student['occ_id'], '1', $today]);

                    // get content for email template
                    ob_start();
                    require('emailTemplate.php');
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
                    $mail->addAddress($student['email']);
                    $mail->isHTML(true);
                    $mail->Subject = 'PERMOHONAN PENEMPATAN KOLEJ KEDIAMAN BAGI SESI 2024';
                    $mail->Body = $html;
                    $mail->send();

                    header('Location: /end.php');
                    exit();
                } else {
                    $_SESSION['title'] = 'Kemaskini Gagal!';
                    $_SESSION['icon'] = 'error';
                    $_SESSION['text'] = 'Sila cuba sebentar lagi!';
                    header('Location: /parents.php');
                    exit();
                }
            } catch (PDOException $e) {
                error_log('Database Error: ' . $e->getMessage());
                $_SESSION['title'] = 'Kemaskini Gagal!';
                $_SESSION['icon'] = 'error';
                $_SESSION['text'] = 'Sila cuba sebentar lagi!';
                header('Location: /parents.php');
                exit();
            }
        } else {
            $_SESSION['title'] = 'Kemaskini Gagal!';
            $_SESSION['icon'] = 'error';
            $_SESSION['text'] = 'Slip gaji tidak dapat disimpan. Sila cuba sekali lagi!';
            header('Location: /parents.php');
            exit();
        }
    } else {
        $_SESSION['title'] = 'Kemaskini Gagal';
        $_SESSION['icon'] = 'error';
        $_SESSION['text'] = 'Sila cuba sebentar lagi';
        header('Location: /parents.php');
        exit();
    }
}
?>
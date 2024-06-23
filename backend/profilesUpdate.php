<?php
require('../config/config.php');
require('../config/csrf.php');
require_once('../config/redirectifAuthenticated.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['token']) && verifyCSRFToken($_POST['token'])) {
        $occ_notel = filter_input(INPUT_POST, 'occ_notel', FILTER_SANITIZE_NUMBER_INT);
        $occ_programme = filter_input(INPUT_POST, 'occ_programme', FILTER_SANITIZE_NUMBER_INT);
        $occ_email = filter_input(INPUT_POST, 'occ_email', FILTER_SANITIZE_EMAIL);
        $occ_address = filter_input(INPUT_POST, 'occ_address', FILTER_SANITIZE_SPECIAL_CHARS);
        $occ_states = filter_input(INPUT_POST, 'occ_states', FILTER_SANITIZE_SPECIAL_CHARS);
        $occ_semester = filter_input(INPUT_POST, 'occ_semester', FILTER_SANITIZE_SPECIAL_CHARS);

        try {
            $updateOccupants = $pdo->prepare("UPDATE occupants SET notel = ?, email = ?, semester = ?, programme_id = ? WHERE occ_id = ?");
            $updateOccupants->execute([$occ_notel, $occ_email, $occ_semester, $occ_programme, $student['occ_id']]);

            $updateProfiles = $pdo->prepare("UPDATE occupants_profiles SET address = ?, state = ? WHERE occ_id = ?");
            $updateProfiles->execute([$occ_address, $occ_states, $student['occ_id']]);

            if ($updateOccupants && $updateProfiles) {
                header('Location: /parents.php');
                exit();
            } else {
                $_SESSION['title'] = 'Kemaskini Gagal';
                $_SESSION['icon'] = 'error';
                $_SESSION['text'] = 'Kemaskini profil penghuni gagal. Sila pastikan maklumat yang di isi adalah tepat.';
                header('Location: /registration.php');
                exit();
            }
        } catch (PDOException $e) {
            $_SESSION['title'] = 'Kemaskini Gagal';
            $_SESSION['icon'] = 'error';
            $_SESSION['text'] = 'Sila cuba sebentar lagi.';
            header('Location: /registration.php');
            exit();
        }
    } else {
        $_SESSION['title'] = 'Kemaskini Gagal';
        $_SESSION['icon'] = 'error';
        $_SESSION['text'] = 'Sila cuba sebentar lagi';
        header('Location: /registration.php');
        exit();
    }
}

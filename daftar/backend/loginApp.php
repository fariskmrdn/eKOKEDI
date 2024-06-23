<?php

require('../../config/config.php');
require('../../config/csrf.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['occ_nric']) && isset($_POST['occ_stdno'])) {
        if (isset($_POST['token']) && verifyCSRFToken($_POST['token'])) {

            $name = filter_input(INPUT_POST, 'occ_name', FILTER_SANITIZE_SPECIAL_CHARS);
            $nric = filter_input(INPUT_POST, 'occ_nric', FILTER_SANITIZE_SPECIAL_CHARS);
            $stdid = filter_input(INPUT_POST, 'occ_stdno', FILTER_SANITIZE_SPECIAL_CHARS);
            $notel = filter_input(INPUT_POST, 'occ_notel', FILTER_SANITIZE_NUMBER_INT);
            $programme = filter_input(INPUT_POST, 'occ_prog', FILTER_SANITIZE_NUMBER_INT);
            $semester = filter_input(INPUT_POST, 'occ_semester', FILTER_SANITIZE_SPECIAL_CHARS);
            $room = filter_input(INPUT_POST, 'occ_room', FILTER_SANITIZE_NUMBER_INT);
            $email = filter_input(INPUT_POST, 'occ_email', FILTER_SANITIZE_EMAIL);


            $findAcc = $pdo->prepare("SELECT * FROM occupants WHERE nokp = ?");
            $findAcc->execute([$nric]);
            $acc = $findAcc->fetch();

            if ($acc) {
                $_SESSION['title'] = 'Ralat';
                $_SESSION['text'] = 'Data penghuni telah wujud! Sila log masuk ke eKOKEDI.';
                $_SESSION['icon'] = 'error';
                header('Location: ../../index.php');
                exit();
            } else {
                try {
                    $pdo->beginTransaction();
                    $createAcc = $pdo->prepare("INSERT INTO occupants (name, nokp, std_no, notel, programme_id, semester, room_id, email) VALUES (?,?,?,?,?,?,?,?)");
                    $createAcc->execute([$name, $nric, $stdid, $notel, $programme, $semester, $room, $email]);

                    if ($createAcc) {
                        $pdo->commit();

                        $traceBack = $pdo->prepare("SELECT occ_id FROM occupants WHERE nokp = ?");
                        $traceBack->execute([$nric]);
                        $trace = $traceBack->fetch();

                        $createOccProf = $pdo->prepare("INSERT INTO occupants_profiles (occ_id) VALUES (?)");
                        $createOccProf->execute([$trace['occ_id']]);
                        $_SESSION['loggedIn'] = true;
                        $_SESSION['occupants_id'] = $trace['occ_id'];
                        header('Location: ../profile.php');
                        exit();
                    } else {
                        $_SESSION['title'] = 'Ralat';
                        $_SESSION['text'] = 'Sila cuba sebentar lagi';
                        $_SESSION['icon'] = 'error';
                        header('Location: ../index.php');
                        exit();
                    }
                } catch (PDOException $e) {
                    $_SESSION['title'] = 'Ralat';
                    $_SESSION['text'] = 'Sila cuba sebentar lagi';
                    $_SESSION['icon'] = 'error';
                    header('Location: ../index.php');
                    exit();
                }
            }

        } else {
            $_SESSION['title'] = 'Ralat';
            $_SESSION['text'] = 'Sila cuba sebentar lagi';
            $_SESSION['icon'] = 'error';
            header('Location: ../index.php');
            exit();
        }

    }
}
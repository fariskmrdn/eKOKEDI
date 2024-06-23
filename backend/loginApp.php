<?php

require('../config/config.php');
require('../config/csrf.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['occ_nric']) && isset($_POST['occ_stdno'])) {
        if (isset($_POST['token']) && verifyCSRFToken($_POST['token'])) {

            $nric = filter_input(INPUT_POST, 'occ_nric', FILTER_SANITIZE_SPECIAL_CHARS);
            $stdid = filter_input(INPUT_POST, 'occ_stdno', FILTER_SANITIZE_SPECIAL_CHARS);

            $findAcc = $pdo->prepare("SELECT * FROM occupants WHERE nokp = ? AND status = ?");
            $findAcc->execute([$nric, 1]);
            $acc = $findAcc->fetch();

            if ($acc) {
                if ($acc['std_no'] === $stdid) {
                    $date = date('Y-m-d H:i:s');
                    $record = $pdo->prepare("UPDATE occupants SET last_login = ? WHERE nokp = ?");
                    $record->execute([$date, $nric]);

                    // check for profiles
                    $occupantsProfiles = $pdo->prepare("SELECT * FROM occupants_profiles WHERE occ_id = ?");
                    $occupantsProfiles->execute([$acc['occ_id']]);
                    $profileExist = $occupantsProfiles->fetch();

                    if ($profileExist) {

                        $checkApplication = $pdo->prepare("SELECT * FROM applications WHERE occ_id = ?");
                        $checkApplication->execute([$acc['occ_id']]);
                        
                        $result = $checkApplication->fetch(); 
                        
                        if (!$result) {
                            $_SESSION['loggedIn'] = true;
                            $_SESSION['occupants_id'] = $acc['occ_id'];
                            header('Location: /registration.php');
                            exit(); 

                        } else {
                            $_SESSION['loggedIn'] = true;
                            $_SESSION['occupants_id'] = $acc['occ_id'];
                            header('Location: /student/index.php');
                            exit();

                        }
                        
                    } else {
                        $createProfiles = $pdo->prepare("INSERT INTO occupants_profiles (occ_id) VALUES (?)");
                        $createProfiles->execute([$acc['occ_id']]);

                        $_SESSION['loggedIn'] = true;
                        $_SESSION['occupants_id'] = $acc['occ_id'];
                        header('Location: /registration.php');
                        exit();
                    }


                } else {
                    $_SESSION['title'] = 'Log Masuk Gagal';
                    $_SESSION['text'] = 'No. Matriks tidak tepat';
                    $_SESSION['icon'] = 'error';
                    header('Location: /index.php');
                    exit();
                }
            } else {
                $_SESSION['title'] = 'Log Masuk Gagal';
                $_SESSION['text'] = 'Akaun Tidak Wujud';
                $_SESSION['icon'] = 'error';
                header('Location: /index.php');
                exit();
            }
        } else {
            $_SESSION['title'] = 'Ralat';
            $_SESSION['text'] = 'Sila cuba sebentar lagi';
            $_SESSION['icon'] = 'error';
            header('Location: /index.php');
            exit();
        }
    } else {
        $_SESSION['title'] = 'Ralat';
        $_SESSION['text'] = 'Sila cuba sebentar lagi';
        $_SESSION['icon'] = 'error';
        header('Location: /index.php');
        exit();
    }

}
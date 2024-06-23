<?php



require('../../config/config.php');

require('../../config/csrf.php');



if ($_SERVER['REQUEST_METHOD'] === 'POST') {



    if (isset($_POST['admin_username']) && isset($_POST['admin_password'])) {

        if (isset($_POST['token']) && verifyCSRFToken($_POST['token'])) {



            $username = filter_input(INPUT_POST, 'admin_username', FILTER_SANITIZE_SPECIAL_CHARS);

            $password = filter_input(INPUT_POST, 'admin_password', FILTER_SANITIZE_SPECIAL_CHARS);




            $acc = $pdo->prepare("SELECT * FROM admins WHERE username = ?");

            $acc->execute([$username]);

            $fetch = $acc->fetch();
		
	    if ($fetch) {

                if (password_verify($password, $fetch['password'])){

                    $_SESSION['loggedIn'] = true;

                    $_SESSION['admin_id'] = $fetch['admin_id'];

                    header('Location: ../dashboard.php');

                    exit();

                } else {

		$_SESSION['title'] = 'Log Masuk Gagal';

                $_SESSION['text'] = 'Kata laluan tidak betul';

                $_SESSION['icon'] = 'error';

                header('Location: ../index.php');

                exit();

		
		}

            } else {

                $_SESSION['title'] = 'Log Masuk Gagal';

                $_SESSION['text'] = 'Akaun tidak wujud';

                $_SESSION['icon'] = 'error';

                header('Location: ../index.php');

                exit();

            }
           
        } else {

            $_SESSION['title'] = 'Ralat';

            $_SESSION['text'] = 'Sila cuba sebentar lagi';

            $_SESSION['icon'] = 'error';

            header('Location: ../index.php');

            exit();

        }

    } else {

        $_SESSION['title'] = 'Ralat';

        $_SESSION['text'] = 'Sila cuba sebentar lagi';

        $_SESSION['icon'] = 'error';

        header('Location: ../index.php');

        exit();

    }



}
<?php

require_once('config/config.php');

$getProgramme = $pdo->prepare("SELECT * FROM programme ORDER BY cert_level ASC");
$getProgramme->execute();
$programme = $getProgramme->fetchAll();

$getRooms = $pdo->prepare("SELECT * FROM rooms ORDER BY room_name ASC");
$getRooms->execute();
$room = $getRooms->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="../../">
    <meta charset="utf-8">
    <meta name="author" content="Kolej Vokasional Kuala Selangor">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>eKOKEDI - Portal Pendaftaran Kolej Kediaman, Kolej Vokasional Kuala Selangor</title>
    <link rel="shortcut icon" href="images/kv.png">
    <link rel="stylesheet" href="assets/css/style.css?v1.1.2">
</head>

<body class="nk-body" data-sidebar-collapse="lg" data-navbar-collapse="lg">
    <!-- Root  -->
    <div class="nk-app-root">
        <!-- main  -->
        <div class="nk-main">
            <div class="nk-wrap align-items-center justify-content-center">
                <div class="container p-2 p-sm-4">
                    <div class="wide-xs mx-auto">
                        <div class="text-center mb-5">
                            <div class="brand-logo mb-1">
                                <a href="./html/index.html" class="logo-link">
                                    <div class="logo-wrap">
                                        <img class="logo-img logo-light" src="images/KVKS.png"
                                            srcset="images/KVKS.png 2x" alt="">
                                        <img class="logo-img logo-dark" src="images/KVKS.png"
                                            srcset="images/KVKS.png 2x" alt="">
                                        <img class="logo-img logo-icon" src="images/KVKS.png"
                                            srcset="images/KVKS.png 2x" alt="">
                                    </div>
                                </a>
                            </div>
                            <p><b>Portal Pendaftaran dan Pengurusan Penghuni Kolej Kediaman</b>
                                <br>
                                Kolej Vokasional Kuala Selangor
                                <br>
                                Bahagian Pendidikan dan Latihan Teknikal Vokasional
                                <br>
                                Kementerian Pendidikan Malaysia
                            </p>
                        </div>
                        <div class="card card-gutter-lg rounded-4 card-auth">
                            <div class="card-body">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h3 class="nk-block-title mb-1 text-center text-success">Penghantaran Permohonan Berjaya!
                                        </h3>
                                        <p class="small text-center">Keputusan permohonan bagi penempatan Kolej Kediaman akan dihantar melalui emel yang telah didaftarkan. Sekian.</p>
                                        <P class="small text-center"><a href="backend/logout.php">Log Keluar</a></P>
                                    </div>
                                </div>

                            </div><!-- .card-body -->
                        </div><!-- .card -->
                        <div class="text-center mt-5">
                            <p class="small">&copy; Hakmilik Unit Kolej Kediaman, Kolej Vokasional Kuala Selangor
                                <?= date('Y') ?>
                            </p>
                        </div>
                    </div><!-- .col -->
                </div><!-- .container -->
            </div>
        </div> <!-- .nk-main -->
    </div> <!-- .nk-app-root -->
</body>
<!-- JavaScript -->
<script src="assets/js/bundle.js"></script>
<script src="assets/js/scripts.js"></script>

<!-- <script>
    Swal.fire({

    });
</script> -->

</html>
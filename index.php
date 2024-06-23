<?php

require_once('config/config.php');
require_once('config/csrf.php');

$token = generateCSRFToken();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="../../">
    <meta charset="utf-8">
    <meta name="author" content="Kolej Vokasional Kuala Selangor">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="Portal pendaftaran dan pengurusan penghuni Kolej Kediaman, Kolej Vokasional Kuala Selangor, Bahagian Pendidikan dan Latihan Teknikal Vokasional, Kementerian Pendidikan Malaysia">
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
                                <a href="index.php" class="logo-link">
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
                                        <h3 class="nk-block-title mb-1">Log Masuk</h3>
                                        <p class="small">Permohonan penempatan Kolej Kediaman, Kolej Vokasional Kuala Selangor Sesi 2024</p>
                                    </div>
                                </div>
                                <form action="backend/loginApp.php" method="POST">
                                    <div class="row gy-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="occ_nric" class="form-label">No. Kad Pengenalan</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="occ_nric"
                                                        id="occ_nric" placeholder="Masukkan No. Kad Pengenalan" required>
                                                </div>
                                            </div><!-- .form-group -->
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="occ_stdno" class="form-label">No. Pelajar/Matriks</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="occ_stdno"
                                                        id="occ_stdno" placeholder="Masukkan No. Pelajar/Matriks" required>
                                                    <input type="hidden" name="token" id="token" value="<?= $token ?>" required>

                                                </div>
                                            </div><!-- .form-group -->
                                        </div>

                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn btn-primary" type="submit">Log Masuk</button>
                                            </div>
                                        </div>
                                    </div><!-- .row -->
                                </form>

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
<script>
    <?php if (isset($_SESSION['title']) != '') { ?>
      Swal.fire({
        title: '<?php echo $_SESSION['title'] ?>',
        icon: '<?php echo $_SESSION['icon'] ?>',
        text: '<?php echo $_SESSION['text'] ?>'
      });
    <?php }
    unset($_SESSION['title']); ?>
  </script>

</html>
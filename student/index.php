<?php

require_once('../config/config.php');
require_once('../config/csrf.php');
require_once('../config/redirectifAuthenticated.php');
require_once('../plugins/encryptor.php');

$token = generateCSRFToken();

// get application info
$applicationStatus = $pdo->prepare("SELECT * FROM applications WHERE occ_id = ?");
$applicationStatus->execute([$student['occ_id']]);
$status = $applicationStatus->fetch();

$hashed = $student['occ_id'];

$hashedLink = encrypt($hashed, $secret_key);

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
    <title>eKOKEDI - Keputusan Permohonan Penempatan Kolej Kediaman</title>
    <link rel="shortcut icon" href="images/kv.png">
    <link rel="stylesheet" href="../assets/css/style.css?v1.1.2">
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
                                        <img class="logo-img logo-light" src="../images/KVKS.png"
                                            srcset="images/KVKS.png 2x" alt="">
                                        <img class="logo-img logo-dark" src="../images/KVKS.png"
                                            srcset="images/KVKS.png 2x" alt="">
                                        <img class="logo-img logo-icon" src="../images/KVKS.png"
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
                                        <h3 class="nk-block-title mb-1 text-center">KEPUTUSAN PERMOHONAN</h3>
                                        <?php if ($status['application_status'] == '1') { ?>
                                            <p class="small text-center">Tahniah! Permohonan anda telah <b
                                                    class="text-success">DILULUSKAN</b></p>
                                            <p class="small text-center">Anda perlu melapor diri seperti ketetapan berikut :
                                            </p>
                                            <div class="table-responsive small">
                                                <table class="table">
                                                    <tr>
                                                        <td style="width:90px;font-weight:bold;">Tarikh :</td>
                                                        <td>1 Januari 2024</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:90px;font-weight:bold;">Hari :</td>
                                                        <td>Isnin</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:90px;font-weight:bold;">Masa :</td>
                                                        <td>
                                                            Belum Ditetapkan 
                                                            <!--<?= ($student['cert_level'] == 'SVM') ? '08:00 pagi - 10:30 pagi' : '10:30 pagi - 01:00 tengah hari' ?>-->
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:90px;font-weight:bold;">Lokasi :</td>
                                                        <td>Dewan Lestari, Kolej Vokasional Kuala Selangor</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <p class="small text-center">Sila <b class='text-danger'>muat turun dan cetak
                                                    dokumen</b> yang telah disertakan. Sila bawa dan serahkan
                                                dokumen-dokumen berikut semasa melapor diri. Terima kasih</p>
                                            <hr>
                                            <p class="small text-center">Muat Turun Fail Dibawah :</p>
                                            <a class="small" href="student/documents/offerLetter.php?iz=<?=$hashedLink?>" target="_blank"><em
                                                    class="icon ni ni-file-download"></em> Muat Turun Surat Tawaran Kolej
                                                Kediaman</a><br />
                                            <a class="small" href="student/documents/AKUJANJI KOLEJ KEDIAMAN .pdf"
                                                target="_blank"><em class="icon ni ni-file-download"></em> Muat Turun Surat
                                                Aku
                                                Janji</a><br />
                                            <a class="small"
                                                href="student/documents/SURAT PENDAFTARAN KOLEJ KEDIAMAN TAHUN 2024.pdf"
                                                target="_blank"><em class="icon ni ni-file-download"></em> Muat Turun Surat
                                                Makluman</a>
                                            <br /><br />
                                            <center>
                                                <button onclick="window.location.href='student/backend/logout.php'"
                                                    class="btn btn-primary">Log Keluar</button>
                                            </center>
                                        <?php } else if ($status['application_status'] == '2') { ?>
                                                <p class="small text-center">Harap Maaf! Permohonan anda telah <b
                                                        class="text-danger">DITOLAK</b></p>
                                                <p class="small text-center">Sekiranya anda ingin mengemukakan rayuan bagi
                                                    penempatan Kolej Kediaman, sila ke kaunter Pejabat Unit Hal Ehwal Pelajar
                                                    untuk proses rayuan</p>

                                                <br /><br />
                                                <center>
                                                    <button onclick="window.location.href='student/backend/logout.php'"
                                                        class="btn btn-primary">Log Keluar</button>
                                                </center>
                                        <?php } else { ?>
                                                <p class="small text-center">Permohonan anda sedang <b
                                                        class="text-warning">DIKEMASKINI</b></p>
                                                <p class="small text-center">Kesabaran dan kerjasama anda amat dihargai. Untuk
                                                    sebarang pertanyaan, sila ke kaunter Pejabat Unit Hal Ehwal Pelajar untuk
                                                    tindakan lanjut.</p>
                                                <br /><br />
                                                <center>
                                                    <button onclick="window.location.href='student/backend/logout.php'"
                                                        class="btn btn-primary">Log Keluar</button>
                                                </center>
                                        <?php } ?>
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
<script src="../assets/js/bundle.js"></script>
<script src="../assets/js/scripts.js"></script>
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
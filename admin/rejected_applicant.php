<?php

require_once('../config/config.php');
require_once('../config/csrf.php');
require_once('../plugins/encryptor.php');

$token = generateCSRFToken();
$decrypted_ID = '';

if (isset($_REQUEST['o'])) {
    $decrypted_ID = decrypt($_REQUEST['o'], $secret_key);
} else {
    session_destroy();
    exit();
}

$getApplicantInfo = $pdo->prepare("SELECT * FROM occupants
JOIN occupants_profiles ON occupants.occ_id = occupants_profiles.occ_id
JOIN programme ON occupants.programme_id = programme.programme_id
JOIN rooms ON occupants.room_id = rooms.room_id
JOIN applications ON occupants.occ_id = applications.occ_id
WHERE occupants.occ_id = ?");
$getApplicantInfo->execute([$decrypted_ID]);
$data = $getApplicantInfo->fetch();

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
    <title>eKOKEDI - Semak Permohonan
        <?= $data['name'] ?>
    </title>
    <link rel="shortcut icon" href="../images/kv.png">
    <link rel="stylesheet" href="../assets/css/style.css?v1.1.2">
</head>

<body class="nk-body" data-sidebar-collapse="lg" data-navbar-collapse="lg">
    <!-- Root -->
    <div class="nk-app-root">
        <!-- main  -->
        <div class="nk-main">
            <div class="nk-sidebar nk-sidebar-fixed is-theme" id="sidebar">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-sidebar-brand">
                        <a href="admin/dashboard.php" class="logo-link">
                            <div class="logo-wrap">
                                <img class="logo-img logo-light" src="../images/KVKS.png" srcset="../images/KVKS.png"
                                    alt="">
                                <img class="logo-img logo-dark" src="../images/KVKS.png" srcset="../images/KVKS.png"
                                    alt="">
                                <img class="logo-img logo-icon" src="../images/KVKS.png" srcset="../images/KVKS.png"
                                    alt="">
                            </div>
                        </a>
                        <div class="nk-compact-toggle me-n1">
                            <button class="btn btn-md btn-icon text-light btn-no-hover compact-toggle">
                                <em class="icon off ni ni-chevrons-left"></em>
                                <em class="icon on ni ni-chevrons-right"></em>
                            </button>
                        </div>
                        <div class="nk-sidebar-toggle me-n1">
                            <button class="btn btn-md btn-icon text-light btn-no-hover sidebar-toggle">
                                <em class="icon ni ni-arrow-left"></em>
                            </button>
                        </div>
                    </div><!-- end nk-sidebar-brand -->
                </div><!-- end nk-sidebar-element -->
                <?php require('layouts/sidebar.php'); ?>
                <!-- sidebar @e -->
                <!-- wrap -->
                <div class="nk-wrap">
                    <?php require('layouts/header.php'); ?>
                    <!-- content -->
                    <div class="nk-content">
                        <div class="container-fluid">
                            <div class="nk-content-inner">
                                <div class="nk-content-body">
                                    <button class="btn btn-secondary" onclick="window.location.href='admin/applications.php'"><em class="icon ni ni-arrow-left"></em>&nbsp;
                                        Kembali</button>
                                    <br />
                                    <br />
                                    <h1>Permohonan
                                        <?= $data['name'] ?>
                                        <br />
                                    </h1>

                                    <div class="row g-gs mt-1">
                                        <div class="col-sm-6 col-xl-12 col-xxl-12">

                                            <div class="row">
                                                <div class="col-lg-12 text-bg-primary p-3">
                                                    <b>MAKLUMAT PERIBADI PEMOHON</b>
                                                </div>

                                                <div class="col-lg-6 col-md-3 p-2"><b>Nama Pemohon :</b>
                                                    <?= $data['name'] ?>
                                                </div>
                                                <div class="col-lg-6 col-md-3 p-2"><b>No. Kad Pengenalan :</b>
                                                    <?= $data['nokp'] ?>
                                                </div>
                                                <div class="col-lg-6 col-md-3 p-2"><b>No. Matriks Pemohon :</b>
                                                    <?= $data['std_no'] ?>
                                                </div>
                                                <div class="col-lg-6 col-md-3 p-2"><b>No. Telefon Pemohon :</b>
                                                    <?= $data['notel'] ?>
                                                </div>
                                                <div class="col-lg-6 col-md-3 p-2"><b>Alamat Emel Pemohon :</b>
                                                    <?= $data['email'] ?>
                                                </div>
                                                <div class="col-lg-6 col-md-3 p-2"><b>Pengajian - Program :</b>
                                                    <?= $data['cert_level'] . ' - ' . $data['programme_name'] ?>
                                                </div>
                                                <div class="col-lg-6 col-md-3 p-2"><b>Semester :</b>
                                                    <?= $data['semester'] ?>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12 text-bg-primary p-3">
                                                    <b>ALAMAT TEMPAT KEDIAMAN</b>
                                                </div>

                                                <div class="col-lg-6 col-md-3 p-2"><b>Alamat Kediaman :</b>
                                                    <?= $data['address'] ?>
                                                </div>
                                                <div class="col-lg-6 col-md-3 p-2"><b>Negeri :</b>
                                                    <?= $data['state'] ?>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12 text-bg-primary p-3">
                                                    <b>MAKLUMAT BAPA / PENJAGA / WARIS</b>
                                                </div>

                                                <!-- FATHER INFO -->
                                                <div class="col-lg-6 col-md-3 p-2"><b>Nama Bapa :</b>
                                                    <?= $data['father_name'] ?>
                                                </div>
                                                <div class="col-lg-6 col-md-3 p-2"><b>No. Telefon Bapa :</b>
                                                    <?= $data['father_telno'] ?>
                                                </div>
                                                <div class="col-lg-3 col-md-3 p-2"><b>Pekerjaan Bapa :</b>
                                                    <?= $data['father_job'] ?>
                                                </div>
                                                <div class="col-lg-3 col-md-3 p-2"><b>Gaji Bapa :</b>
                                                    <?= 'RM ' . number_format($data['father_monthly_salary'], 2) ?>
                                                </div>
                                                <div class="col-lg-3 col-md-3 p-2"><b>Tanggungan :</b>
                                                    <?= $data['father_dependants'] ?>
                                                </div>

                                                <div class="col-lg-12 text-bg-primary p-3">
                                                    <b>MAKLUMAT IBU / PENJAGA / WARIS</b>
                                                </div>
                                                <!-- MOM'S INFO -->
                                                <div class="col-lg-6 col-md-3 p-2"><b>Nama Ibu :</b>
                                                    <?= $data['mother_name'] ?>
                                                </div>
                                                <div class="col-lg-6 col-md-3 p-2"><b>No. Telefon Ibu :</b>
                                                    <?= $data['mother_telno'] ?>
                                                </div>
                                                <div class="col-lg-3 col-md-3 p-2"><b>Pekerjaan Ibu :</b>
                                                    <?= $data['mother_job'] ?>
                                                </div>
                                                <div class="col-lg-3 col-md-3 p-2"><b>Gaji Ibu :</b>
                                                    <?= 'RM ' . number_format($data['mother_monthly_salary'], 2) ?>
                                                </div>
                                                <div class="col-lg-3 col-md-3 p-2"><b>Tanggungan :</b>
                                                    <?= $data['mother_dependants'] ?>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12 text-bg-primary p-3">
                                                    <b>DOKUMEN SOKONGAN</b>
                                                </div>

                                                <!-- FATHER INFO -->
                                                <div class="col-lg-6 col-md-3 p-2">
                                                    <button class="btn btn-info"
                                                        onclick="window.location.href='payslips/<?= $data['father_slip'] ?>'"><em
                                                            class="icon ni ni-files"></em>&nbsp;&nbsp;Slip Gaji
                                                        Bapa</button>
                                                    <button class="btn btn-info"
                                                        onclick="window.location.href='payslips/<?= $data['mother_slip'] ?>'"><em
                                                            class="icon ni ni-files"></em>&nbsp;&nbsp;Slip Gaji
                                                        Ibu</button>

                                                </div>

                                                <div class="col-lg-12" style="text-align:right;">
                                                    <button class="btn btn-success"><em
                                                            class="icon ni ni-check-thick"></em>&nbsp; Luluskan
                                                        Pemohonan</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- .nk-content -->

                <?php //require('layouts/footer.php'); ?>
            </div> <!-- .nk-wrap -->
        </div> <!-- .nk-main -->
    </div> <!-- .nk-app-root -->
</body>

<script src="../assets/js/bundle.js"></script>
<script src="../assets/js/scripts.js"></script>
<script src="../assets/js/data-tables/data-tables.js"></script>

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
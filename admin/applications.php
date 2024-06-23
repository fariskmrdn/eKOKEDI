<?php



require_once('../config/config.php');

require_once('../config/csrf.php');

require_once('../config/redirectifAuthenticated.php');

require_once('../plugins/encryptor.php');



$token = generateCSRFToken();



$successApp = [];

$failedApp = [];

$pendingApp = [];



$getLatestApplications = $pdo->query("SELECT * FROM occupants 

JOIN applications ON occupants.occ_id = applications.occ_id WHERE application_status 

IN ('1','2','0')")

    ->fetchAll();



foreach ($getLatestApplications as $applicant) {

    if ($applicant['application_status'] === '1') {

        $successApp[] = $applicant;

    } else if ($applicant['application_status'] === '2') {

        $failedApp[] = $applicant;

    } else if ($applicant['application_status'] === '0') {

        $pendingApp[] = $applicant;

    }

}



$encrypted_ID = '';

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

    <title>eKOKEDI - Permohonan</title>

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

                                    <h1>Senarai Permohonan</h1>



                                    <div class="row g-gs mt-1">

                                        <div class="col-sm-6 col-xl-6 col-xxl-12">



                                            <ul class="nav nav-pills mb-3">

                                                <li class="nav-item">

                                                    <button class="nav-link active" data-bs-toggle="pill"

                                                        data-bs-target="#lulus" type="button">Permohonan <b

                                                            class="text-success">Diluluskan</b></button>

                                                </li>

                                                <li class="nav-item">

                                                    <button class="nav-link" data-bs-toggle="pill"

                                                        data-bs-target="#pills-profile" type="button">Permohonan <b

                                                            class="text-danger">Ditolak</b></button>

                                                </li>

                                                <li class="nav-item">

                                                    <button class="nav-link" data-bs-toggle="pill"

                                                        data-bs-target="#pills-contact" type="button">Permohonan <b

                                                            class="text-info">Baru</b></button>

                                                </li>

                                            </ul>

                                            <div class="tab-content mt-1">

                                                <div class="tab-pane fade show active" id="lulus">

                                                    <h3>Senarai Pemohon Yang Diluluskan</h3>

                                                    <table class="datatable-init table"

                                                        data-nk-container="table-responsive table-border">

                                                        <thead>

                                                            <tr>

                                                                <th>No.</th>

                                                                <th>Nama Pemohon</th>

                                                                <th>Tarikh Pemohonan</th>

                                                                <th>Tarikh Kelulusan</th>

                                                            </tr>

                                                        </thead>

                                                        <tbody>

                                                            <?php $bil = 1;

                                                            foreach ($successApp as $app) { ?>

                                                                <tr>

                                                                    <td>

                                                                        <?= $bil++ ?>

                                                                    </td>

                                                                    <td>

                                                                        <?= $app['name'] ?>

                                                                    </td>

                                                                    <td>

                                                                        <?= date('d/m/Y h:i A', strtotime($app['application_datetime'])) ?>

                                                                    </td>

                                                                    <td>

                                                                        <?= date('d/m/Y h:i A', strtotime($app['updated_at'])) ?>

                                                                    </td>

                                                                </tr>

                                                            <?php } ?>

                                                        </tbody>

                                                    </table>

                                                </div>

                                                <div class="tab-pane fade" id="pills-profile">

                                                    <h3>Senarai Pemohon Yang Ditolak</h3>

                                                    <table class="datatable-init table"

                                                        data-nk-container="table-responsive table-border">

                                                        <thead>

                                                            <tr>

                                                                <th>No.</th>

                                                                <th>Nama Pemohon</th>

                                                                <th>Tarikh Pemohonan</th>

                                                                <th>Tarikh Penolakan</th>

                                                                <th>Tindakan</th>

                                                            </tr>

                                                        </thead>

                                                        <tbody>

                                                            <?php $bil = 1;

                                                            foreach ($failedApp as $app) {

                                                                $encrypted_ID = encrypt($app['occ_id'], $secret_key);

                                                                ?>

                                                                <tr>

                                                                    <td>

                                                                        <?= $bil++ ?>

                                                                    </td>

                                                                    <td>

                                                                        <?= $app['name'] ?>

                                                                    </td>

                                                                    <td>

                                                                        <?= date('d/m/Y h:i A', strtotime($app['application_datetime'])) ?>

                                                                    </td>

                                                                    <td>

                                                                        <?= date('d/m/Y h:i A', strtotime($app['updated_at'])) ?>

                                                                    </td>

                                                                    <td>

                                                                        <button class="btn btn-primary"

                                                                            onclick="window.location.href='admin/rejected_applicant.php?o=<?= $encrypted_ID ?>'">Semak</button>

                                                                    </td>

                                                                </tr>

                                                            <?php } ?>

                                                        </tbody>

                                                    </table>

                                                </div>

                                                <div class="tab-pane fade" id="pills-contact">

                                                    <h3>Senarai Pemohon Baru</h3>

                                                    <table class="datatable-init table"

                                                        data-nk-container="table-responsive table-border">

                                                        <thead>

                                                            <tr>

                                                                <th>No.</th>

                                                                <th>Nama Pemohon</th>

                                                                <th>Tarikh Pemohonan</th>

                                                                <th>Tindakan</th>

                                                            </tr>

                                                        </thead>

                                                        <tbody>

                                                            <?php $bil = 1;

                                                            foreach ($pendingApp as $app) { 

                                                                $encrypted_ID2 = encrypt($app['occ_id'], $secret_key);

                                                                

                                                                ?>

                                                                <tr>

                                                                    <td>

                                                                        <?= $bil++ ?>

                                                                    </td>

                                                                    <td>

                                                                        <?= $app['name'] ?>

                                                                    </td>

                                                                    <td>

                                                                        <?= date('d/m/Y h:i A', strtotime($app['application_datetime'])) ?>

                                                                    </td>

                                                                    <td>

                                                                        <button class="btn btn-primary"

                                                                            onclick="window.location.href='admin/new_applicant.php?o=<?= $encrypted_ID2 ?>'">Semak</button>

                                                                    </td>

                                                                </tr>

                                                            <?php } ?>

                                                        </tbody>

                                                    </table>

                                                </div>



                                            </div>

                                        </div>

                                    </div>



                                </div>

                            </div>

                        </div>

                    </div>

                </div> <!-- .nk-content -->



                <?php require('layouts/footer.php'); ?>

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
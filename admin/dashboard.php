<?php



require_once('../config/config.php');

require_once('../config/csrf.php');

// require_once('../config/redirectifAuthenticated.php');


$token = generateCSRFToken();



// GET JUMLAH PENGHUNI

$getOccupants = $pdo->query("SELECT COUNT(occ_id) AS student FROM occupants");

$total_occupants = $getOccupants->fetch();

$occ = $total_occupants['student'];



$applicantsSummary = $pdo->query("

    SELECT 

        COUNT(application_id) AS total_applicants,

        SUM(CASE WHEN application_status = '1' THEN 1 ELSE 0 END) AS approved,

        SUM(CASE WHEN application_status = '2' THEN 1 ELSE 0 END) AS rejected

    FROM applications

")->fetch();



$total_applicants = $applicantsSummary['total_applicants'];

$approved = $applicantsSummary['approved'];

$rejected = $applicantsSummary['rejected'];





$successApp = [];

$failedApp = [];



$getLatestApplications = $pdo->query("SELECT * FROM occupants 

JOIN applications ON occupants.occ_id = applications.occ_id WHERE application_status 

IN ('1','2')")

    ->fetchAll();



foreach ($getLatestApplications as $applicant) {

    if ($applicant['application_status'] === '1') {

        $successApp[] = $applicant;

    } else if ($applicant['application_status'] === '2') {

        $failedApp[] = $applicant;

    }

}



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

    <title>eKOKEDI - Dashboard</title>

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

                                    <div class="row g-gs">

                                        <div class="col-sm-6 col-xl-6 col-xxl-3">

                                            <div class="card">

                                                <div class="card-body">

                                                    <div class="card-title-group align-items-start">

                                                        <div class="card-title">

                                                            <h4 class="title">Profil Penghuni Kolej Kediaman</h4>

                                                            <p>Data mengikut retan dan pendaftaran penghuni baru</p>

                                                        </div>

                                                        <div

                                                            class="media media-middle media-circle media-sm text-bg-primary-soft">

                                                            <em class="icon icon-md ni ni-user-alt-fill"></em>

                                                        </div>

                                                    </div><!-- .card-title-group -->

                                                    <div class="mt-2 mb-2">

                                                        <div class="amount h1">

                                                            <?= $occ ?> Penghuni

                                                        </div>

                                                    </div>

                                                </div><!-- .card-body -->

                                            </div><!-- .card -->

                                        </div><!-- .col -->

                                        <div class="col-sm-6 col-xl-6 col-xxl-3">

                                            <div class="card">

                                                <div class="card-body">

                                                    <div class="card-title-group align-items-start">

                                                        <div class="card-title">

                                                            <h4 class="title">Jumlah Permohonan</h4>

                                                        </div>

                                                        <div

                                                            class="media media-middle media-circle media-sm text-bg-success-soft">

                                                            <em class="icon icon-md ni ni-bar-chart-fill"></em>

                                                        </div>

                                                    </div><!-- .card-title-group -->

                                                    <div class="mt-2 mb-2">

                                                        <div class="amount h1">

                                                            <?= $total_applicants ?> Permohonan

                                                        </div>

                                                    </div>

                                                </div><!-- .card-body -->

                                            </div><!-- .card -->

                                        </div><!-- .col -->



                                        <div class="col-sm-6 col-xl-6 col-xxl-3">

                                            <div class="card">

                                                <div class="card-body">

                                                    <div class="card-title-group align-items-start">

                                                        <div class="card-title">

                                                            <h4 class="title">Permohonan Lulus</h4>

                                                        </div>

                                                        <div

                                                            class="media media-middle media-circle media-sm text-bg-warning-soft">

                                                            <em class="icon icon-md ni ni-activity-round-fill"></em>

                                                        </div>

                                                    </div><!-- .card-title-group -->

                                                    <div class="mt-2 mb-2">

                                                        <div class="amount h1">

                                                            <?= $approved ?>

                                                        </div>

                                                    </div>

                                                </div><!-- .card-body -->

                                            </div><!-- .card -->

                                        </div><!-- .col -->



                                        <div class="col-sm-6 col-xl-6 col-xxl-3">

                                            <div class="card h-100">

                                                <div class="card-body">

                                                    <div class="card-title-group align-items-start">

                                                        <div class="card-title">

                                                            <h4 class="title">Permohonan Ditolak</h4>

                                                        </div>

                                                    </div><!-- .card-title-group -->

                                                    <div class="mt-2 mb-4">

                                                        <div class="amount h1">

                                                            <?= $rejected ?>

                                                        </div>

                                                    </div>

                                                </div><!-- .card-body -->

                                            </div><!-- .card -->

                                        </div><!-- .col -->





                                        <div class="col-md-6 col-xxl-6">

                                            <div class="card h-100">

                                                <div class="card-body">

                                                    <div class="card-title-group">

                                                        <div class="card-title">

                                                            <h5 class="title">10 Permohonan yang diluluskan terkini</h5>

                                                        </div>

                                                        <div class="card-tools">

                                                            <em class="icon-hint icon ni ni-help-fill"

                                                                data-bs-toggle="tooltip" data-bs-placement="left"

                                                                title="Permohonan melalui eKOKEDI Pelajar yang telah mengemaskini profil"></em>

                                                        </div>

                                                    </div><!-- .card-title-group -->

                                                    <table class="datatable-init table"

                                                        data-nk-container="table-responsive table-border">

                                                        <thead>

                                                            <tr>

                                                                <th>No.</th>

                                                                <th>Nama Pemohon</th>

                                                                <th>Tarikh Pemohonan Diterima</th>

                                                            </tr>

                                                        </thead>

                                                        <tbody>

                                                            <?php

                                                            $bil = 1;

                                                            foreach ($successApp as $success) {

                                                                ?>

                                                                <tr>

                                                                    <td>

                                                                        <?= $bil++ ?>

                                                                    </td>

                                                                    <td>

                                                                        <?= $success['name'] ?>

                                                                    </td>

                                                                    <td>

                                                                        <?= date('d/m/Y H:i A', strtotime($success['updated_at'])) ?>

                                                                    </td>

                                                                </tr>

                                                            <?php } ?>

                                                        </tbody>

                                                    </table>

                                                </div><!-- .card-body -->

                                            </div><!-- .card -->

                                        </div><!-- .col -->





                                        <div class="col-md-6 col-xxl-6">

                                            <div class="card h-100">

                                                <div class="card-body">

                                                    <div class="card-title-group">

                                                        <div class="card-title">

                                                            <h5 class="title">10 Permohonan Yang Ditolak</h5>

                                                        </div>

                                                    </div><!-- .card-title-group -->

                                                    <table class="datatable-init table"

                                                        data-nk-container="table-responsive table-border">

                                                        <thead>

                                                            <tr>

                                                                <th>No.</th>

                                                                <th>Nama Pemohon</th>

                                                                <th>Tarikh Penolakan</th>

                                                            </tr>

                                                        </thead>

                                                        <tbody>

                                                            <?php

                                                            $no = 1;

                                                            foreach ($failedApp as $failed) {

                                                                ?>

                                                                <tr>

                                                                    <td>

                                                                        <?= $no++ ?>

                                                                    </td>

                                                                    <td>

                                                                        <?= $failed['name'] ?>

                                                                    </td>

                                                                    <td>

                                                                        <?= date('d/m/Y H:i A', strtotime($failed['updated_at'])) ?>

                                                                    </td>

                                                                </tr>

                                                            <?php } ?>

                                                        </tbody>

                                                    </table>



                                                </div><!-- .nk-timeline -->

                                            </div><!-- .card-body -->

                                        </div><!-- .card -->

                                    </div><!-- .col -->



                                </div><!-- .row -->

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
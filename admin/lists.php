<?php



require_once('../config/config.php');

require_once('../config/csrf.php');

require_once('../config/redirectifAuthenticated.php');

require_once('../plugins/encryptor.php');



$token = generateCSRFToken();



$enc_id1 = '';

$enc_id2 = '';

$enc_id3 = '';

$enc_id4 = '';

$enc_id5 = '';

$enc_id6 = '';

$enc_id7 = '';



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

    <title>eKOKEDI - Retan</title>

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

                                    <h1>Retan</h1>



                                    <div class="row g-gs mt-1">

                                        <div class="col-sm-6 col-xl-6 col-xxl-12">





                                            <div class="row align-items-start g-gs">

                                                <div class="col-lg-3 col-xl-2">

                                                    <div class="nav flex-column nav-pills">

                                                        <button class="nav-link text-start active" data-bs-toggle="pill"

                                                            data-bs-target="#v-pills-abubakar" type="button">ABU

                                                            BAKAR</button>

                                                        <button class="nav-link text-start" data-bs-toggle="pill"

                                                            data-bs-target="#v-pills-ali" type="button">ALI</button>

                                                        <button class="nav-link text-start" data-bs-toggle="pill"

                                                            data-bs-target="#v-pills-umar" type="button">UMAR</button>

                                                        <button class="nav-link text-start" data-bs-toggle="pill"

                                                            data-bs-target="#v-pills-uthman"

                                                            type="button">UTHMAN</button>

                                                        <button class="nav-link text-start" data-bs-toggle="pill"

                                                            data-bs-target="#v-pills-aisyah" type="button">SITI

                                                            AISYAH</button>

                                                        <button class="nav-link text-start" data-bs-toggle="pill"

                                                            data-bs-target="#v-pills-khadijah" type="button">SITI

                                                            KHADIJAH</button>

                                                        <button class="nav-link text-start" data-bs-toggle="pill"

                                                            data-bs-target="#v-pills-hajar" type="button">SITI

                                                            HAJAR</button>

                                                    </div>

                                                </div>

                                                <div class="col-lg-9 col-xl-10">

                                                    <div class="tab-content">

                                                        <div class="tab-pane fade show active" id="v-pills-abubakar">

                                                            <table class="datatable-init table"

                                                                data-nk-container="table-responsive table-border">

                                                                <thead>

                                                                    <tr>

                                                                        <th>No.</th>

                                                                        <th>Nama Penghuni</th>

                                                                        <th>No. Kad Pengenalan</th>

                                                                        <th>Bilik</th>

                                                                        <th>Tindakan</th>

                                                                    </tr>

                                                                </thead>

                                                                <tbody>

                                                                    <?php

                                                                    $getAbuBakar = $pdo->prepare("SELECT * FROM occupants 

                                                                    JOIN rooms ON occupants.room_id = rooms.room_id

                                                                    JOIN applications ON occupants.occ_id = applications.occ_id

                                                                    WHERE rooms.block = ? AND applications.application_status = ? ORDER BY rooms.room_name DESC");

                                                                    $getAbuBakar->execute(['ABU BAKAR', '1']);

                                                                    $abuBakar = $getAbuBakar->fetchAll();

                                                                    $bil = 1;

                                                                    foreach ($abuBakar as $occupants) {

                                                                        $enc_id1 = encrypt($occupants['occ_id'], $secret_key);

                                                                        ?>

                                                                        <tr>

                                                                            <td>

                                                                                <?= $bil++ ?>

                                                                            </td>

                                                                            <td>

                                                                                <?= $occupants['name'] ?>

                                                                            </td>

                                                                            <td>

                                                                                <?= $occupants['nokp'] ?>

                                                                            </td>

                                                                            <td>

                                                                                <?= $occupants['room_name'] ?>

                                                                            </td>

                                                                            <td>

                                                                                <button class="btn btn-primary"

                                                                                    onclick="window.location.href='admin/occupants.php?o=<?= $enc_id1 ?>'">Semak</button>

                                                                            </td>

                                                                        </tr>

                                                                    <?php } ?>

                                                                </tbody>

                                                            </table>

                                                        </div>

                                                        <div class="tab-pane fade" id="v-pills-ali">

                                                            <table class="datatable-init table"

                                                                data-nk-container="table-responsive table-border">

                                                                <thead>

                                                                    <tr>

                                                                        <th>No.</th>

                                                                        <th>Nama Penghuni</th>

                                                                        <th>No. Kad Pengenalan</th>

                                                                        <th>Bilik</th>

                                                                        <th>Tindakan</th>

                                                                    </tr>

                                                                </thead>

                                                                <tbody>

                                                                    <?php

                                                                    $getAli = $pdo->prepare("SELECT * FROM occupants 

                                                                    JOIN rooms ON occupants.room_id = rooms.room_id

                                                                    JOIN applications ON occupants.occ_id = applications.occ_id

                                                                    WHERE rooms.block = ? AND applications.application_status = ? ORDER BY rooms.room_name DESC");

                                                                    $getAli->execute(['ALI', '1']);

                                                                    $Ali = $getAli->fetchAll();

                                                                    $no = 1;

                                                                    foreach ($Ali as $occupants) {

                                                                        $enc_id2 = encrypt($occupants['occ_id'], $secret_key);



                                                                        ?>

                                                                        <tr>

                                                                            <td>

                                                                                <?= $no++ ?>

                                                                            </td>

                                                                            <td>

                                                                                <?= $occupants['name'] ?>

                                                                            </td>

                                                                            <td>

                                                                                <?= $occupants['nokp'] ?>

                                                                            </td>

                                                                            <td>

                                                                                <?= $occupants['room_name'] ?>

                                                                            </td>

                                                                            <td>

                                                                            <button class="btn btn-primary"

                                                                                    onclick="window.location.href='admin/occupants.php?o=<?= $enc_id2 ?>'">Semak</button>

                                                                            </td>

                                                                        </tr>

                                                                    <?php } ?>

                                                                </tbody>

                                                            </table>

                                                        </div>

                                                        <div class="tab-pane fade" id="v-pills-umar">

                                                            <table class="datatable-init table"

                                                                data-nk-container="table-responsive table-border">

                                                                <thead>

                                                                    <tr>

                                                                        <th>No.</th>

                                                                        <th>Nama Penghuni</th>

                                                                        <th>No. Kad Pengenalan</th>

                                                                        <th>Bilik</th>

                                                                        <th>Tindakan</th>

                                                                    </tr>

                                                                </thead>

                                                                <tbody>

                                                                    <?php

                                                                    $getUmar = $pdo->prepare("SELECT * FROM occupants 

                                                                    JOIN rooms ON occupants.room_id = rooms.room_id

                                                                    JOIN applications ON occupants.occ_id = applications.occ_id

                                                                    WHERE rooms.block = ? AND applications.application_status = ? ORDER BY rooms.room_name DESC");

                                                                    $getUmar->execute(['UMAR','1']);

                                                                    $Umar = $getUmar->fetchAll();

                                                                    $no2 = 1;

                                                                    foreach ($Umar as $occupants) { 

                                                                        $enc_id3 = encrypt($occupants['occ_id'], $secret_key);



                                                                        ?>

                                                                        <tr>

                                                                            <td>

                                                                                <?= $no2++ ?>

                                                                            </td>

                                                                            <td>

                                                                                <?= $occupants['name'] ?>

                                                                            </td>

                                                                            <td>

                                                                                <?= $occupants['nokp'] ?>

                                                                            </td>

                                                                            <td>

                                                                                <?= $occupants['room_name'] ?>

                                                                            </td>

                                                                            <td>

                                                                            <button class="btn btn-primary"

                                                                                    onclick="window.location.href='admin/occupants.php?o=<?= $enc_id3 ?>'">Semak</button>

                                                                            </td>

                                                                        </tr>

                                                                    <?php } ?>

                                                                </tbody>

                                                            </table>

                                                        </div>

                                                        <div class="tab-pane fade" id="v-pills-uthman">

                                                            <table class="datatable-init table"

                                                                data-nk-container="table-responsive table-border">

                                                                <thead>

                                                                    <tr>

                                                                        <th>No.</th>

                                                                        <th>Nama Penghuni</th>

                                                                        <th>No. Kad Pengenalan</th>

                                                                        <th>Bilik</th>

                                                                        <th>Tindakan</th>

                                                                    </tr>

                                                                </thead>

                                                                <tbody>

                                                                    <?php

                                                                    $getUthman = $pdo->prepare("SELECT * FROM occupants 

                                                                    JOIN rooms ON occupants.room_id = rooms.room_id

                                                                    JOIN applications ON occupants.occ_id = applications.occ_id

                                                                    WHERE rooms.block = ? AND applications.application_status = ? ORDER BY rooms.room_name DESC");

                                                                    $getUthman->execute(['UTHMAN', '1']);

                                                                    $Uthman = $getUthman->fetchAll();

                                                                    $no3 = 1;

                                                                    foreach ($Uthman as $occupants) { 

                                                                        $enc_id4 = encrypt($occupants['occ_id'], $secret_key);



                                                                        ?>

                                                                        <tr>

                                                                            <td>

                                                                                <?= $no3++ ?>

                                                                            </td>

                                                                            <td>

                                                                                <?= $occupants['name'] ?>

                                                                            </td>

                                                                            <td>

                                                                                <?= $occupants['nokp'] ?>

                                                                            </td>

                                                                            <td>

                                                                                <?= $occupants['room_name'] ?>

                                                                            </td>

                                                                            <td>

                                                                            <button class="btn btn-primary"

                                                                                    onclick="window.location.href='admin/occupants.php?o=<?= $enc_id4 ?>'">Semak</button>

                                                                            </td>

                                                                        </tr>

                                                                    <?php } ?>

                                                                </tbody>

                                                            </table>

                                                        </div>

                                                        <div class="tab-pane fade" id="v-pills-aisyah">

                                                            <table class="datatable-init table"

                                                                data-nk-container="table-responsive table-border">

                                                                <thead>

                                                                    <tr>

                                                                        <th>No.</th>

                                                                        <th>Nama Penghuni</th>

                                                                        <th>No. Kad Pengenalan</th>

                                                                        <th>Bilik</th>

                                                                        <th>Tindakan</th>

                                                                    </tr>

                                                                </thead>

                                                                <tbody>

                                                                    <?php

                                                                    $getSA = $pdo->prepare("SELECT * FROM occupants 

                                                                    JOIN rooms ON occupants.room_id = rooms.room_id

                                                                    JOIN applications ON occupants.occ_id = applications.occ_id

                                                                    WHERE rooms.block = ? AND applications.application_status = ? ORDER BY rooms.room_name DESC");

                                                                    $getSA->execute(['SITI AISYAH', '1']);

                                                                    $SA = $getSA->fetchAll();

                                                                    $no4 = 1;

                                                                    foreach ($SA as $occupants) {

                                                                        $enc_id5 = encrypt($occupants['occ_id'], $secret_key);

                                                                        

                                                                        ?>

                                                                        <tr>

                                                                            <td>

                                                                                <?= $no4++ ?>

                                                                            </td>

                                                                            <td>

                                                                                <?= $occupants['name'] ?>

                                                                            </td>

                                                                            <td>

                                                                                <?= $occupants['nokp'] ?>

                                                                            </td>

                                                                            <td>

                                                                                <?= $occupants['room_name'] ?>

                                                                            </td>

                                                                            <td>

                                                                            <button class="btn btn-primary"

                                                                                    onclick="window.location.href='admin/occupants.php?o=<?= $enc_id5 ?>'">Semak</button>

                                                                            </td>

                                                                        </tr>

                                                                    <?php } ?>

                                                                </tbody>

                                                            </table>

                                                        </div>

                                                        <div class="tab-pane fade" id="v-pills-khadijah">

                                                            <table class="datatable-init table"

                                                                data-nk-container="table-responsive table-border">

                                                                <thead>

                                                                    <tr>

                                                                        <th>No.</th>

                                                                        <th>Nama Penghuni</th>

                                                                        <th>No. Kad Pengenalan</th>

                                                                        <th>Bilik</th>

                                                                        <th>Tindakan</th>

                                                                    </tr>

                                                                </thead>

                                                                <tbody>

                                                                    <?php

                                                                    $getSK = $pdo->prepare("SELECT * FROM occupants 

                                                                    JOIN rooms ON occupants.room_id = rooms.room_id

                                                                    JOIN applications ON occupants.occ_id = applications.occ_id

                                                                    WHERE rooms.block = ? AND applications.application_status = ? ORDER BY rooms.room_name DESC");

                                                                    $getSK->execute(['SITI KHADIJAH', '1']);

                                                                    $SK = $getSK->fetchAll();

                                                                    $no5 = 1;

                                                                    foreach ($SK as $occupants) { 

                                                                        $enc_id6 = encrypt($occupants['occ_id'], $secret_key);

                                                                        

                                                                        ?>

                                                                        <tr>

                                                                            <td>

                                                                                <?= $no5++ ?>

                                                                            </td>

                                                                            <td>

                                                                                <?= $occupants['name'] ?>

                                                                            </td>

                                                                            <td>

                                                                                <?= $occupants['nokp'] ?>

                                                                            </td>

                                                                            <td>

                                                                                <?= $occupants['room_name'] ?>

                                                                            </td>

                                                                            <td>

                                                                            <button class="btn btn-primary"

                                                                                    onclick="window.location.href='admin/occupants.php?o=<?= $enc_id6 ?>'">Semak</button>

                                                                            </td>

                                                                        </tr>

                                                                    <?php } ?>

                                                                </tbody>

                                                            </table>

                                                        </div>

                                                        <div class="tab-pane fade" id="v-pills-hajar">

                                                            <table class="datatable-init table"

                                                                data-nk-container="table-responsive table-border">

                                                                <thead>

                                                                    <tr>

                                                                        <th>No.</th>

                                                                        <th>Nama Penghuni</th>

                                                                        <th>No. Kad Pengenalan</th>

                                                                        <th>Bilik</th>

                                                                        <th>Tindakan</th>

                                                                    </tr>

                                                                </thead>

                                                                <tbody>

                                                                    <?php

                                                                    $getSH = $pdo->prepare("SELECT * FROM occupants 

                                                                    JOIN rooms ON occupants.room_id = rooms.room_id

                                                                    JOIN applications ON occupants.occ_id = applications.occ_id

                                                                    WHERE rooms.block = ? AND applications.application_status = ? ORDER BY rooms.room_name DESC");

                                                                    $getSH->execute(['SITI HAJAR', '1']);

                                                                    $SH = $getSH->fetchAll();

                                                                    $no6 = 1;

                                                                    foreach ($SH as $occupants) { 

                                                                        $enc_id7 = encrypt($occupants['occ_id'], $secret_key);

                                                                        

                                                                        ?>

                                                                        <tr>

                                                                            <td>

                                                                                <?= $no6++ ?>

                                                                            </td>

                                                                            <td>

                                                                                <?= $occupants['name'] ?>

                                                                            </td>

                                                                            <td>

                                                                                <?= $occupants['nokp'] ?>

                                                                            </td>

                                                                            <td>

                                                                                <?= $occupants['room_name'] ?>

                                                                            </td>

                                                                            <td>

                                                                            <button class="btn btn-primary"

                                                                                    onclick="window.location.href='admin/occupants.php?o=<?= $enc_id7 ?>'">Semak</button>

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
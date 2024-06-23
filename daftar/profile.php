<?php

require_once('../config/config.php');
require_once('../config/csrf.php');
require_once('../arrays/states.php');
require_once('backend/redirect.php');

$token = generateCSRFToken();

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
    <meta name="description"
        content="Portal pendaftaran dan pengurusan penghuni Kolej Kediaman, Kolej Vokasional Kuala Selangor, Bahagian Pendidikan dan Latihan Teknikal Vokasional, Kementerian Pendidikan Malaysia">
    <title>eKOKEDI - Daftar Penghuni Baru</title>
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
                                <a href="./html/index.html" class="logo-link">
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
                                        <h3 class="nk-block-title mb-1">Kemaskini Maklumat Penghuni</h3>
                                        <p class="small">Sila isi maklumat yang berikut bagi proses permohonan penempatan Kolej Kediaman</p>
                                    </div>
                                </div>
                                <form action="daftar/backend/updateProfile.php" method="POST" enctype="multipart/form-data">
                                    <div class="row gy-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="occ_address" class="form-label">Alamat Pemohon</label>
                                                <div class="form-control-wrap">
                                                    <input type="hidden" name="token" value="<?= $token ?>">
                                                    <textarea required name="occ_address" class="form-control" id=""
                                                        cols="30"
                                                        rows="10"></textarea>
                                                </div>
                                            </div><!-- .form-group -->
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="occ_states" class="form-label">Negeri</label>
                                                <div class="form-control-wrap">
                                                    <select name="occ_states" id="occ_states" class="form-control">
                                                        <?php foreach ($MalaysianStates as $stateCode => $stateName) { ?>
                                                            <option value="<?= $stateName ?>">
                                                                <?= $stateName ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div><!-- .form-group -->
                                        </div>
                                        <div class="col-12">
                                            <div class="my-3 text-center">
                                                <h6 class="overline-title overline-title-sep"><span>BAHAGIAN B :
                                                        Maklumat Bapa/Penjaga/Waris</span></h6>
                                            </div>
                                            <div class="form-group">
                                                <label for="occ_father" class="form-label">Nama Bapa</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="occ_father"
                                                        id="occ_father" placeholder="Masukkan Nama Bapa">
                                                </div>
                                            </div><!-- .form-group -->
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="occ_father_notel" class="form-label">No. Telefon
                                                    Bapa</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="occ_father_notel"
                                                        id="occ_father_notel" placeholder="Masukkan No. Telefon Bapa">
                                                </div>
                                            </div><!-- .form-group -->
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="occ_father_job" class="form-label">Pekerjaan Bapa</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="occ_father_job"
                                                        id="occ_father_job" placeholder="Masukkan Pekerjaan Bapa">
                                                </div>
                                            </div><!-- .form-group -->
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="occ_father_salary" class="form-label">Pendapatan
                                                    (sebulan)</label>
                                                <div class="form-control-wrap">
                                                    <input type="number" class="form-control" name="occ_father_salary"
                                                        id="occ_father_salary"
                                                        placeholder="Masukkan Anggaran Pendapatan">
                                                </div>
                                            </div><!-- .form-group -->
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="occ_father_dependants" class="form-label">Tanggungan</label>
                                                <div class="form-control-wrap">
                                                    <input type="number" class="form-control"
                                                        name="occ_father_dependants" id="occ_father_dependants"
                                                        placeholder="Masukkan Bilangan Tanggungan">
                                                </div>
                                            </div><!-- .form-group -->
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="occ_father_slip" class="form-label">Muat Naik Slip Gaji
                                                    Bapa</label>
                                                <div class="form-control-wrap">
                                                    <input class="form-control" type="file" id="occ_father_slip"
                                                        name="occ_father_slip">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my-3 text-center">
                                            <h6 class="overline-title overline-title-sep"><span>Maklumat
                                                    Ibu/Penjaga/Waris</span></h6>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="occ_mother" class="form-label">Nama Ibu</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="occ_mother"
                                                        id="occ_mother" placeholder="Masukkan Nama Ibu">
                                                </div>
                                            </div><!-- .form-group -->
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="occ_mother_notel" class="form-label">No. Telefon
                                                    Ibu</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="occ_mother_notel"
                                                        id="occ_mother_notel" placeholder="Masukkan No. Telefon Ibu">
                                                </div>
                                            </div><!-- .form-group -->
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="occ_mother_job" class="form-label">Pekerjaan Ibu</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="occ_mother_job"
                                                        id="occ_mother_job" placeholder="Masukkan Pekerjaan Ibu">
                                                </div>
                                            </div><!-- .form-group -->
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="occ_mother_salary" class="form-label">Pendapatan
                                                    (sebulan)</label>
                                                <div class="form-control-wrap">
                                                    <input type="number" class="form-control" name="occ_mother_salary"
                                                        id="occ_mother_salary"
                                                        placeholder="Masukkan Anggaran Pendapatan">
                                                </div>
                                            </div><!-- .form-group -->
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="occ_mother_dependants" class="form-label">Tanggungan</label>
                                                <div class="form-control-wrap">
                                                    <input type="number" class="form-control"
                                                        name="occ_mother_dependants" id="occ_mother_dependants"
                                                        placeholder="Masukkan Bilangan Tanggungan">
                                                </div>
                                            </div><!-- .form-group -->
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="occ_mother_slip" class="form-label">Muat Naik Slip Gaji
                                                    Ibu</label>
                                                <div class="form-control-wrap">
                                                    <input class="form-control" type="file" id="occ_mother_slip"
                                                        name="occ_mother_slip">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn btn-primary" type="submit"><em class="icon ni ni-chevron-right"></em> Seterusnya</button>
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
<?php
require_once('config/config.php');
require_once('config/redirectifAuthenticated.php');
require_once('arrays/states.php');
require_once('config/csrf.php');

$token = generateCSRFToken();

$getAllProgrammes = $pdo->query('SELECT * FROM programme')->fetchAll();

$notel = '';
$email = '';
$address = '';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="../../">
    <meta charset="utf-8">
    <meta name="author" content="Kolej Vokasional Kuala Selangor">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Permohonan Penempatan Kolej Kediaman Kolej Vokasional Kuala Selangor</title>
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
                            <p>
                                <button class="btn btn-secondary" onclick="window.location.href='backend/logout.php'">Log Keluar</button>
                            </p>
                        </div>
                        <div class="card card-gutter-xxl rounded-4 card-auth">
                            <div class="card-body">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h3 class="nk-block-title mb-1">Permohonan Penempatan</h3>
                                        <p class="small">Sila isi maklumat yang berikut bagi proses pendaftaran dan
                                            penempatan ke Kolej Kediaman</p>
                                    </div>
                                </div>
                                <form action="backend/profilesUpdate.php" method="POST">
                                    <div class="row gy-3">
                                        <div class="col-12">
                                            <div class="my-3 text-center">
                                                <h6 class="overline-title overline-title-sep"><span>BAHAGIAN A :
                                                        Maklumat Pemohon</span></h6>
                                            </div>
                                            <div class="form-group">
                                                <label for="occ_name" class="form-label">Nama Pemohon</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="occ_name"
                                                        id="occ_name" placeholder="Masukkan No. Kad Pengenalan" value="<?=$student['name']?>" disabled>
                                                </div>
                                            </div><!-- .form-group -->
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="occ_stdno" class="form-label">No. Pelajar/Matriks</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="occ_stdno"
                                                        id="occ_stdno" placeholder="Masukkan No. Pelajar/Matriks"
                                                        disabled value="<?=$student['std_no']?>">
                                                </div>
                                            </div><!-- .form-group -->
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="occ_nric" class="form-label">No. Kad Pengenalan</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="occ_nric"
                                                        id="occ_nric" placeholder="Masukkan No. Kad Pengenalan"
                                                        disabled value="<?=$student['nokp']?>">
                                                </div>
                                            </div><!-- .form-group -->
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="occ_notel" class="form-label">No. Telefon Pemohon</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="occ_notel"
                                                        id="occ_notel" placeholder="Masukkan No. Telefon (0123456789)" value="<?=($student['notel'] == NULL) ? '' : $notel = $student['notel']?>">
                                                </div>
                                            </div><!-- .form-group -->
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="occ_email" class="form-label">Emel Pemohon</label>
                                                <div class="form-control-wrap">
                                                    <input type="email" class="form-control" name="occ_email"
                                                        id="occ_email" placeholder="Masukkan emel pemohon" required value="<?=($student['email'] == NULL) ? '' : $email = $student['email']?>">
                                                    <input type="hidden" name="token" value="<?=$token?>">
                                                    </div>
                                            </div><!-- .form-group -->
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="occ_address" class="form-label">Alamat Pemohon</label>
                                                <div class="form-control-wrap">
                                                    <textarea required name="occ_address" class="form-control" id="" cols="30"
                                                        rows="10"><?=($student['address'] == NULL) ? '' : $address = $student['address']?></textarea>
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
                                            <div class="form-group">
                                                <label for="occ_notel" class="form-label">Jurusan/Program</label>
                                                <div class="form-control-wrap">
                                                    <select name="occ_programme" id="" class="form-control">
                                                        <?php 
                                                        foreach($getAllProgrammes as $prog) {
                                                        ?>
                                                        <option value="<?=$prog['programme_id']?>"><?=$prog['programme_name'].' - '.$prog['cert_level']?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div><!-- .form-group -->
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="occ_semester" class="form-label">Semester</label>
                                                <div class="form-control-wrap">
                                                    <select name="occ_semester" id="" class="form-control">
                                                        <?php 
                                                        ?>
                                                        <option value="SEMESTER 1">SEMESTER 1</option>
                                                        <option value="SEMESTER 2">SEMESTER 2</option>
                                                        <option value="SEMESTER 3">SEMESTER 3</option>
                                                        <option value="SEMESTER 4">SEMESTER 4</option>
                                                    </select>
                                                </div>
                                            </div><!-- .form-group -->
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="occ_room" class="form-label">Bilik</label>
                                                <div class="form-control-wrap">
                                                    <select name="occ_room" id="" class="form-control">
                                                        <option value="<?=$student['room_id']?>"><?=$student['room_name']?></option>
                                                    </select>
                                                </div>
                                            </div><!-- .form-group -->
                                        </div>

                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn btn-primary" type="submit">Seterusnya</button>
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